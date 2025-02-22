<x-dashboard-layout>
    <x-slot:title>
        <div class="d-flex align-items-center mb-4">
            <span class="fs-5 fw-semibold">Daftar Produk</span>
        </div>
    </x-slot:title>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <div class="input-group me-4">
                <span class="input-group-text bg-transparent border border-end-0 text-secondary">
                    <ion-icon name="search-outline"></ion-icon>
                </span>
                <input type="text" class="form-control shadow-none border rounded-1 border-start-0 ps-0 text-secondary"
                    id="search" name="search" placeholder="Cari barang" value="{{ old('search') }}">
            </div>
            <div class="input-group">
                <span class="input-group-text bg-transparent border border-end-0 text-secondary">
                    <img src="{{ asset('assets/images/package.png') }}" class="invert" alt="Package Icon">
                </span>
                <select name="product_category_id" id="product-category" class="form-select border-start-0 shadow-none"
                    aria-label="Product Category">
                    <option value="" selected>Semua</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($category->id == old('product_category_id'))>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <button id="export-button" class="btn btn-sm btn-success me-4">
                <img src="{{ asset('assets/images/microsoft-excel-logo.png') }}" alt="Excel Icon">
                <span>Export Excel</span>
            </button>
            <a href="{{ route('product.lists.create') }}">
                <button class="btn btn-sm btn-danger">
                    <img src="{{ asset('assets/images/plus-circle.png') }}" alt="Plus Icon">
                    <span>Tambah Produk</span>
                </button>
            </a>
        </div>
    </div>

    @include('partials.product-table')

    @push('scripts')
        <script>
            let search = $('#search');
            let exportButton = $('#export-button');
            let productCategory = $('#product-category');

            const deleteProduct = function(element) {
                if (confirm('Yakin ingin menghapus data?')) {
                    element.querySelector('form').submit();
                }
            }

            search.on('keyup', debounce(function() {
                updateContent();
            }, 700));

            productCategory.on('change', function() {
                updateContent();
            });

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                updateContent(
                    `${$(this).attr('href')}&search=${search.val()}&product_category_id=${productCategory.val()}`);
            });

            function debounce(func, wait) {
                let timeout;
                return function() {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, arguments), wait);
                };
            }

            function updateContent(url = null) {
                const params = new URLSearchParams({
                    search: search.val(),
                    product_category_id: productCategory.val()
                });

                $.get(url || window.location.pathname + '?' + params.toString())
                    .done(function(response) {
                        $('#product-table').html(response);
                        window.history.pushState({}, '', url || window.location.pathname + '?' + params.toString());
                    });
            }

            exportButton.on('click', function(event) {
                event.preventDefault();

                const formData = new FormData();
                formData.append('search', search.val());
                formData.append('product_category_id', productCategory.val());
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: "{{ route('product.export') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(response, status, xhr) {
                        const filename = xhr.getResponseHeader('Content-Disposition').split('filename=')[1]
                            .replace(/['"]/g, '');
                        const url = window.URL.createObjectURL(response);

                        const link = document.createElement('a');
                        link.href = url;
                        link.download = filename;
                        link.click();

                        window.URL.revokeObjectURL(url);
                    },
                });
            });
        </script>
    @endpush
</x-dashboard-layout>

<x-dashboard-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/dropzone.min.css') }}">
    @endpush

    <x-slot:title>
        <div class="d-flex align-items-center mb-4">
            <span class="fs-5 fw-semibold text-secondary">Daftar Produk</span>
            <ion-icon class="mx-2" name="chevron-forward-outline"></ion-icon>
            <span class="fs-5 fw-semibold">Tambah Produk</span>
        </div>
    </x-slot:title>

    <form id="form" class="container-fluid" action="{{ route('product.lists.update', $product->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="mb-3 col-md-4">
                <label for="category" class="form-label fw-semibold">Kategori</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border border-end-0 text-secondary">
                        <img src="{{ asset('assets/images/package.png') }}" class="invert" alt="Package Icon">
                    </span>
                    <select name="product_category_id" id="product-category"
                        class="form-select border-start-0 shadow-none @error('product_category_id') is-invalid @enderror"
                        aria-label="Product Category">
                        <option value="" selected>Pilih kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(in_array($category->id, [old('product_category_id'), $product->product_category_id]))>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('product_category_id')
                        <x-invalid-feedback :message="$message" />
                    @enderror
                </div>
            </div>
            <div class="mb-3 col-md-8">
                <label for="name" class="form-label fw-semibold">Nama Barang</label>
                <input type="text"
                    class="form-control shadow-none border rounded-1 @error('name') is-invalid @enderror" id="name"
                    name="name" placeholder="Masukkan nama barang" value="{{ old('name') ?? $product->name }}"
                    required>

                @error('name')
                    <x-invalid-feedback :message="$message" />
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md">
                <label for="purchase-price" class="form-label fw-semibold">Harga Beli</label>
                <input type="hidden" name="purchase_price"
                    value="{{ old('purchase_price') ?? $product->purchase_price }}">
                <input type="text"
                    class="form-control shadow-none border rounded-1 currency @error('purchase_price') is-invalid @enderror"
                    id="purchase-price" placeholder="Masukkan harga beli" data-input="purchase_price"
                    value="{{ old('purchase_price') ?? $product->purchase_price }}" required>

                @error('purchase_price')
                    <x-invalid-feedback :message="$message" />
                @enderror
            </div>
            <div class="mb-3 col-md">
                <label for="selling-price" class="form-label fw-semibold">Harga Jual</label>
                <input type="hidden" name="selling_price"
                    value="{{ old('selling_price') ?? $product->selling_price }}">
                <input type="text"
                    class="form-control shadow-none border rounded-1 currency @error('selling_price') is-invalid @enderror"
                    id="selling-price" placeholder="Masukkan harga jual" data-input="selling_price"
                    value="{{ old('selling_price') ?? $product->selling_price }}" required>

                @error('selling_price')
                    <x-invalid-feedback :message="$message" />
                @enderror
            </div>
            <div class="mb-3 col-md">
                <label for="stock" class="form-label fw-semibold">Stok Barang</label>
                <input type="number"
                    class="form-control shadow-none border rounded-1 @error('stock') is-invalid @enderror"
                    id="stock" name="stock" placeholder="Masukkan stok barang"
                    value="{{ old('stock') ?? $product->stock }}" required>

                @error('stock')
                    <x-invalid-feedback :message="$message" />
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="mb-3">
                <label for="image" class="form-label fw-semibold">Upload Image</label>
                <div class="dropzone rounded-1 text-center @error('image') is-invalid @enderror" id="imageDropzone">
                    <div class="dz-message">
                        <img src='{{ $product->image ? asset("storage/products/$product->image") : asset('assets/images/image.png') }}'
                            alt="Upload Icon">
                        <p class="mt-2">{{ $product->image ? null : 'upload gambar disini' }}</p>
                    </div>
                </div>
                <input type="file" class="d-none @error('image') is-invalid @enderror" name="image" id="image">

                @error('image')
                    <x-invalid-feedback :message="$message" />
                @enderror
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <div class="d-flex ">
                <button type="button" id="reset-button" class="btn btn-outline-primary rounded-1 py-1 px-4 me-3"
                    onclick="resetForm()">Batalkan</button>
                <button type="submit" class="btn btn-primary rounded-1 py-1 px-4">Simpan</button>
            </div>
        </div>
    </form>

    @push('scripts')
        <script src="{{ asset('assets/js/dropzone.min.js') }}"></script>
        <script src="{{ asset('assets/js/script.js') }}"></script>
    @endpush
</x-dashboard-layout>

<div id="product-table">
    <table class="table table-borderless border rounded-1">
        <thead class="table-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Image</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Kategori Produk</th>
                <th scope="col">Harga Beli (Rp)</th>
                <th scope="col">Harga Jual (Rp)</th>
                <th scope="col">Stok Produk</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr class="align-middle">
                    <th scope="row">{{ $products->firstItem() + $loop->index }}</th>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset("storage/products/$product->image") }}" alt="Product Image"
                                height="50">
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->productCategory->name }}</td>
                    <td>{{ number_format($product->purchase_price) }}</td>
                    <td>{{ number_format($product->selling_price) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('product.lists.edit', $product->id) }}" class="text-primary">
                            <ion-icon name="pencil" size="small"></ion-icon>
                        </a>
                        <a href="#" class="delete-button text-danger" onclick="deleteProduct(this)">
                            <ion-icon name="trash" size="small"></ion-icon>

                            <form action="{{ route('product.lists.destroy', $product->id) }}" method="POST"
                                class="d-none">
                                @method('DELETE')
                                @csrf
                            </form>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="align-middle">
                    <td colspan="8" class="text-center">Tidak ada data ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $products->links() }}
</div>

<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('productCategory:id,name')->filter($request)->paginate(10);
        $categories = ProductCategory::get(['id', 'name']);

        if ($request->ajax()) {
            return view('partials.product-table', compact('products'))->render();
        }

        return view('dashboard.product.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = ProductCategory::get(['id', 'name']);

        return view('dashboard.product.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $image = $request->file('image');
        $data['image'] = $image->hashName();

        $image->storeAs('public/products', $data['image']);
        Product::create($data);

        return to_route('product.lists.index')->with('message', 'Produk berhasil dibuat!');
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::get(['id', 'name']);

        return view('dashboard.product.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->deleteProductImage($product->image);

            $image = $request->file('image');
            $data['image'] = $image->hashName();
            $image->storeAs('public/products', $data['image']);
        }

        $product->fill($data)->save();

        return to_route('product.lists.index')->with('message', 'Produk berhasil diubah!');
    }

    public function destroy(Product $product)
    {
        $this->deleteProductImage($product->image);
        $product->delete();

        return back()->with('message', "Berhasil menghapus data produk $product->name");
    }

    public function export(Request $request)
    {
        $time = now()->format('Ymd-His');
        $products = Product::filter($request)->get();

        return Excel::download(new ProductExport($products), "products-$time.xlsx");
    }

    private function deleteProductImage($productImage): void
    {
        if ($productImage) {
            Storage::delete("public/products/$productImage");
        }
    }
}

<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\InventoryLog;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0|max:999999999.99',
            'stock' => 'required|integer|min:1',
        ], [
            'category_id.required' => 'Category is required.',
            'name.required' => 'Name is required.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a valid number with up to 2 decimal places.',
            'price.min' => 'Price must be at least 0.',
            'price.max' => 'Price melebihi batas ketentuan!',
            'stock.required' => 'Stock is required.',
            'stock.integer' => 'Stock must be an integer.',
            'stock.min' => 'Stock must be at least 1.',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0|max:999999999.99',
            'stock' => 'required|integer|min:0',
        ], [
            'category_id.required' => 'Category is required.',
            'name.required' => 'Name is required.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a valid number with up to 2 decimal places.',
            'price.min' => 'Price must be at least 0.',
            'price.max' => 'Price melebihi batas ketentuan!',
            'stock.required' => 'Stock is required.',
            'stock.integer' => 'Stock must be an integer.',
            'stock.min' => 'Stock must be at least 0.',
            
        ]);

        // Cek perubahan stok
        $oldStock = $product->stock;
        $newStock = $request->input('stock');
        $quantityChange = $newStock - $oldStock;

        // Update produk
        $product->update($request->all());

        // Buat log inventaris
        if ($quantityChange != 0) {
            InventoryLog::create([
                'product_id' => $product->id,
                'type' => $quantityChange > 0 ? 'restock' : 'sold',
                'quantity' => abs($quantityChange),
                'date' => now(),
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
<?php
namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $logs = InventoryLog::with('product')->get();
        return view('inventoryLog.index', compact('logs'));
    }

    public function create()
    {
        $products = Product::all();
        return view('inventoryLog.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'type' => 'required',
            'quantity' => 'required|integer|min:0', // Tambahkan validasi min:0
            'date' => 'required|date',
        ], [
            'product_id.required' => 'Product is required.',
            'type.required' => 'Type is required.',
            'quantity.required' => 'Quantity is required.',
            'quantity.integer' => 'Quantity must be an integer.',
            'quantity.min' => 'Quantity must be at least 0.', // Pesan kesalahan untuk min:0
            'date.required' => 'Date is required.',
            'date.date' => 'Date must be a valid date.',
        ]);

        InventoryLog::create($request->all());
        return redirect()->route('inventoryLog.index')->with('success', 'Inventory log added successfully.');
    }

    public function destroy(InventoryLog $inventoryLog)
    {
        $inventoryLog->delete();
        return redirect()->route('inventoryLog.index')->with('success', 'Inventory log deleted successfully.');
    }
}
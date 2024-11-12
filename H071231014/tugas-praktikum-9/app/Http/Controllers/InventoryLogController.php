<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryLogController extends Controller
{
    public function index(Product $product)
    {
        $logs = InventoryLog::where('product_id', $product->id)->get();
        return view('inventory.index', compact('product', 'logs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:restock,sold',
            'quantity' => 'required|integer|min:1',
        ]);

       
        InventoryLog::create([
            'product_id' => $request->product_id,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'date' => now(),
        ]);

    
        $product = Product::find($request->product_id);
        if ($request->type === 'restock') {
            $product->stock += $request->quantity;
        } elseif ($request->type === 'sold') {
            $product->stock -= $request->quantity;
        }
        $product->save();

        return redirect()->route('inventory.index', $product)->with('success', 'Inventory log created successfully.');
    }

    
    public function destroy(InventoryLog $inventoryLog)
    {
        $inventoryLog->delete();
        return redirect()->route('inventory.index', $inventoryLog->product)->with('success', 'Inventory log deleted successfully.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryLogController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:restock,sold',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date'
        ]);

        $product = Product::findOrFail($request->product_id);
        
        if ($request->type === 'restock') {
            $product->stock += $request->quantity;
        } else {
            if ($product->stock < $request->quantity) {
                return back()->with('error', 'Insufficient stock');
            }
            $product->stock -= $request->quantity;
        }

        $product->save();
        InventoryLog::create($request->all());

        return back()->with('success', 'Inventory updated successfully');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryLogController extends Controller
{
    public function index()
    {
        $logs = InventoryLog::with('product')->orderBy('date', 'desc')->get();
        return view('inventory_logs.index', compact('logs'));
    }

    public function create()
    {
        $products = Product::all();
        return view('inventory_logs.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:restock,sold',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $product = Product::findOrFail($request->product_id);

                if ($request->type === 'sold' && $product->stock < $request->quantity) {
                    throw new \Exception('Stok yang tersedia tidak mencukupi.');
                }

                // Update product stock
                $product->stock += ($request->type === 'restock' ? $request->quantity : -$request->quantity);
                $product->save();

                // Create inventory log
                InventoryLog::create([
                    'product_id' => $request->product_id,
                    'type' => $request->type,
                    'quantity' => $request->quantity,
                    'date' => now(),
                ]);
            });

            return redirect()->route('inventory-logs.index')
                ->with('success', 'Log Inventoris berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['quantity' => $e->getMessage()]);
        }
    }

    public function destroy(InventoryLog $log)
    {
        try {
            $log->delete();
            return redirect()->route('inventory-logs.index')->with('success', 'Log inventaris berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus log inventaris.']);
        }
    }

}
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\InventoryLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $lowStockProducts = Product::where('stock', '<', 16)->count();
        
        $recentLogs = InventoryLog::with('product')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $lowStockProductsList = Product::where('stock', '<', 16)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'lowStockProducts',
            'recentLogs',
            'lowStockProductsList'
        ));
    }
}
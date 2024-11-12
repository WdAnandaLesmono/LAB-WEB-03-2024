<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\InventoryLogController;

// Route for products
Route::resource('products', ProductController::class);

// Route for categories
Route::resource('categories', CategoriesController::class);

// Route for inventory logs specific to each product
Route::get('products/{product}/inventory', [InventoryLogController::class, 'index'])->name('inventory.index');
Route::post('inventory/store', [InventoryLogController::class, 'store'])->name('inventory.store');

// Main route redirects to products page
Route::get('/', function () {
    return redirect()->route('products.index');
});
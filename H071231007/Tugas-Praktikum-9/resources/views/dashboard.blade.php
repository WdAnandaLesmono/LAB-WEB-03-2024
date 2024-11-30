@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-8">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm uppercase tracking-wider">Total Products</p>
                        <p class="text-white text-3xl font-bold mt-1">{{ $totalProducts }}</p>
                    </div>
                    <div class="bg-blue-400 bg-opacity-30 rounded-full p-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-8">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm uppercase tracking-wider">Total Categories</p>
                        <p class="text-white text-3xl font-bold mt-1">{{ $totalCategories }}</p>
                    </div>
                    <div class="bg-yellow-600 bg-opacity-30 rounded-full p-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-8">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm uppercase tracking-wider">Low Stock Alert</p>
                        <p class="text-white text-3xl font-bold mt-1">{{ $lowStockProducts }}</p>
                    </div>
                    <div class="bg-red-400 bg-opacity-30 rounded-full p-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800">Recent Activities</h3>
            </div>
            <div class="p-6 max-h-80 overflow-y-auto">
                <div class="space-y-4">
                    @foreach($recentLogs as $log)
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">{{ $log->product->name }}</p>
                            <p class="text-sm text-gray-500">
                                {{ ucfirst($log->type) }}: {{ $log->quantity }} units
                            </p>
                            <p class="text-xs text-gray-400 mt-1">{{ $log->date }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800">Low Stock Alerts</h3>
            </div>
            <div class="p-6 max-h-80 overflow-y-auto">
                <div class="space-y-4">
                    @foreach($lowStockProductsList as $product)
                    <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $product->name }}</p>
                                <p class="text-sm text-red-600">Stock: {{ $product->stock }} units</p>
                            </div>
                        </div>
                        <button type="button" 
                                class="px-3 py-1 text-sm text-red-600 border border-red-200 rounded-md hover:bg-red-100 transition-colors duration-150"
                                data-bs-toggle="modal" 
                                data-bs-target="#inventoryModal{{ $product->id }}">
                            Restock
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
                @foreach($lowStockProductsList as $product)
                <div class="modal fade" id="inventoryModal{{ $product->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content rounded-lg shadow-lg">
                            <div class="modal-header border-b bg-gray-50 p-4 rounded-t-lg">
                                <h5 class="text-lg font-semibold text-gray-800">Update Inventory: {{ $product->name }}</h5>
                                <button type="button" class="text-gray-400 hover:text-gray-500" data-bs-dismiss="modal">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="modal-body p-6">
                                <form action="{{ route('inventory-logs.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="type" value="restock">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                                        <input type="number" name="quantity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required min="1">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                                        <input type="date" name="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="mt-6 flex justify-end space-x-3">
                                        <button type="button" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50" data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium transition-colors duration-150">
                                            Update Stock
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
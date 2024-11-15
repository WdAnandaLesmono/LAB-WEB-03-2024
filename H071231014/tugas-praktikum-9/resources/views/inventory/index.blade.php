@extends('layouts.app')

@section('title', 'Inventory Log')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Inventory Log - {{ $product->name }}</h1>
        <div class="pastel-yellow px-4 py-2 rounded-lg">
            Current Stock: {{ $product->stock }}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="pastel-blue p-4 rounded-lg">
            <h2 class="font-bold mb-4">Add Stock</h2>
            <form action="{{ route('inventory.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="type" value="restock">
                <div class="flex space-x-2">
                    <input type="number" name="quantity" class="form-input rounded-lg border-gray-300 flex-1" min="1" required>
                    <button type="submit" class="px-4 py-2 bg-green-100 hover:bg-green-200 rounded-lg">
                        Add Stock
                    </button>
                </div>
            </form>
        </div>

        <div class="pastel-pink p-4 rounded-lg">
            <h2 class="font-bold mb-4">Reduce Stock</h2>
            <form action="{{ route('inventory.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="type" value="sold">
                <div class="flex space-x-2">
                    <input type="number" name="quantity" class="form-input rounded-lg border-gray-300 flex-1" min="1" required>
                    <button type="submit" class="px-4 py-2 bg-red-100 hover:bg-red-200 rounded-lg">
                        Reduce Stock
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="pastel-purple">
                <tr>
                    <th class="px-6 py-3 text-left text-gray-700">Date</th>
                    <th class="px-6 py-3 text-left text-gray-700">Type</th>
                    <th class="px-6 py-3 text-left text-gray-700">Quantity</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($logs as $log)
                <tr>
                    <td class="px-6 py-4">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full {{ $log->type === 'restock' ? 'pastel-mint' : 'bg-red-100' }}">
                            {{ ucfirst($log->type) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $log->quantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
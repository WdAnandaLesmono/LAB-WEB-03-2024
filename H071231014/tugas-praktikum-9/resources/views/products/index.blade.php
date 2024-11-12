@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Products</h1>
        <a href="{{ route('products.create') }}" class="pastel-blue hover:bg-blue-200 px-4 py-2 rounded-lg text-gray-700">
            Add Product
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="pastel-purple">
                <tr>
                    <th class="px-6 py-3 text-left text-gray-700">Name</th>
                    <th class="px-6 py-3 text-left text-gray-700">Category</th>
                    <th class="px-6 py-3 text-left text-gray-700">Price</th>
                    <th class="px-6 py-3 text-left text-gray-700">Stock</th>
                    <th class="px-6 py-3 text-left text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($products as $product)
                <tr>
                    <td class="px-6 py-4">{{ $product->name }}</td>
                    <td class="px-6 py-4">{{ $product->categories->name ?? 'No Category' }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full {{ $product->stock > 10 ? 'pastel-mint' : 'bg-red-100' }}">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('inventory.index', $product) }}" class="text-green-600 hover:text-green-800">
                                <i class="fas fa-box"></i>
                            </a>
                            <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

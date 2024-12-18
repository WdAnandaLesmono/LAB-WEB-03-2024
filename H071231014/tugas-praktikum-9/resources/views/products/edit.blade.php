@extends('layouts.app')

@section('title', 'Ubah Produk')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Ubah Produk</h1>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="category_id" class="block font-medium text-gray-700 mb-2">Kategori</label>
            <select id="category_id" name="category_id" class="form-select rounded-lg border-gray-300 w-full" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="name" class="block font-medium text-gray-700 mb-2">Nama</label>
            <input type="text" id="name" name="name" value="{{ $product->name }}" class="form-input rounded-lg border-gray-300 w-full" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea id="description" name="description" rows="3" class="form-textarea rounded-lg border-gray-300 w-full">{{ $product->description }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="price" class="block font-medium text-gray-700 mb-2">Harga</label>
                <input type="number" id="price" name="price" step="0.01" value="{{ $product->price }}" class="form-input rounded-lg border-gray-300 w-full" required>
            </div>
            <div>
                <label for="stock" class="block font-medium text-gray-700 mb-2">Stok</label>
                <input type="number" id="stock" name="stock" value="{{ $product->stock }}" class="form-input rounded-lg border-gray-300 w-full" required>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="pastel-blue hover:bg-blue-200 px-4 py-2 rounded-lg text-gray-700">
                Perbarui
            </button>
        </div>
    </form>
</div>
@endsection
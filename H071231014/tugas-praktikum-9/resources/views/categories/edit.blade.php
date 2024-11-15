@extends('layouts.app')

@section('title', 'Ubah Kategori')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Ubah Kategori</h1>

    <form action="{{ route('categories.update', $categories
    ) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block font-medium text-gray-700 mb-2">Nama</label>
            <input type="text" id="name" name="name" value="{{ $categories->name }}" class="form-input rounded-lg border-gray-300 w-full" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea id="description" name="description" rows="3" class="form-textarea rounded-lg border-gray-300 w-full">{{ $categories
            ->description }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="pastel-blue hover:bg-blue-200 px-4 py-2 rounded-lg text-gray-700">
                Perbarui
            </button>
        </div>
    </form>
</div>
@endsection
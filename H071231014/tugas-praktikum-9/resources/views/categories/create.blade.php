@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Kategori</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block font-medium text-gray-700 mb-2">Nama</label>
            <input type="text" id="name" name="name" class="form-input rounded-lg border-gray-300 w-full" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea id="description" name="description" rows="3" class="form-textarea rounded-lg border-gray-300 w-full"></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="pastel-blue hover:bg-blue-200 px-4 py-2 rounded-lg text-gray-700">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
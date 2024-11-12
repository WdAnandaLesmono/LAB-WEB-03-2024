@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Categories</h1>
        <a href="{{ route('categories.create') }}" class="pastel-blue hover:bg-blue-200 px-4 py-2 rounded-lg text-gray-700">
            Add Category
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="pastel-purple">
                <tr>
                    <th class="px-6 py-3 text-left text-gray-700">Name</th>
                    <th class="px-6 py-3 text-left text-gray-700">Description</th>
                    <th class="px-6 py-3 text-left text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($categories as $categories)
                <tr>
                    <td class="px-6 py-4">{{ $categories->name }}</td>
                    <td class="px-6 py-4">{{ $categories->description }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('categories.edit', $categories) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('categories.destroy', $categories) }}" method="POST" class="inline">
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
@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Categories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> <!-- Ikon edit -->
                        </a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> <!-- Ikon delete -->
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
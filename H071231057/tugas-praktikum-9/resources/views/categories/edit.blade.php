@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit Category</h1>
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control">{{ $category->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update Category</button>
    </form>
@endsection
@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit Product</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf 
        @method('PUT')
        <div class="form-group mb-3">
            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update Product</button>
    </form>

    
@endsection
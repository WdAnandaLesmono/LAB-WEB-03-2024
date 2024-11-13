@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ number_format($product->price, 2, ',', '.') }}</td> <!-- Format harga -->
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> <!-- Ikon edit -->
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
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
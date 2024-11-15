@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Add Inventory Log</h1>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{ route('inventoryLog.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="product_id">Product:</label>
            <select id="product_id" name="product_id" class="form-control" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="type">Type:</label>
            <select id="type" name="type" class="form-control" required>
                <option value="restock">Restock</option>
                <option value="sold">Sold</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add Inventory Log</button>
    </form>
@endsection
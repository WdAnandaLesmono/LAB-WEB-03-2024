@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Add Category</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Add Category</button>
    </form>
@endsection
@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">

        <div>
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-5xl font-bold text-[#367a7f]">Manajemen Produk</h2>
            <a href="{{ route('products.create') }}"
                style="padding: 10px; background-color:#367a7f; border-radius: 10px; color: #fff">
                <i class="fas fa-plus"></i> Produk
            </a>
        </div>

        <div
            class="bg-white shadow overflow-hidden sm:rounded-md [--shadow:rgba(60,64,67,0.3)_0_1px_2px_0,rgba(60,64,67,0.15)_0_2px_6px_2px]  rounded-2xl bg-white [box-shadow:var(--shadow)]">
            <div class="px-4 py-5 sm:px-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-lx font-large text-[#367a7f] uppercase tracking-wider">
                                Nama
                            </th>
                            <th class="px-6 py-3 text-center text-lx font-large text-[#367a7f] uppercase tracking-wider">
                                Kategori</th>
                            <th class="px-6 py-3 text-center text-lx font-large text-[#367a7f] uppercase tracking-wider">
                                Deskripsi</th>
                            <th class="px-6 py-3 text-center text-lx font-large text-[#367a7f] uppercase tracking-wider">
                                Harga
                            </th>
                            <th class="px-6 py-3 text-center text-lx font-large text-[#367a7f] uppercase tracking-wider">
                                Stok
                            </th>
                            <th class="px-6 py-3 text-center text-lx font-large text-[#367a7f] uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($products as $product)
                            <tr>
                                <td class="px-6 py-4 text-center whitespace-nowrap">{{ $product->name }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">{{ $product->category->name }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">{{ $product->description }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">Rp.
                                    {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">{{ $product->stock }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap text-right">
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-lx font-large text-white bg-indigo-600 hover:bg-indigo-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-lx font-large text-white bg-red-600 hover:bg-red-700">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cursor-pointer"
                                            onclick="return confirm('Anda yakin?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

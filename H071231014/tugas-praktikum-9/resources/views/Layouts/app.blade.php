<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kupliq Cafe - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dark-gray { background-color: #333333; }
        .light-gray { background-color: #D3D3D3; }
        .pastel-yellow { background-color: #FFFACD; }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="dark-gray shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-white">☕ Kupliq Cafe</span>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('categories.index') }}" class="text-white hover:text-yellow-300 px-3 py-2 rounded-md text-sm font-medium">Categories</a>
                    <a href="{{ route('products.index') }}" class="text-white hover:text-yellow-300 px-3 py-2 rounded-md text-sm font-medium">Products</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 py-6">
        @if(session('success'))
            <div class="light-gray mb-4 p-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 mb-4 p-4 rounded-lg text-red-700">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>

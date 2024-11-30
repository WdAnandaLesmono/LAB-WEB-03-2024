<nav class="bg-gradient-to-r from-blue-500 to-blue-400 shadow-lg mb-4">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <img src="{{ asset('img/Logo-Indomaret.png') }}" alt="Indomaret Logo" class="h-8 w-auto mr-3">
                <h1 class="text-xl font-bold text-white">Indomaret <span class="text-gray-200">Product Management</span></h1>
            </div>

            <div class="flex items-center space-x-6">
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-3 py-2 rounded-md transition duration-150 ease-in-out
                          {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-100 hover:text-blue-200 hover:bg-blue-500' }}">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                
                <a href="{{ route('products.index') }}" 
                   class="flex items-center px-3 py-2 rounded-md transition duration-150 ease-in-out
                          {{ request()->routeIs('products.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-100 hover:text-blue-200 hover:bg-blue-500' }}">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    Products
                </a>
                
                <a href="{{ route('categories.index') }}" 
                   class="flex items-center px-3 py-2 rounded-md transition duration-150 ease-in-out
                          {{ request()->routeIs('categories.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-100 hover:text-blue-200 hover:bg-blue-500' }}">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    Categories
                </a>
            </div>
        </div>
    </div>
</nav>
<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <!-- Header dengan judul dan tombol tambah -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">📦 Daftar Produk</h1>
                <p class="text-gray-600 mt-2">Temukan produk terbaik dengan berbagai pilihan kategori</p>
            </div>
            <a href="{{ route('products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition duration-300 shadow-md">
                ➕ Tambah Produk Baru
            </a>
        </div>

        <!-- Card Fitur Pencarian dan Filter -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">🔍 Cari & Filter Produk</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Form Pencarian -->
                <div>
                    <form action="{{ route('products.search') }}" method="GET" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian Produk</label>
                            <div class="flex">
                                <input 
                                    type="text" 
                                    name="search" 
                                    class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                    placeholder="Cari berdasarkan nama atau deskripsi..."
                                    value="{{ request('search') ?? '' }}"
                                >
                                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-r-lg hover:bg-blue-700 transition duration-300">
                                    Cari
                                </button>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">Masukkan kata kunci nama atau deskripsi produk</p>
                        </div>
                    </form>
                </div>

                <!-- Form Filter Harga -->
                <div>
                    <form action="{{ route('products.filter') }}" method="GET" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Filter Range Harga</label>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <input 
                                        type="number" 
                                        name="min_price" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                                        placeholder="Harga Minimal"
                                        value="{{ request('min_price') ?? '' }}"
                                        min="0"
                                    >
                                </div>
                                <div>
                                    <input 
                                        type="number" 
                                        name="max_price" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                                        placeholder="Harga Maksimal"
                                        value="{{ request('max_price') ?? '' }}"
                                        min="0"
                                    >
                                </div>
                            </div>
                            <button type="submit" class="w-full mt-4 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition duration-300">
                                🔍 Terapkan Filter
                            </button>
                            <p class="text-sm text-gray-500 mt-2">Atur rentang harga untuk menyaring produk</p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tombol Reset -->
            <div class="mt-6 text-center">
                <a href="{{ route('products.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Reset Pencarian & Filter
                </a>
            </div>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-6">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <span class="text-blue-600 text-2xl">📊</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total Produk</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $products->total() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-xl p-6">
                <div class="flex items-center">
                    <div class="bg-green-100 p-3 rounded-lg mr-4">
                        <span class="text-green-600 text-2xl">💰</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Rentang Harga</p>
                        <p class="text-2xl font-bold text-gray-800">
                            @if(request('min_price') || request('max_price'))
                                Rp {{ number_format(request('min_price', 0), 0, ',', '.') }} - Rp {{ number_format(request('max_price', 10000000), 0, ',', '.') }}
                            @else
                                Semua Harga
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-purple-50 to-purple-100 border border-purple-200 rounded-xl p-6">
                <div class="flex items-center">
                    <div class="bg-purple-100 p-3 rounded-lg mr-4">
                        <span class="text-purple-600 text-2xl">🔍</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Hasil Pencarian</p>
                        <p class="text-2xl font-bold text-gray-800">
                            {{ request('search') ? '"' . request('search') . '"' : 'Semua Produk' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Produk -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 border border-gray-100">
                    <!-- Badge Kategori -->
                    <div class="px-4 pt-4">
                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                            @if($product->category_id == 1) bg-blue-100 text-blue-800 
                            @elseif($product->category_id == 2) bg-pink-100 text-pink-800 
                            @else bg-green-100 text-green-800 
                            @endif">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </span>
                    </div>
                    
                    <!-- Konten Produk -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($product->description, 120) }}</p>
                        
                        <!-- Harga -->
                        <div class="mb-4">
                            <p class="text-2xl font-bold text-green-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-500">Stok: <span class="font-semibold">{{ $product->stock }}</span> unit</p>
                        </div>
                        
                        <!-- Tombol Aksi -->
                        <div class="flex space-x-3">
                            <a href="{{ route('products.show', $product->id) }}" 
                               class="flex-1 bg-blue-50 text-blue-600 hover:bg-blue-100 px-4 py-2 rounded-lg text-center font-medium transition duration-300">
                                👁️ Detail
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" 
                               class="flex-1 bg-yellow-50 text-yellow-600 hover:bg-yellow-100 px-4 py-2 rounded-lg text-center font-medium transition duration-300">
                                ✏️ Edit
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        @else
            <!-- Tidak ada hasil -->
            <div class="text-center py-16 bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl border border-gray-200">
                <div class="text-6xl mb-6">😞</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Produk Tidak Ditemukan</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    @if(request('search'))
                        Tidak ada produk dengan kata kunci "{{ request('search') }}"
                    @elseif(request('min_price') || request('max_price'))
                        Tidak ada produk dalam rentang harga yang dipilih
                    @else
                        Belum ada produk yang tersedia
                    @endif
                </p>
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Lihat Semua Produk
                </a>
            </div>
        @endif

        <!-- Footer Info -->
        <div class="mt-12 text-center text-gray-500 text-sm">
            <p>✨ Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk 
                @if(request('search')) dengan pencarian "{{ request('search') }}" @endif
                @if(request('min_price') || request('max_price')) dalam rentang harga tertentu @endif
            </p>
        </div>
    </div>

    <style>
        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        .shadow-hover:hover {
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .transition {
            transition: all 0.3s ease;
        }
    </style>
</x-layouts.app>
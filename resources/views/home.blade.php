<x-template title="Home">
    <!-- Hero Section -->
    <div class="hero-section text-center py-5 bg-light rounded mb-5" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
        <h1 class="display-4 fw-bold">Welcome to Cake & Bakery Store</h1>
        <p class="lead">Freshly baked cakes, pastries, and breads delivered to your door.</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Shop Now</a>
    </div>

    <!-- Categories -->
    <h2 class="mb-4">🍰 Our Categories</h2>
    <div class="row mb-5">
        @foreach($categories as $category)
        <div class="col-md-2 mb-3">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->name }}</h5>
                    <p class="text-muted">{{ $category->products_count }} products</p>
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="btn btn-outline-primary btn-sm">Browse</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Featured Products -->
    <h2 class="mb-4">⭐ Featured Products</h2>
    <div class="row mb-5">
        @foreach($featuredProducts as $product)
        <div class="col-md-2 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <span class="badge bg-warning">Featured</span>
                    <h6 class="card-title mt-2">{{ Str::limit($product->name, 20) }}</h6>
                    <p class="text-success fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Latest Products -->
    <h2 class="mb-4">🆕 New Arrivals</h2>
    <div class="row">
        @foreach($latestProducts as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <span class="badge bg-info">New</span>
                    <h6 class="card-title mt-2">{{ $product->name }}</h6>
                    <p class="text-muted small">{{ Str::limit($product->description, 40) }}</p>
                    <p class="text-success fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-primary">Buy Now</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Call to Action -->
    <div class="text-center mt-5 py-5 bg-dark text-white rounded">
        <h2>Ready to Order?</h2>
        <p>Get fresh bakery items delivered in less than 2 hours.</p>
        <a href="{{ route('products.index') }}" class="btn btn-light btn-lg">Browse All Products</a>
    </div>
</x-template>
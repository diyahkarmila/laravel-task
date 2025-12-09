<x-template title="Product List">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>🍰 Our Cakes & Bakery</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">➕ Add New Product</a>
    </div>

    <!-- Search & Filter Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('products.index') }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Search</label>
                        <input type="text" name="search" class="form-control" placeholder="Name or description..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Min Price</label>
                        <input type="number" name="min_price" class="form-control" placeholder="Min" value="{{ request('min_price') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Max Price</label>
                        <input type="number" name="max_price" class="form-control" placeholder="Max" value="{{ request('max_price') }}">
                    </div>

                    <div class="col-md-2 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100">Filter</button>
                    </div>
                </div>

                <!-- Reset Button -->
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Sort By</label>
                        <select name="sort" class="form-select" onchange="this.form.submit()">
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
                        </select>
                    </div>

                    <div class="col-md-2 d-flex align-items-end mt-3">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- Results Info -->
    <div class="alert alert-info mb-3">
        Found <strong>{{ $products->total() }}</strong> product(s)
        @if(request('search')) matching "<strong>{{ request('search') }}</strong>" @endif
    </div>

    <!-- Product Grid -->
    <div class="row">
        @forelse($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <span class="badge bg-secondary">{{ $product->category->name }}</span>
                    <h5 class="card-title mt-2">{{ $product->name }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($product->description, 50) }}</p>
                    <h6 class="text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</h6>
                    <div class="mt-3">
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning">No products found.</div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $products->withQueryString()->links() }}
    </div>
</x-template>

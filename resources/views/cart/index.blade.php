<x-template title="Shopping Cart">
    <div class="container py-4">
        <h1 class="mb-4">🛒 Shopping Cart</h1>

        @if($items->isEmpty())
            <div class="alert alert-info">
                Your cart is empty. <a href="{{ route('products.index') }}">Browse products</a>
            </div>
        @else
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-body">
                            @foreach($items as $item)
                            <div class="row mb-3 pb-3 border-bottom">
                                <div class="col-3">
                                    <img src="https://via.placeholder.com/100x100" class="img-fluid rounded" alt="{{ $item->product->name }}">
                                </div>
                                <div class="col-6">
                                    <h5>{{ $item->product->name }}</h5>
                                    <p class="text-muted small">{{ Str::limit($item->product->description, 50) }}</p>
                                    <p class="text-success fw-bold">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                </div>
                                <div class="col-3">
                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm d-inline-block w-50" onchange="this.form.submit()">
                                    </form>
                                    <form action="{{ route('cart.destroy', $item) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">❌</button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Order Summary</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <tr>
                                    <td>Subtotal</td>
                                    <td class="text-end">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td class="text-end">Rp 15.000</td>
                                </tr>
                                <tr class="table-active">
                                    <th>Total</th>
                                    <th class="text-end">Rp {{ number_format($total + 15000, 0, ',', '.') }}</th>
                                </tr>
                            </table>
                            <a href="{{ route('orders.create') }}" class="btn btn-success w-100">Proceed to Checkout</a>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100 mt-2">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-template>
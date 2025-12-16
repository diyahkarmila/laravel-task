<x-template title="Checkout">
    <div class="container py-4">
        <h1 class="mb-4">✅ Checkout</h1>

        <div class="row">
            <div class="col-md-7">
                <div class="card shadow mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Shipping Address</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Full Address *</label>
                                <textarea name="shipping_address" class="form-control" rows="3" required placeholder="Street, City, Postal Code">{{ old('shipping_address') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Payment Method *</label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="">Select method</option>
                                    <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                    <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="cash_on_delivery" {{ old('payment_method') == 'cash_on_delivery' ? 'selected' : '' }}>Cash on Delivery</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success btn-lg">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        @foreach($items as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <strong>{{ $item->product->name }}</strong>
                                <br>
                                <small>{{ $item->quantity }} x Rp {{ number_format($item->product->price, 0, ',', '.') }}</small>
                            </div>
                            <div>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                        </div>
                        @endforeach

                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>Subtotal</strong>
                            <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Shipping</span>
                            <span>Rp 15.000</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fs-5">
                            <strong>Total</strong>
                            <strong class="text-success">Rp {{ number_format($total + 15000, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-template>
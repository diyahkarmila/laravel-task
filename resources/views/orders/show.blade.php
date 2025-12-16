<x-template title="Order {{ $order->order_number }}">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Order #{{ $order->order_number }}</h1>
            <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }} fs-6">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Order Items</h5>
                    </div>
                    <div class="card-body">
                        @foreach($order->items as $item)
                        <div class="row mb-3 border-bottom pb-3">
                            <div class="col-3">
                                <img src="https://via.placeholder.com/80x80" class="img-fluid rounded" alt="{{ $item->product->name }}">
                            </div>
                            <div class="col-6">
                                <h6>{{ $item->product->name }}</h6>
                                <p class="text-muted small">{{ $item->product->description }}</p>
                            </div>
                            <div class="col-3 text-end">
                                <p>{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                <strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Order Details</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                        <p><strong>Payment Method:</strong> {{ str_replace('_', ' ', ucfirst($order->payment_method)) }}</p>
                        <hr>
                        <h6>Shipping Address</h6>
                        <p class="text-muted">{{ $order->shipping_address }}</p>
                        <hr>
                        <table class="table table-sm">
                            <tr>
                                <td>Subtotal</td>
                                <td class="text-end">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Shipping</td>
                                <td class="text-end">Rp 15.000</td>
                            </tr>
                            <tr class="table-active">
                                <th>Total</th>
                                <th class="text-end">Rp {{ number_format($order->total_amount + 15000, 0, ',', '.') }}</th>
                            </tr>
                        </table>
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary w-100">Back to Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-template>
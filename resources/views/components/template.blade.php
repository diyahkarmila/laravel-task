<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake & Bakery Store @isset($title) - {{ $title }} @endisset</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <a class="navbar-brand" href="{{ route('home') }}">🍰 CakeStore</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- MENU KIRI (Home, Products, Cart, Orders) --}}
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                    </li>
                    @auth
                    {{-- Link ini hanya muncul saat login --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            🛒 Cart
                            @php
                                // PERBAIKAN ERROR: Menggunakan null check pada objek Cart
                                $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
                                // Jika $cart ada, hitung itemsnya. Jika tidak, set ke 0.
                                $cartCount = $cart ? $cart->items->count() : 0;
                            @endphp
                            @if($cartCount > 0)
                            <span class="badge bg-danger">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.index') }}">My Orders</a>
                    </li>
                    @endauth
                </ul>

                {{-- MENU KANAN (Login, Register, Logout) --}}
                <ul class="navbar-nav ms-auto">
                    @guest
                        {{-- Tombol Register dan Login hanya muncul saat BELUM login --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @else
                        {{-- Tombol Logout muncul saat SUDAH login --}}
                        <li class="nav-item">
                            {{-- Gunakan formulir POST untuk Logout sesuai standar keamanan Laravel --}}
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn nav-link">Logout ({{ Auth::user()->name }})</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>

        </div>
    </nav>

    <div class="container mt-4">
        {{ $slot }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
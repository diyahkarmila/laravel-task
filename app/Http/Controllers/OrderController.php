<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $items = $cart->items()->with('product')->get();
        $total = $cart->total;

        return view('orders.create', compact('cart', 'items', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|min:10',
            'payment_method' => 'required|in:bank_transfer,credit_card,cash_on_delivery'
        ]);

        $cart = Cart::where('user_id', Auth::id())->first();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        DB::beginTransaction();
        try {
            // Buat order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
                'total_amount' => $cart->total,
                'status' => 'pending'
            ]);

            // Pindahkan item dari cart ke order
            foreach ($cart->items as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price
                ]);

                // Optional: Kurangi stok produk jika ada
                // $product = $cartItem->product;
                // $product->decrement('stock', $cartItem->quantity);
            }

            // Kosongkan cart
            $cart->items()->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')
                ->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function show(Order $order)
    {
        // Pastikan order milik user yang login
        if ($order->user_id != Auth::id()) {
            abort(403);
        }

        $order->load('items.product');

        return view('orders.show', compact('order'));
    }
}
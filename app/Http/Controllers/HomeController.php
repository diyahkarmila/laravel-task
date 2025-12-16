<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// --- IMPORT MODEL YANG DIBUTUHKAN ---
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware ini memastikan user harus login sebelum mengakses /home
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 1. Muat Categories (dengan hitungan produk)
        // Kita menggunakan 'withCount' agar kita bisa mengakses $category->products_count di view
        $categories = Category::withCount('products')->get();

        // 2. Muat Featured Products (Contoh: Ambil 4 produk acak)
        $featuredProducts = Product::inRandomOrder()->limit(4)->get();

        // 3. Muat Latest Products (Contoh: Ambil 4 produk terbaru)
        $latestProducts = Product::orderBy('created_at', 'desc')->limit(4)->get();

        // Kirim semua data ke view
        return view('home', compact('categories', 'featuredProducts', 'latestProducts'));
    }
}
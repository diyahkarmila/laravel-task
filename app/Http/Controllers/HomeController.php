<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::inRandomOrder()->limit(6)->get();
        $categories = Category::withCount('products')->get();
        $latestProducts = Product::latest()->limit(4)->get();

        return view('home', compact('featuredProducts', 'categories', 'latestProducts'));
    }
}
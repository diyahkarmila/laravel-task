<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan semua produk dengan fitur pencarian dan filter
    public function index(Request $request)
    {
        $query = Product::with('category');
        
        // Fitur pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Fitur filter harga
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }
        
        $products = $query->latest()->paginate(12);
        $categories = Category::all();
        
        return view('products.list', compact('products', 'categories'));
    }
    
    // Fitur pencarian khusus
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        $products = Product::with('category')
            ->where('name', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%")
            ->latest()
            ->paginate(12);
            
        $categories = Category::all();
        
        return view('products.list', compact('products', 'categories', 'search'));
    }
    
    // Fitur filter range harga khusus
    public function filter(Request $request)
    {
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', 10000000);
        
        $products = Product::with('category')
            ->whereBetween('price', [$minPrice, $maxPrice])
            ->latest()
            ->paginate(12);
            
        $categories = Category::all();
        
        return view('products.list', compact('products', 'categories', 'minPrice', 'maxPrice'));
    }
    
    // Method lainnya (create, edit, store, update, show)
    public function create()
    {
        return view('products.form');
    }
    
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.form', compact('product'));
    }
    
    public function store(Request $request)
    {
        // Validasi dan simpan produk
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
        ]);
        
        Product::create($validated);
        
        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }
    
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
        ]);
        
        $product->update($validated);
        
        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }
    
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
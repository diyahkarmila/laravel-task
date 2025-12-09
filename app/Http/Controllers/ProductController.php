<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter price range
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }

        // Sort
        $sort = $request->get('sort', 'name_asc');
        switch ($sort) {
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default: // name_asc
                $query->orderBy('name', 'asc');
                break;
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('products.list', compact('products', 'categories'));
    }

    public function create()
    {
        return view('products.form');
    }

    public function store(Request $request)
    {
        // Simulasi penyimpanan
        return redirect()->route('products.index')
            ->with('success', 'Product added successfully!');
    }

    public function show($id)
    {
        $product = [
            'id' => $id,
            'name' => "Cake Product $id",
            'description' => "Detail of delicious cake $id",
            'price' => rand(50, 200) * 1000,
        ];
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = [
            'id' => $id,
            'name' => "Cake Product $id",
            'description' => "Edit this delicious cake $id",
            'price' => rand(50, 200) * 1000,
        ];
        return view('products.form', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Simulasi update
        return redirect()->route('products.index')
            ->with('success', "Product $id updated successfully!");
    }
}
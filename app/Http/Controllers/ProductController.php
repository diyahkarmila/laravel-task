<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ProductController extends Controller{
    public function index(){ 
        $products=collect(); for($i=1;$i<=20;$i++){
            $products->push(['id'=>$i,'name'=>"Product $i",'description'=>"Description for product $i",'price'=>rand(10000,100000)]);
        } 
        
        return view('products.list',compact('products'));
    }

    public function create(){ 
        return view('products.form');
    }

    public function edit($id){ 
        $product=[
            'id'=>$id,
            'name'=>"Product 
            $id",'description'=>"Description for product $id",
            'price'=>rand(10000,100000)
        ]; 
        return view('products.form',compact('product'));
    }
    public function show($id){ 
        $product=[
            'id'=>$id,
            'name'=>"Product $id",
            'description'=>"Description for product $id",
            'price'=>rand(10000,100000)
        ]; 
            return view('products.show',compact('product'));}
    public function store(Request $r){ 
        return redirect()->route('products');
    }
    public function update(Request $r,$id){ 
        return redirect()->route('products');
    }
}
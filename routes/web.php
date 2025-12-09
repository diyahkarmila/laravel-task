<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;

// ROUTE HOME
Route::get('/', [HomeController::class, 'index'])->name('home');

// ROUTES PRODUCTS
Route::prefix('products')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('products.index');
    Route::get('/create', 'create')->name('products.create');
    Route::post('/store', 'store')->name('products.store');
    Route::get('/show/{id}', 'show')->name('products.show');
    Route::get('/edit/{id}', 'edit')->name('products.edit');
    Route::post('/update/{id}', 'update')->name('products.update');
});

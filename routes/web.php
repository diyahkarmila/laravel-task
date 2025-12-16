<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// ROUTE AUTHENTICATION CONTROLLERS
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController; 


// ROUTE HOME
Route::get('/', [HomeController::class, 'index'])->name('home');

// SOLUSI: Tambahkan rute '/home' yang di-redirect secara default setelah login/register, agar tidak 404.
Route::get('/home', [HomeController::class, 'index'])->name('home.redirect');


// ROUTES PRODUCTS
Route::prefix('products')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('products.index');
    Route::get('/create', 'create')->name('products.create');
    Route::post('/store', 'store')->name('products.store');
    Route::get('/show/{id}', 'show')->name('products.show');
    Route::get('/edit/{id}', 'edit')->name('products.edit');
    Route::post('/update/{id}', 'update')->name('products.update');
});

// Keranjang & Order (hanya untuk user login)
Route::middleware(['auth'])->group(function () {
    // Cart Routes
    Route::prefix('cart')->controller(CartController::class)->group(function () {
        Route::get('/', 'index')->name('cart.index');
        Route::post('/add/{product}', 'store')->name('cart.store');
        Route::put('/update/{cartItem}', 'update')->name('cart.update');
        Route::delete('/remove/{cartItem}', 'destroy')->name('cart.destroy');
    });

    // Order Routes
    Route::prefix('orders')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index')->name('orders.index');
        Route::get('/create', 'create')->name('orders.create');
        Route::post('/', 'store')->name('orders.store');
        Route::get('/{order}', 'show')->name('orders.show');
    });
});

// ROUTE AUTHENTICATION (Login, Register, Logout)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register'); 
Route::post('/register', [RegisterController::class, 'register']); 

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
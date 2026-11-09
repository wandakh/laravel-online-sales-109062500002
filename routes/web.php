<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\ProductCatalogController;
use app\Http\Controllers\CartController;

Route::get('/', function () {
    return 'Halaman Katalog Produk (Akan dibangun di Milestone 4)';
})->name('shop.index');

Route::middleware('guest')->group(function () { 
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); 
    Route::post('/login', [AuthController::class, 'login'])->name('login.store'); 
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register'); 
    Route::post('/register', [AuthController::class, 'register'])->name('register.store'); 
}); 
 
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth','role:admin'])->group(function () { 
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index'); 
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store'); 
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update'); 
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy'); 
    // Route::resource('products', AdminProductController::class)->except('show'); 
});
Route::middleware(['auth','role:customer'])->group(function () { 
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index'); 
    Route::post('/keranjang/{product}', [CartController::class, 'store'])->name('cart.store'); 
    Route::patch('/keranjang/{product}', [CartController::class, 'update'])->name('cart.update'); 
    Route::delete('/keranjang/{product}', [CartController::class, 'destroy'])->name('cart.destroy'); 
}); 

Route::get('/', [ProductCatalogController::class, 'index'])->name('shop.index'); 
Route::get('/produk/{product:slug}', [ProductCatalogController::class, 'show'])->name('shop.show'); 
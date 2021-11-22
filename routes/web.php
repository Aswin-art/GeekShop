<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/shop', [ProdukController::class, 'index'])->name('shop');


Route::prefix('/user')->group(function(){
    Route::middleware('guest')->group(function(){
        Route::get('/login', [CustomerController::class, 'login'])->name('user.login');
        Route::get('/register', [CustomerController::class, 'register'])->name('user.register');
        Route::post('/login', [CustomerController::class, 'loginPost'])->name('user.login');
        Route::post('/register', [CustomerController::class, 'registerPost'])->name('user.register');
    });

    Route::middleware('auth')->group(function(){
        Route::post('/logout', [CustomerController::class, 'logout'])->name('user.logout');
        Route::get('/profile', [CustomerController::class, 'show'])->name('user.profile');
        Route::get('/admin', [CustomerController::class, 'index'])->name('user.admin');
    });
});

Route::prefix('/cart')->group(function(){
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::get('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/detail', [CartController::class, 'index'])->name('cart.detail');
    Route::post('/detail', [CartController::class, 'detail'])->name('cart.detail');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

Route::prefix('/produk')->middleware('auth')->group(function(){    
    Route::get('/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/create', [ProdukController::class, 'store'])->name('produk.create');

    Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/edit/{id}', [ProdukController::class, 'update'])->name('produk.update');

    Route::delete('/delete/{id}', [ProdukController::class, 'destroy'])->name('produk.delete');
});

Route::prefix('/kategori')->middleware('auth')->group(function(){
    Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/store', [KategoriController::class, 'store'])->name('kategori.store');

    Route::get('/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');

    Route::delete('/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.delete');
});

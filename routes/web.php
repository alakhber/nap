<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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
Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.home.index');
    });
    Route::get('product/all', [ProductController::class, 'index'])->name('product.all');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::patch('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

    Route::get('orders',[HomeController::class,'getOrder'])->name('getorders');
});

Route::prefix('cart')->name('cart.')->middleware('userControl')->group(function () {
    Route::post('addtocart', [CartController::class, 'addProduct'])->name('add');
    Route::patch('increment', [CartController::class, 'increment'])->name('increment');
    Route::patch('decrement', [CartController::class, 'decrement'])->name('decrement');
    Route::delete('removetocart', [CartController::class, 'removeProduct'])->name('remove');

});

Route::prefix('/shop')->name('shop.')->middleware('userControl')->group(function(){
    Route::get('/',[HomeController::class,'shop'])->name('shop');
    Route::post('/order',[HomeController::class,'addOrder'])->name('addOrder');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



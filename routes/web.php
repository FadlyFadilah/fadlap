<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController as ControllersProductController;
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
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('admin.')->group(function () {
    Route::prefix('admin')->middleware('auth')->group(function () {
        Route::resource('products', ProductController::class)->middleware('isAdmin');
        Route::get('{fileImage}', [ProductController::class, 'viewImages'])->name('image');
    });
});
Route::resource('orders', OrderController::class)->middleware('auth');

Route::get('/', [ControllersProductController::class, 'index'])->name('products.index');
Route::get('/product/{product}', [ControllersProductController::class, 'show'])->name('products.show');
Route::get('/product/img/{image}', [ControllersProductController::class, 'image'])->name('products.img');
Route::post('/product/reviews/{product:id}', [ProductReviewController::class, 'store'])->name('products.store')->middleware('auth');

Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
Route::get('/carts/add/{product:id}', [CartController::class, 'add'])->name('carts.add');
Route::patch('/carts/update', [CartController::class, 'update'])->name('carts.update');
Route::delete('/carts/remove', [CartController::class, 'remove'])->name('carts.remove');

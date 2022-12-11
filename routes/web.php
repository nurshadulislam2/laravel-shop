<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SlideController;
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

Route::get('/', [FrontController::class, 'index'])->name('/');
Route::get('/product/{id}', [FrontController::class, 'product'])->name('product');
Route::get('/category/{id}', [FrontController::class, 'category'])->name('category');
Route::get('/brand/{id}', [FrontController::class, 'brand'])->name('brand');
Route::get('/profile/', [FrontController::class, 'profile'])->name('profile');
Route::post('/profile/update', [FrontController::class, 'profileUpdate'])->name('profileupdate');

// cart
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

Route::get('/checkout/{amount}', [CartController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::post('/placeorder', [CartController::class, 'placeorder'])->name('placeorder');

Route::get('/search/', [FrontController::class, 'search'])->name('search');
Route::get('/orderDetails/{id}', [FrontController::class, 'orderDetails'])->name('orderdeatils');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [DashboardController::class, 'users'])->name('admin.users');

    Route::get('/orderlist/', [DashboardController::class, 'orderList'])->name('admin.orderlist');
    Route::get('b/{bid}/orderdetails/{oid}', [DashboardController::class, 'orderDetails'])->name('admin.orderdetails');

    // category
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.delete');

    // brand
    Route::get('/brand', [BrandController::class, 'index'])->name('admin.brand');
    Route::get('/brand/create', [BrandController::class, 'create'])->name('admin.brand.create');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('admin.brand.store');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
    Route::put('/brand/update/{id}', [BrandController::class, 'update'])->name('admin.brand.update');
    Route::get('/brand/delete/{id}', [BrandController::class, 'destroy'])->name('admin.brand.delete');

    // product
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('/product/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('admin.product.delete');

    // slide
    Route::get('/slider', [SlideController::class, 'index'])->name('admin.slider');
    Route::get('/slider/create', [SlideController::class, 'create'])->name('admin.slider.create');
    Route::post('/slider/store', [SlideController::class, 'store'])->name('admin.slider.store');
    Route::get('/slider/delete/{id}', [SlideController::class, 'delete'])->name('admin.slider.delete');
});

<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DonhangController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ImagesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin', function () {
    return view('admin.content');
});
// Route::get('/', function () {
//     return view('user.home');
// });

// Category
Route::get('/Category', [CategoryController::class, 'index'])->name('Category.index');
Route::delete('/Category/{id}/destroy', [CategoryController::class, 'destroy'])->name('Category.destroy');
Route::get('/Category/create', [CategoryController::class, 'create'])->name('Category.create');
Route::post('/Category/store', [CategoryController::class, 'store'])->name('Category.store');
Route::get('/Category/{id}/edit', [CategoryController::class, 'edit'])->name('Category.edit');
Route::put('/Category/{id}/update', [CategoryController::class, 'update'])->name('Category.update');
// Product
Route::get('/Product', [ProductController::class, 'index'])->name('Product.index');
Route::delete('/Product/{id}/destroy', [ProductController::class, 'destroy'])->name('Product.destroy');
Route::get('/Product/create', [ProductController::class, 'create'])->name('Product.create');
Route::post('/Product/store', [ProductController::class, 'store'])->name('Product.store');
Route::get('/Product/{id}/edit', [ProductController::class, 'edit'])->name('Product.edit');
Route::put('/Product/{id}/update', [ProductController::class, 'update'])->name('Product.update');

// User
Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/detail/{id}/show', [UserController::class, 'show'])->name('show');
// login
Route::get('/login', [LoginController::class, 'showFormLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
// register
Route::get('/register', [RegisterController::class, 'showFormRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
//Cart
Route::get('/cart', [DonhangController::class, 'index'])->name('cart.index');
Route::post('/them-gio-hang', [DonhangController::class, 'themVaoGiohang'])->name('themVaoGiohang');
Route::post('/cap-nhat-so-luong', [DonhangController::class, 'capNhatSoLuong'])->name('capNhatSoLuong');
Route::post('/xoa-san-pham', [DonhangController::class, 'xoaSanPham'])->name('xoaSanPham');
// SLide 

Route::get('/slideshow', function () {
    return view('user.layout.banner');
});

//Order
// Route::get('/order', [OrderController::class, 'index'])->name('Order.index');
//
// Đường dẫn tới trang thanh toán
Route::get('order/form', [OrderController::class, 'showForm'])->name('order.showForm')->middleware('checklogin');

Route::get('order', [OrderController::class, 'index'])->name('order.index')->middleware('checklogin');
Route::post('order', [OrderController::class, 'store'])->name('order.store');
Route::get('order/detail', [OrderController::class, 'showOrderDetail'])->name('order.detail')->middleware('checklogin');

Route::resource('/banners', BannerController::class);

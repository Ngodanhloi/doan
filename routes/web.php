<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CateController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

Route::get('/', [WelcomeController::class, 'index'])->middleware('auth')->name('index');
Route::get('/contact', [WelcomeController::class, 'contact'])->name('contact');
Route::get('/about', [WelcomeController::class, 'about'])->name('about');
Route::get('/news', [WelcomeController::class, 'news'])->name('news');
Route::get('/danhgia', [WelcomeController::class, 'danhgia'])->name('danhgia');
Route::get('/product', [WelcomeController::class, 'product'])->name('product');
Route::get('/product/{id}', [WelcomeController::class, 'detail'])->name('product.detail');
Route::get('/listProduct/{danhmucsp_id?}/{sort?}', 'App\Http\Controllers\WelcomeController@showListProduct')->name('listProduct.filter');

Route::post('/binhluan', [WelcomeController::class, 'store'])->name('binhluan.store');
// Route::get('/product/{id}', [ProductController::class, 'showProduct'])->name('product.show');
Route::get('product/{sanpham_id}/details', [ProductController::class, 'details'])->name('product.details');
Route::get('/search', [WelcomeController::class, 'index'])->name('search');

Route::get('/', [WelcomeController::class, 'index'])->middleware('auth')->name('index');
Route::get('/payment', [WelcomeController::class, 'pay'])->name('payment');
Route::post('/pay', [PayController::class, 'processPayment'])->name('pay.post');
// Route::post('/pay', [PayController::class, 'processPayment'])->name('process.payment');
Route::get('/news', [WelcomeController::class, 'news'])->name('news');
Route::get('/pay', [WelcomeController::class, 'pay'])->name('pay');
Route::get('/header', [WelcomeController::class, 'cate'])->name('header');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/apply-discount', [CartController::class, 'applyDiscount'])->name('discount.apply');
Route::post('/purchase-product', [ProductController::class, 'purchaseProduct'])->name('purchase.product');

/*Reset pass*/
Route::post('/roleadmin/user/reset', [UserController::class, 'reset'])->name('roleadmin.user.reset');

/*Tăng view*/
// routes/web.php
Route::get('/product/{sanpham_id}', 'ProductController@show')->name('product.show');

/*Tăng like*/
Route::post('/sanpham/{sanphamId}/like', [ProductController::class, 'increaseLike']);

// Trong file routes/web.php
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');

// /*Admin: Crud San Pham */
// Route::get('/admin', 'ProductController@admin')->name('admin');
// Route::post('/admin/sanpham/store', [ProductController::class, 'store'])->name('admin.sanpham.store');
// Route::put('/admin/sanpham/update/{sanpham_id}', [ProductController::class, 'update'])->name('admin.sanpham.update');
// Route::delete('/admin/sanpham/delete/{sanpham_id}', [ProductController::class, 'delete'])->name('admin.sanpham.delete');
// Route::get('admin/export_excel', [ProductController::class, 'exportExcel'])->name('admin.export_excel');

/*Admin: Crud User */
Route::get('roleadmin/user', [UserController::class, 'index'])->name('roleadmin.user.index');
Route::post('/roleadmin/user/store', [UserController::class, 'store'])->name('roleadmin.user.store');
Route::put('/roleadmin/user/update/{user_id}', [UserController::class, 'update'])->name('roleadmin.user.update');
Route::delete('/roleadmin/user/delete/{user_id}', [UserController::class, 'delete'])->name('roleadmin.user.delete');

/*Admin: Crud Pro */
Route::get('roleadmin/pro', [ProductController::class, 'index'])->name('roleadmin.pro.index');
Route::post('/roleadmin/pro/store', [ProductController::class, 'store'])->name('roleadmin.pro.store');
Route::put('/roleadmin/pro/update/{danhmucsp_id}', [ProductController::class, 'update'])->name('roleadmin.pro.update');
Route::delete('/roleadmin/pro/delete/{danhmucsp_id}', [ProductController::class, 'delete'])->name('roleadmin.pro.delete');

/*Admin: Crud Cate */
Route::get('roleadmin/cate', [CateController::class, 'index'])->name('roleadmin.cate.index');
Route::post('/roleadmin/cate/store', [CateController::class, 'store'])->name('roleadmin.cate.store');
Route::put('/roleadmin/cate/update/{danhmucsp_id}', [CateController::class, 'update'])->name('roleadmin.cate.update');
Route::delete('/roleadmin/cate/delete/{danhmucsp_id}', [CateController::class, 'delete'])->name('roleadmin.cate.delete');

Route::post('/contact', [WelcomeController::class, 'add'])->name('contact.add');
Route::get('/admin', [ProductController::class, 'admin'])->middleware('role:admin')->name('admin.dashboard');
Route::get('/user', [ProductController::class, 'index'])->middleware('role:user')->name('user.dashboard');

Route::get('/sort-products', [ProductController::class, 'sortProducts'])->name('sort-products');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

Route::get('/verify-email/{id}/{hash}', 'Auth\EmailVerificationController@verify')->name('verify-email');
Route::post('/product/{id}/updateQuantity', 'ProductController@updateProductQuantity')->name('sanpham.updateQuantity');

require __DIR__ . '/auth.php';

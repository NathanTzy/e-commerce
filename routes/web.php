<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\productGallery;
use App\Http\Controllers\Admin\productController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\myTransaction;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Models\productGallery as ModelsProductGallery;
use App\Models\transaction;
use Illuminate\Support\Facades\Artisan;

Route::get('/', [App\Http\Controllers\frontEnd\frontEndController::class, 'index']);
Route::get('/detail-product/{slug}', [App\Http\Controllers\frontEnd\frontEndController::class, 'detailProduct'])->name('detail.product');
Route::get('/detail-category/{slug}', [App\Http\Controllers\frontEnd\frontEndController::class, 'detailCategory'])->name('detail.category');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/cart', [App\Http\Controllers\frontEnd\frontEndController::class, 'cart'])->name('cart');
    Route::post('/cart/{id}', [App\Http\Controllers\frontEnd\frontEndController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/{id}', [App\Http\Controllers\frontEnd\frontEndController::class, 'deleteCart'])->name('deleteCart');
    Route::post('/checkout', [App\Http\Controllers\frontEnd\frontEndController::class, 'checkout'])->name('checkout');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('admin.')->prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/category', CategoryController::class)->except('show', 'edit', 'create');
    Route::resource('/product', ProductController::class)->except('show');
    Route::resource('/product.gallery', productGallery::class)->except('create', 'show', 'edit', 'update');
    Route::put('/resetPassword/{id}', [\App\Http\Controllers\Admin\DashboardController::class, 'resetPassword'])->name('reset-password');
    Route::resource('/transaction', TransactionController::class);
    Route::resource('/myTransaction', myTransaction::class)->only(['index']);
    Route::get('/my-transaction/{id}/{slug}', [myTransaction::class, 'testShow'])->name('my-transaction.show');
    Route::get('/my-transaction/{id}/{slug}', [myTransaction::class, 'showDataBySlugAndId'])->name('my-transaction.showDataBySlugAndId');
    Route::get('/transaction/{id}/{slug}', [TransactionController::class, 'showTransactionBySlugId'])->name('showTransactionBySlugId');
});
route::name('user.')->prefix('user')->middleware('user')->group(function () {
    route::get('/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/changePassword', [\App\Http\Controllers\User\DashboardController::class, 'changePassword'])->name('profile.changePassword');
    Route::put('/updatePassword', [\App\Http\Controllers\User\DashboardController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::resource('myTransaction', myTransaction::class)->only(['index']);
    Route::get('/my-transaction/{id}/{slug}', [myTransaction::class, 'testShow'])->name('my-transaction.show');
    Route::get('/my-transaction/{id}/{slug}', [myTransaction::class, 'showDataBySlugAndId'])->name('my-transaction.showDataBySlugAndId');
});

// route artisan call
Route::get('/artisan-call', function () {
    Artisan::call('storage:link'); 
    Artisan::call('route:clear'); 
    Artisan::call('config:clear'); 
    return 'done';
});

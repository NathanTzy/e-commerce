<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\productGallery;
use App\Http\Controllers\Admin\productController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\myTransaction;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Models\productGallery as ModelsProductGallery;
use App\Models\transaction;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('admin.')->prefix('admin')->middleware('admin')->group(function(){
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/category',CategoryController::class)->except('show', 'edit', 'create');
    Route::resource('/product',ProductController::class)->except('show');
    Route::resource('/product.gallery', productGallery::class)->except('create','show','edit','update');
    Route::put('/resetPassword/{id}', [\App\Http\Controllers\Admin\DashboardController::class, 'resetPassword'])->name('reset-password');
    Route::resource('transaction', transaction::class);
    Route::resource('myTransaction', myTransaction::class)->only(['index','show']);
});
route::name('user.')->prefix('user')->middleware('user')->group(function(){
    route::get('/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/changePassword', [\App\Http\Controllers\User\DashboardController::class, 'changePassword'])->name('profile.changePassword');
    Route::put('/updatePassword', [\App\Http\Controllers\User\DashboardController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::resource('myTransaction', myTransaction::class)->only(['index','show']);
});
    
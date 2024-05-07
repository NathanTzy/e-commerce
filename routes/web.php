<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\productGallery;
use App\Http\Controllers\Admin\productController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Models\productGallery as ModelsProductGallery;

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
});
route::name('user.')->prefix('user')->middleware('user')->group(function(){
    route::get('/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
});

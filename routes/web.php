<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomePageController;


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
    
Auth::routes();
    
Route::get('/', [App\Http\Controllers\HomePageController::class, 'index'])->name('home');
Route::get('/products', [App\Http\Controllers\ProductsPageController::class, 'index'])->name('products');
Route::get('/dashboard', [App\Http\Controllers\DashBoardPageController::class, 'index'])->name('dashboard');

Route::get('/products_manager', [App\Http\Controllers\ProductsManagerController::class, 'index'])->name('dashboard.products_manager');
Route::post('/products_manager/add_product', [App\Http\Controllers\ProductsManagerController::class, 'add_product'])->name('dashboard.products_manager.add_product');
Route::delete('/products_manager/delete_product/{product}', [App\Http\Controllers\ProductsManagerController::class, 'delete_product'])->name('dashboard.products_manager.delete_product');

Route::post('/img_store', [App\Http\Controllers\FileStore::class, 'img_store'])->name('img_store');
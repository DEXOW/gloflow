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
Route::put('/products_manager/update_product/{product}', [App\Http\Controllers\ProductsManagerController::class, 'update_product'])->name('dashboard.products_manager.update_product');
Route::delete('/products_manager/delete_product/{product}', [App\Http\Controllers\ProductsManagerController::class, 'delete_product'])->name('dashboard.products_manager.delete_product');
Route::post('/products_manager/batch_delete_products', [App\Http\Controllers\ProductsManagerController::class, 'batch_delete_products'])->name('dashboard.products_manager.batch_delete_products');


Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/users_manager', [App\Http\Controllers\UsersManagerController::class, 'index'])->name('dashboard.users_manager');
        Route::post('/users_manager/add_user', [App\Http\Controllers\UsersManagerController::class, 'add_user'])->name('dashboard.users_manager.add_user');
        Route::put('/users_manager/update_user/{user}', [App\Http\Controllers\UsersManagerController::class, 'update_user'])->name('dashboard.users_manager.update_user');
        Route::delete('/users_manager/delete_user/{user}', [App\Http\Controllers\UsersManagerController::class, 'delete_user'])->name('dashboard.users_manager.delete_user');
        Route::put('/users_manager/activate_user/{user}', [App\Http\Controllers\UsersManagerController::class, 'activate_user'])->name('dashboard.users_manager.activate_user');
        Route::put('/users_manager/deactivate_user/{user}', [App\Http\Controllers\UsersManagerController::class, 'deactivate_user'])->name('dashboard.users_manager.deactivate_user');
    });
});
Route::post('/img_store', [App\Http\Controllers\FileStore::class, 'img_store'])->name('img_store');
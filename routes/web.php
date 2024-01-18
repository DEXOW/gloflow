<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsManagerController;
use App\Http\Controllers\UsersManagerController;

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

Route::view('/', 'home')->name('home');
Route::get('/products', [App\Http\Controllers\ProductsPageController::class, 'index'])->name('products');
Route::view('/about', 'about')->name('about');


Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::prefix('products_manager')->group(function () {
        Route::get('/', [ProductsManagerController::class, 'index'])->name('dashboard.products_manager');
        Route::post('/add_product', [ProductsManagerController::class, 'add_product'])->name('dashboard.products_manager.add_product');
        Route::put('/update_product/{product}', [ProductsManagerController::class, 'update_product'])->name('dashboard.products_manager.update_product');
        Route::delete('/delete_product/{product}', [ProductsManagerController::class, 'delete_product'])->name('dashboard.products_manager.delete_product');
        Route::post('/batch_delete_products', [ProductsManagerController::class, 'batch_delete_products'])->name('dashboard.products_manager.batch_delete_products');
    });
    // Route::view('/users_manager', 'users_manager')->middleware('permission:manage_users')->name('users_manager');
    Route::prefix('users_manager')->group(function () {
        Route::get('/', [UsersManagerController::class, 'index'])->name('dashboard.users_manager');
        Route::post('/add_user', [UsersManagerController::class, 'add_user'])->name('dashboard.users_manager.add_user');
        Route::put('/update_user/{user}', [UsersManagerController::class, 'update_user'])->name('dashboard.users_manager.update_user');
        Route::delete('/delete_user/{user}', [UsersManagerController::class, 'delete_user'])->name('dashboard.users_manager.delete_user');
        Route::put('/activate_user/{user}', [UsersManagerController::class, 'activate_user'])->name('dashboard.users_manager.activate_user');
        Route::put('/deactivate_user/{user}', [UsersManagerController::class, 'deactivate_user'])->name('dashboard.users_manager.deactivate_user');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

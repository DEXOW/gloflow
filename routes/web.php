<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsManagerController;
use App\Http\Controllers\UsersManagerController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProductsPageController;

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
Route::get('/products', [ProductsPageController::class, 'index'])->name('products');
Route::view('/about', 'about')->name('about');

Route::prefix('client')->group(function() {
    Route::get('/clientNames', [ClientsController::class, 'getClientNames'])->name('clients.Names');
});


Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::prefix('products_manager')->group(function () {
        Route::get('/', [ProductsManagerController::class, 'index'])->name('dashboard.products_manager');
        Route::post('/add_product', [ProductsManagerController::class, 'add_product'])->name('dashboard.products_manager.add_product');
        Route::put('/update_product/{product}', [ProductsManagerController::class, 'update_product'])->name('dashboard.products_manager.update_product');
        Route::delete('/delete_product/{product}', [ProductsManagerController::class, 'delete_product'])->name('dashboard.products_manager.delete_product');
        Route::post('/batch_delete_products', [ProductsManagerController::class, 'batch_delete_products'])->name('dashboard.products_manager.batch_delete_products');
    });
    Route::prefix('users_manager')->group(function () {
        Route::get('/', [UsersManagerController::class, 'index'])->name('dashboard.users_manager');
        Route::post('/add_user', [UsersManagerController::class, 'add_user'])->name('dashboard.users_manager.add_user');
        Route::put('/update_user/{user}', [UsersManagerController::class, 'update_user'])->name('dashboard.users_manager.update_user');
        Route::delete('/delete_user/{user}', [UsersManagerController::class, 'delete_user'])->name('dashboard.users_manager.delete_user');
        Route::put('/toggle_user/{user}', [UsersManagerController::class, 'toggle_user'])->name('dashboard.users_manager.toggle_user');
    });
    Route::prefix('clients_manager')->group(function () {
        Route::get('/', [ClientsController::class, 'index'])->name('dashboard.clients_manager');
        Route::post('/add_client', [ClientsController::class, 'add_client'])->name('dashboard.clients_manager.add_client');
        Route::put('/update_client/{client}', [ClientsController::class, 'update_client'])->name('dashboard.clients_manager.update_client');
        Route::delete('/delete_client/{client}', [ClientsController::class, 'delete_client'])->name('dashboard.clients_manager.delete_client');
        Route::put('/toggle_client/{client}', [ClientsController::class, 'toggle_client'])->name('dashboard.clients_manager.toggle_client');
    });
    Route::prefix('orders')->group(function () {
        Route::get('/place_order', [OrdersController::class, 'place_order_view'])->name('dashboard.place_orders');
        Route::post('/place_order', [OrdersController::class, 'place_order'])->name('dashboard.orders.place_order');
        Route::get('/manage_orders', [OrdersController::class, 'manage_orders_view'])->name('dashboard.manage_orders');
        Route::put('/update_order_status', [OrdersController::class, 'update_order_status'])->name('dashboard.orders.update_order_status');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

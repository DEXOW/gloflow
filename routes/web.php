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


Route::prefix('products_manager')->group(function () {
    Route::get('/', [App\Http\Controllers\ProductsManagerController::class, 'index'])->name('dashboard.products_manager');
    Route::post('/add_product', [App\Http\Controllers\ProductsManagerController::class, 'add_product'])->name('dashboard.products_manager.add_product');
    Route::put('/update_product/{product}', [App\Http\Controllers\ProductsManagerController::class, 'update_product'])->name('dashboard.products_manager.update_product');
    Route::delete('/delete_product/{product}', [App\Http\Controllers\ProductsManagerController::class, 'delete_product'])->name('dashboard.products_manager.delete_product');
    Route::post('/batch_delete_products', [App\Http\Controllers\ProductsManagerController::class, 'batch_delete_products'])->name('dashboard.products_manager.batch_delete_products');
});

Route::prefix('users_manager')->group(function (){
    Route::middleware('ensureUserHasRole:1')->group(function () {
        Route::get('/', [App\Http\Controllers\UsersManagerController::class, 'index'])->name('dashboard.users_manager');
        Route::post('/add_user', [App\Http\Controllers\UsersManagerController::class, 'add_user'])->name('dashboard.users_manager.add_user');
        Route::put('/update_user/{user}', [App\Http\Controllers\UsersManagerController::class, 'update_user'])->name('dashboard.users_manager.update_user');
        Route::delete('/delete_user/{user}', [App\Http\Controllers\UsersManagerController::class, 'delete_user'])->name('dashboard.users_manager.delete_user');
        Route::put('/activate_user/{user}', [App\Http\Controllers\UsersManagerController::class, 'activate_user'])->name('dashboard.users_manager.activate_user');
        Route::put('/deactivate_user/{user}', [App\Http\Controllers\UsersManagerController::class, 'deactivate_user'])->name('dashboard.users_manager.deactivate_user');
    });
});
Route::post('/img_store', [App\Http\Controllers\FileStore::class, 'img_store'])->name('img_store');
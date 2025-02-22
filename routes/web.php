<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

Route::controller(AuthController::class)->middleware('guest')->group(function () {
    Route::get('/', 'index')->name('auth.index');
    Route::post('login', 'login')->name('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::prefix('product')->name('product.')->group(function () {
        Route::resource('lists', ProductController::class)->except('show')->parameter('lists', 'product');
        Route::post('export', [ProductController::class, 'export'])->name('export');
    });
});

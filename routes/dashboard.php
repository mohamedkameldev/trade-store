<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::as('dashboard.')->group(function () {

        Route::get('categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
        Route::put('categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
        Route::delete('categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');
        Route::resource('categories', CategoryController::class);

        Route::get('products', function () {
            return 'you are in products';
        })->name('products.index');

        Route::get('orders', function () {
            return 'you are in orders';
        })->name('orders.index');
    });
});

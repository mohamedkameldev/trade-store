<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Middleware\CheckUserType;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth', 'verified', CheckUserType::class])->group(function () {
Route::middleware(['auth', 'verified', 'auth.type:super-admin,admin'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::as('dashboard.')->group(function () {

        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
        Route::put('categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
        Route::delete('categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::get('stores', function () {
            return 'you are in stores index method';
        })->name('stores.index');
    });
});

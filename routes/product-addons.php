<?php

use App\Http\Controllers\Admin\ProductAddonController;
use App\Http\Controllers\ServerAddonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Product Addons Routes
|--------------------------------------------------------------------------
*/

// Admin routes for managing product addons
Route::middleware(['auth', 'checkSuspended'])->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('products/{product}')->name('products.')->group(function () {
        Route::get('addons', [ProductAddonController::class, 'index'])->name('addons.index');
        Route::get('addons/create', [ProductAddonController::class, 'create'])->name('addons.create');
        Route::post('addons', [ProductAddonController::class, 'store'])->name('addons.store');
        Route::get('addons/{addon}/edit', [ProductAddonController::class, 'edit'])->name('addons.edit');
        Route::patch('addons/{addon}', [ProductAddonController::class, 'update'])->name('addons.update');
        Route::delete('addons/{addon}', [ProductAddonController::class, 'destroy'])->name('addons.destroy');
        Route::patch('addons/{addon}/toggle', [ProductAddonController::class, 'toggle'])->name('addons.toggle');
    });
});

// User routes for purchasing/removing addons
Route::middleware(['auth', 'checkSuspended'])->group(function () {
    Route::prefix('servers/{server}')->name('servers.')->group(function () {
        Route::get('addons', [ServerAddonController::class, 'index'])->name('addons.index');
        Route::post('addons/purchase', [ServerAddonController::class, 'purchase'])->name('addons.purchase');
        Route::delete('addons/{serverAddon}', [ServerAddonController::class, 'remove'])->name('addons.remove');
    });
});

<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function(){
        Route::get('/', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'products', 'as' => 'products.'], function(){
        Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('index');
    });

});

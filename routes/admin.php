<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('login', [\App\Http\Controllers\Admin\LoginController::class, 'login'])->name('login');
    Route::post('login', [\App\Http\Controllers\Admin\LoginController::class, 'authenticate'])->name('login');
    Route::post('logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('logout')->middleware('auth:admin');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin'], 'as' => 'admin.'], function(){

    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function(){
        Route::get('/', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'products', 'as' => 'products.'], function(){
        Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function(){
        Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('index');
        Route::post('/reload', [\App\Http\Controllers\Admin\CategoryController::class, 'reload'])->name('reload');
        Route::post('/edit/{category}/{new?}', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('edit');
        Route::post('/store/', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('store');
        Route::post('/update/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('update');
        Route::post('/sort/{category}/{vector}', [\App\Http\Controllers\Admin\CategoryController::class, 'sort'])->name('sort');
    });

    Route::group(['prefix' => 'import', 'as' => 'import.'], function(){
        Route::get('/', [\App\Http\Controllers\Admin\ImportController::class, 'index'])->name('index');
        Route::post('/options', [\App\Http\Controllers\Admin\ImportController::class, 'optionsStore'])->name('options');
        Route::post('/start', [\App\Http\Controllers\Admin\ImportController::class, 'start'])->name('start');
    });

    Route::group(['prefix' => 'json', 'as' => 'json.'], function(){
        Route::group(['prefix' => 'products', 'as' => 'products.'], function() {
            Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'getProducts'])->name('get');
        });
    });

});

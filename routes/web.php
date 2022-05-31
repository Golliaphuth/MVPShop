<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'front.'], function(){

    Route::group(['prefix' => 'auth'], function(){
        Route::post('/login', [\App\Http\Controllers\Front\Auth\LoginController::class, 'authenticate'])->name('login');
        Route::post('/logout', [\App\Http\Controllers\Front\Auth\LoginController::class, 'logout'])->name('logout');
    });

    Route::get('/', [\App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');
});

<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'front.'], function(){
    Route::get('/', [\App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');
});

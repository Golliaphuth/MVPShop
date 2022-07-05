<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'front.'], function(){

    Route::get('test', [\App\Http\Controllers\TestController::class, 'index'])->name('test');

    Route::group(['as' => 'locale.'], function(){
        Route::get('locale/{locale}', [\App\Http\Controllers\Front\LocaleController::class, 'set'])->name('set');
    });

    Route::group(['prefix' => 'auth'], function(){
        Route::post('/login', [\App\Http\Controllers\Front\Auth\LoginController::class, 'authenticate'])->name('login');
        Route::get('/logout', [\App\Http\Controllers\Front\Auth\LoginController::class, 'logout'])->name('logout');
        Route::post('/register', [\App\Http\Controllers\Front\Auth\LoginController::class, 'registration'])->name('register');
    });

    Route::get('/', [\App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');

    Route::get('category/{slug}', [\App\Http\Controllers\Front\CategoryController::class, 'index'])->name('category');

    Route::get('product/{slug}', [\App\Http\Controllers\Front\ProductController::class, 'show'])->name('product');

    Route::get('cart',[\App\Http\Controllers\Front\CartController::class, 'index'])->name('cart');
    Route::post('cart/add',[\App\Http\Controllers\Front\CartController::class, 'add'])->name('cart.add');
    Route::post('cart/remove',[\App\Http\Controllers\Front\CartController::class, 'remove'])->name('cart.remove');
    Route::post('cart/quantity',[\App\Http\Controllers\Front\CartController::class, 'remove'])->name('cart.quantity');

    Route::get('checkout',[\App\Http\Controllers\Front\CheckoutController::class, 'index'])->name('checkout');

    Route::get('blog',[\App\Http\Controllers\Front\BlogController::class, 'index'])->name('blog');

    Route::get('about_us',[\App\Http\Controllers\Front\AboutController::class, 'index'])->name('about');

    Route::get('contacts',[\App\Http\Controllers\Front\ContactsController::class, 'index'])->name('contacts');

    Route::group(['prefix' => 'np', 'as' => 'np.'], function(){
        Route::get('city', [\App\Http\Controllers\Front\CheckoutController::class, 'getCity'])->name('cities');
        Route::get('street', [\App\Http\Controllers\Front\CheckoutController::class, 'getStreet'])->name('streets');
        Route::get('warehouse', [\App\Http\Controllers\Front\CheckoutController::class, 'getWarehouse'])->name('warehouses');
    });

});

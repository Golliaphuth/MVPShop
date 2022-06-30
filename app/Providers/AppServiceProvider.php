<?php

namespace App\Providers;

use App\Services\CartDatabaseService;
use App\Services\CartService;
use App\Services\ICartService;
use App\View\Components\Front\Advantages;
use App\View\Components\Front\Bestsellers;
use App\View\Components\Front\Brands;
use App\View\Components\Front\NewArrivals;
use App\View\Components\Front\PopularCategories;
use App\View\Components\Front\QuickCart;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ICartService::class, CartDatabaseService::class);

        Blade::component( Advantages::class, 'advantages');
        Blade::component( Brands::class, 'brands');
        Blade::component(Bestsellers::class, 'bestsellers');
        Blade::component(PopularCategories::class, 'popular-categories');
        Blade::component(NewArrivals::class, 'new-arrivals');
        Blade::component(QuickCart::class, 'quick-cart');
    }
}

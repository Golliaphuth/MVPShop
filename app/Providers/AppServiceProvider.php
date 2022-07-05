<?php

namespace App\Providers;

use App\Services\Cart\CartDatabaseService;
use App\Services\Cart\ICartService;
use App\Services\Deliveries\DeliveryNovaPoshta;
use App\Services\Deliveries\IDeliveryService;
use App\View\Components\Front\Advantages;
use App\View\Components\Front\Bestsellers;
use App\View\Components\Front\Brands;
use App\View\Components\Front\NewArrivals;
use App\View\Components\Front\PopularCategories;
use App\View\Components\Front\QuickCart;
use Illuminate\Http\Resources\Json\JsonResource;
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
        JsonResource::withoutWrapping();

        $this->app->bind(ICartService::class, CartDatabaseService::class);
        $this->app->bind(IDeliveryService::class, DeliveryNovaPoshta::class);

        Blade::component( Advantages::class, 'advantages');
        Blade::component( Brands::class, 'brands');
        Blade::component(Bestsellers::class, 'bestsellers');
        Blade::component(PopularCategories::class, 'popular-categories');
        Blade::component(NewArrivals::class, 'new-arrivals');
        Blade::component(QuickCart::class, 'quick-cart');
    }
}

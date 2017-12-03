<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Basket\SessionStorage;
use App\Basket\StorageInterface;
use App\Basket\Basket;
use App\Product;
use View;

class StorageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
       view()->share('basket', $this->app->make(Basket::class));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StorageInterface::class, SessionStorage::class);
        
        $this->app->singleton(Product::class, function($app) {
            return new Product;
        });
        
        $this->app->singleton(Basket::class, function($app) {
            return new Basket($app->make(StorageInterface::class), $app->make(Product::class));
        });
    }
}

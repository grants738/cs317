<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Order;
use App\Customer;
use App\Address;
use App\Payment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Braintree_Configuration::environment('sandbox');
        \Braintree_Configuration::merchantId('78dy5jrzpbp8g5p8');
        \Braintree_Configuration::publicKey('nf7pkry7z3hftvyt');
        \Braintree_Configuration::privateKey('df1a7527ef2d51bd6db2ed932c1b6b2b');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Order::class, function($app) {
            return new Order;
        });

        $this->app->singleton(Customer::class, function($app) {
            return new Customer;
        });

        $this->app->singleton(Address::class, function($app) {
            return new Address;
        });

        $this->app->singleton(Payment::class, function($app) {
            return new Payment;
        });
    }
}

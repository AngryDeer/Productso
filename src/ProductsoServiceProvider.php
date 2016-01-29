<?php

namespace Angrydeer\Productso;

use Illuminate\Support\ServiceProvider;

class ProductsoServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        require __DIR__ . '/Http/routes.php';
        $this->loadViewsFrom(__DIR__.'/resources/views', 'Productso');

        $this->publishes([
            __DIR__.'/migrations/' => base_path('/database/migrations'),
            __DIR__.'/published/soadmin/' => base_path('/app/Admin'),
            __DIR__.'/resources/views' => resource_path('views/vendor/Productso'),
            __DIR__.'/published/assets' => public_path('vendor/Productso')
        ], 'category');

    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->bind('PrsoCategory', function($app){
//            return new PrsoCategory;
//        });
    }
}

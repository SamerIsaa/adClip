<?php

namespace App\Providers;

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
        view()->composer('site.layout.footer' , function ($view){
            $view->with('social' , \App\About::social());
        });

        view()->composer('site.layout.header' , function ($view){
            $view->with('social' , \App\About::social());
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\Composers\DefaultComposer;
use Illuminate\Support\Facades\Blade;

class ViewServiceProvider extends ServiceProvider
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
        view()->composer('*', DefaultComposer::class);
    }
}

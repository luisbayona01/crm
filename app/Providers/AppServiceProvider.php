<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Http\ViewComposers\VersionComposer;
use App\Http\ViewComposers\PaginawebComposer;

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
        schema::defaultStringLength(191);
        view()->composer('layouts.plantilla', VersionComposer::class);
        view()->composer('layouts.plantilla', PaginawebComposer::class);
    }
}

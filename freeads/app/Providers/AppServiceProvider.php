<?php

namespace App\Providers;

use App\Policies\AdPolicy;
use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\Schema;
use App\Models\Ad;


class AppServiceProvider extends ServiceProvider
{
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
//        Schema::defaultStringLenght(191);
    }

    public $policies = [
        Ad::class => AdPolicy::class
    ];
}

<?php

namespace App\Providers;

use App\View\Components\Custom\EditInput;
use App\View\Components\Custom\Input;
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
        Blade::component('input', Input::class);
        Blade::component('edit-input', EditInput::class);
    }
}
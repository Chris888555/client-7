<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema; 
use App\Models\ThemeSetting;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Fix for MySQL "key too long" issue
        Schema::defaultStringLength(191);

        // Share theme settings to all views
        View::composer('*', function ($view) {
            $view->with('theme', ThemeSetting::first());
        });
    }
}

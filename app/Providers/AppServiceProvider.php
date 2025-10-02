<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ThemeSetting;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Share theme settings to all views
       View::composer('*', function ($view) {
            $view->with('theme', ThemeSetting::first());
        });

    }
}
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\SidebarComposer;
use App\Http\View\Composers\AdminHeaderComposer;
use App\Models\NavSetting;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register SidebarComposer for 'includes.sidebar' view
        View::composer('includes.sidebar', SidebarComposer::class);

        // Register AdminHeaderComposer for 'includes.admin-header' view
        View::composer('includes.admin-header', AdminHeaderComposer::class);

      // Apply SidebarComposer to all views EXCEPT listed ones
View::composer('*', function ($view) {
    if (
        $view->getName() !== 'sales_funnel' &&
        $view->getName() !== 'payment-form' &&
        $view->getName() !== 'shop' &&
        $view->getName() !== 'checkout' &&
        $view->getName() !== 'thank-you' &&
        $view->getName() !== 'landing-page'
    ) {
        (new SidebarComposer())->compose($view);
    }
});

    
        // Fetch data from nav_settings table
        $navSettings = NavSetting::first();  // Or use any logic to fetch the data

        // Share the navSettings globally with all views
        View::share('navSettings', $navSettings);
    }

    public function register()
    {
        //
    }
}

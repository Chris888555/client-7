<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Register the custom command to check funnel expiration
        \App\Console\Commands\CheckFunnelExpiration::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Schedule the funnel expiration check to run every minute (or adjust to your preference)
        $schedule->command('funnel:check-expiration')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // Load the commands defined in the app/Console/Commands directory
        $this->load(__DIR__.'/Commands');

        // Include the console.php routes for additional command registrations
        require base_path('routes/console.php');
    }
}

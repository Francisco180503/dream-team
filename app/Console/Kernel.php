<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('identificar:denuncias-urgentes')->hourly();
    }


    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'redirect.role' => \App\Http\Middleware\RedirectBasedOnRole::class,
        // Otros middlewares
    ];
}

<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\DatabaseFetchCLI;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('weather:dataBaseCLIDefined')->hourly();
        $schedule->command('weather:dataBaseCLI {city}')->hourly();
        $schedule->command('weather:noDataBaseCLIDefined')->hourly();
        $schedule->command('weather:noDataBaseCLI {city}')->hourly();
    }

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\DatabaseFetchCLI::class,
        \App\Console\Commands\DatabaseFetchPredefinedCLI::class,
    ];

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}

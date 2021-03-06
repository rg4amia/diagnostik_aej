<?php

namespace App\Console;

use App\Console\Commands\RdvAlerteEmail;
use App\Console\Commands\SetRencontreStatusCE;
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
        SetRencontreStatusCE::class,
        RdvAlerteEmail::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(SetRencontreStatusCE::class)->dailyAt('17:00')
            ->appendOutputTo(storage_path('logs/setrencontrestatusce.log'));

        $schedule->command(RdvAlerteEmail::class)->dailyAt('07:00')
            ->appendOutputTo(storage_path('logs/rdvalerteemail.log'));
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

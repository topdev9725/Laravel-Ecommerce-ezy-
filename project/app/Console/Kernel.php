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
        Commands\CrudGenerator::class,
        Commands\ApplyCashback::class,
        Commands\AutodebitSubscriptionCommand::class,
        Commands\DailyWithdrawCommand::class,
        Commands\WeeklyWithdrawCommand::class,
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('apply:cashback')
                 ->monthlyOn(1, '4:00');
        $schedule->command('autodebit:subscription')
                 ->dailyAt('1:00');
        $schedule->command('withdraw:daily')
                 ->dailyAt('2:00');
        $schedule->command('withdraw:weekly')
                 ->weeklyOn(6, '24:00');
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

<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('import:learner-data')->dailyAt('02:00');
        $schedule->command('backup:mysql')
        ->dailyAt('02:00')
        ->withoutOverlapping()
        ->appendOutputTo(storage_path('logs/mysql-backup.log'));

        $schedule->call(function () {
            $logPath = storage_path('logs');
    
            foreach (glob($logPath . '/*.log') as $file) {
                file_put_contents($file, '');
            }
        })->weeklyOn(6, '03:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

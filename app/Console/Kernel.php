<?php

namespace App\Console;

use App\Console\Commands\StartWebSockets;
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
        \App\Console\Commands\DoCron::class,
        \App\Console\Commands\CheckExpiredPosts::class,
        StartWebSockets::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('check:posts')
            ->everyMinute();
        $schedule->command('do:cron')
            ->everyMinute();
    }
}

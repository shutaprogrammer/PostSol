<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Post;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
        //         Post::where('created_at', '<', now()->subMinute())->delete();
        // })->everyMinute(); // 1分ごとに実行
            Post::where('created_at', '<', now()->subDay())->delete();
        })->daily(); // 毎日実行
        //     Post::where('created_at', '<', now()->subMonth())->delete();
        // })->daily(); // 毎日実行
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

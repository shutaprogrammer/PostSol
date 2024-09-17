<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Post;
use App\Models\Status;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        //ソフトデリート用
        $schedule->call(function () {
            Post::where('deletion_date', '<', now())->whereNull('deleted_at')->update(['deleted_at' => now()]);
        })->daily();
        //     Post::where('created_at', '<', now()->subDay())->delete();
        // })->daily(); // 毎日実行
        //         Post::where('created_at', '<', now()->subMinute())->delete();
        // })->everyMinute(); // 1分ごとに実行
        //     Post::where('created_at', '<', now()->subMonth())->delete();
        // })->daily(); // 毎日実行

        //トライアル期間用
        $schedule->call(function () {
            Status::where('status', 'Trial')
                ->where('period', '<', now()) // 現在の日付が期限を過ぎている場合
                ->update(['status' => 'Free']);
        })->daily(); // 毎日実行
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

<?php

namespace App\Console;

use App\Console\Commands\Import\SANDI\ImportCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        ImportCommand::class
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('import:sandi')->dailyAt('3:00');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}

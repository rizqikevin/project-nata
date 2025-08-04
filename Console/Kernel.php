<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\KirimAgendaReminder;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        KirimAgendaReminder::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('agenda:reminder')->everyMinute();
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Models\User;
use App\Notifications\AgendaReminderNotification;
use Carbon\Carbon;

class KirimAgendaReminder extends Command
{
    protected $signature = 'agenda:reminder';
    protected $description = 'Kirim email pengingat agenda 5 menit sebelum dimulai';

    public function handle()
    {
        $now = Carbon::now();
        $fiveMinutesLater = $now->copy()->addMinutes(5);

        $events = Event::whereBetween('start_date', [$now, $fiveMinutesLater])->get();

        foreach ($events as $agenda) {
            $users = User::all(); // kirim ke semua user
            foreach ($users as $user) {
                $user->notify(new AgendaReminderNotification($agenda));
                $this->info("Notifikasi dikirim ke: {$user->email} untuk agenda: {$agenda->title}");
            }
        }

        return Command::SUCCESS;
    }
}

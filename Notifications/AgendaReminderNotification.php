<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Event;

class AgendaReminderNotification extends Notification
{
    use Queueable;

    protected $agenda;

    /**
     * Create a new notification instance.
     */
    public function __construct(Event $agenda)
    {
        $this->agenda = $agenda;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pengingat Agenda: ' . $this->agenda->title)
            ->greeting('Halo, ' . $notifiable->name)
            ->line('Agenda "' . $this->agenda->title . '" akan dimulai pada: ' . $this->agenda->start_date)
            ->line('Lokasi: ' . $this->agenda->location)
            ->action('Lihat Agenda', url('/events/' . $this->agenda->id . '/edit'))
            ->line('Terima kasih telah menggunakan Smart Agenda!');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'agenda_id' => $this->agenda->id,
            'title' => $this->agenda->title,
            'start_date' => $this->agenda->start_date,
        ];
    }
}

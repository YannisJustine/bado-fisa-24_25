<?php

namespace App\Notifications;

use App\Models\Lecon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Mail\EventAsked as Mail;
use Illuminate\Support\Facades\Vite;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EventUpdatedNotif extends Notification implements ShouldQueue
{
    use Queueable;

    public $lecon;

    /**
     * Create a new notification instance.
     */
    public function __construct(Lecon $lecon)
    {
        $this->lecon = $lecon;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
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
            ->subject('Heure demandée')
            ->markdown('mail.lecon.updated', [
                'lecon' => $this->lecon,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

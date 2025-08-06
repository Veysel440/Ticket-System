<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SlaBreach extends Notification
{
    use Queueable;

    public function __construct(public $ticket) {}

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('SLA İhlali')
            ->line('Bir ticket, SLA süresini geçti!')
            ->action('Ticketı Gör', url('/tickets/'.$this->ticket->id));
    }
}

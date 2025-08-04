<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TicketAssigned extends Notification
{
    use Queueable;

    public function __construct(public $ticket) {}

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'ticket_id' => $this->ticket->id,
            'message' => 'Yeni ticket size atandı.'
        ];
    }

    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->line('Yeni bir ticket size atandı.')
            ->action('Ticketı Görüntüle', url('/tickets/' . $this->ticket->id));
    }
}

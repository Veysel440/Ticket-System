<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TicketAssigned extends Notification implements ShouldQueue
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
            'message'   => 'Yeni bir ticket size atandı.',
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Yeni Ticket Ataması')
            ->line('Yeni bir ticket size atandı!')
            ->action('Ticketı Gör', url('/tickets/' . $this->ticket->id));
    }
}

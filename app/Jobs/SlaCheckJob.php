<?php

namespace App\Jobs;

use App\Models\Ticket;
use App\Models\User;
use App\Notifications\SlaBreach;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;

class SlaCheckJob implements ShouldQueue
{
    use Queueable;

    public function handle()
    {
        $tickets = Ticket::where('status', 'open')
            ->where('created_at', '<', now()->subHours(24))
            ->get();

        foreach ($tickets as $ticket) {
            if (!$ticket->sla_breached) {
                foreach (User::role('admin')->get() as $admin) {
                    $admin->notify(new SlaBreach($ticket));
                }
                $ticket->update(['sla_breached' => true]);
            }
        }
    }
}

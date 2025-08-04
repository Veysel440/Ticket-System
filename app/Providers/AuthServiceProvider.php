<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\Ticket::class => \App\Policies\TicketPolicy::class,
    ];

    public function register(): void
    {

    }

    public function boot(): void
    {
        //
    }
}

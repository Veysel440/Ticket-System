<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(
            \App\Interface\TagRepositoryInterface::class,
            \App\Repositories\TagRepository::class
        );
        $this->app->bind(
            \App\Interface\TicketCommentRepositoryInterface::class,
            \App\Repositories\TicketCommentRepository::class
        );
        $this->app->bind(
            \App\Interface\KnowledgeBaseArticleRepositoryInterface::class,
            \App\Repositories\KnowledgeBaseArticleRepository::class
        );
        $this->app->bind(
            \App\Interface\NotificationInterface::class,
            \App\Repositories\Notification::class
        );
        $this->app->bind(
            \App\Interface\UserRepositoryInterface::class,
            \App\Repositories\UserRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

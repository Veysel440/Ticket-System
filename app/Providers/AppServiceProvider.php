<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\TagRepositoryInterface::class,
            \App\Repositories\TagRepository::class
        );
        $this->app->bind(
            \App\Repositories\TicketCommentRepositoryInterface::class,
            \App\Repositories\TicketCommentRepository::class
        );
        $this->app->bind(
            \App\Repositories\KnowledgeBaseArticleRepositoryInterface::class,
            \App\Repositories\KnowledgeBaseArticleRepository::class
        );
        $this->app->bind(
            \App\Repositories\NotificationRepositoryInterface::class,
            \App\Repositories\NotificationRepository::class
        );
        $this->app->bind(
            \App\Repositories\UserRepositoryInterface::class,
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

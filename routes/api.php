<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TicketCommentController;
use App\Http\Controllers\KnowledgeBaseArticleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tickets', TicketController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('tags', [TagController::class, 'index']);
    Route::post('tags', [TagController::class, 'store']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tags', TagController::class)->only(['index', 'store']);
    Route::get('tickets/{ticket}/comments', [TicketCommentController::class, 'index']);
    Route::post('tickets/{ticket}/comments', [TicketCommentController::class, 'store']);
    Route::apiResource('knowledge-base-articles', KnowledgeBaseArticleController::class);
    Route::get('notifications', [NotificationController::class, 'index']);
    Route::patch('notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::apiResource('users', UserController::class)->only(['index', 'show']);
});

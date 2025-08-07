<?php

use App\Http\Controllers\Api\V1\AIChatController;
use App\Http\Controllers\Api\V1\ChatController;
use App\Http\Controllers\Api\V1\FileUploadController;
use App\Http\Controllers\Api\V1\KnowledgeBaseArticleController;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\ReportController;
use App\Http\Controllers\Api\V1\TagController;
use App\Http\Controllers\Api\V1\TicketCommentController;
use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\Api\V1\UserController;

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::get('tickets', [TicketController::class, 'index']);
    Route::get('tickets/{ticket}', [TicketController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'throttle:10,1'])->group(function () {
    Route::post('tickets', [TicketController::class, 'store']);
    Route::put('tickets/{ticket}', [TicketController::class, 'update']);
    Route::patch('tickets/{ticket}', [TicketController::class, 'update']);
    Route::delete('tickets/{ticket}', [TicketController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'throttle:10,1'])->group(function () {
    Route::get('tickets/{ticket}/comments', [TicketCommentController::class, 'index']);
    Route::post('tickets/{ticket}/comments', [TicketCommentController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'throttle:30,1'])->group(function () {
    Route::get('tags', [TagController::class, 'index']);
    Route::post('tags', [TagController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::get('knowledge-base-articles', [KnowledgeBaseArticleController::class, 'index']);
    Route::get('knowledge-base-articles/{knowledge_base_article}', [KnowledgeBaseArticleController::class, 'show']);
});
Route::middleware(['auth:sanctum', 'throttle:10,1'])->group(function () {
    Route::post('knowledge-base-articles', [KnowledgeBaseArticleController::class, 'store']);
    Route::put('knowledge-base-articles/{knowledge_base_article}', [KnowledgeBaseArticleController::class, 'update']);
    Route::patch('knowledge-base-articles/{knowledge_base_article}', [KnowledgeBaseArticleController::class, 'update']);
    Route::delete('knowledge-base-articles/{knowledge_base_article}', [KnowledgeBaseArticleController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{user}', [UserController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'throttle:30,1'])->group(function () {
    Route::get('notifications', [NotificationController::class, 'index']);
    Route::patch('notifications/{id}/read', [NotificationController::class, 'markAsRead']);
});

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::get('tickets/{ticket}/chat', [ChatController::class, 'index']);
});
Route::middleware(['auth:sanctum', 'throttle:10,1'])->group(function () {
    Route::post('tickets/{ticket}/chat', [ChatController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'throttle:3,1'])->post('ai-chat', [AIChatController::class, 'ask']);

Route::middleware(['auth:sanctum', 'throttle:5,1'])->post('file-upload', [FileUploadController::class, 'upload']);


Route::prefix('reports')->middleware(['auth:sanctum', 'role:admin', 'throttle:10,1'])->group(function () {
    Route::get('ticket-status', [ReportController::class, 'ticketStatusSummary']);
    Route::get('agent-performance', [ReportController::class, 'agentPerformance']);
    Route::get('monthly-ticket-summary', [ReportController::class, 'monthlyTicketSummary']);
    Route::get('export-tickets-csv', [ReportController::class, 'exportTicketsToCsv']);
});

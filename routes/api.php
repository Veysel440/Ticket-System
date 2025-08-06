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

Route::prefix('reports')->middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('ticket-status', [ReportController::class, 'ticketStatusSummary']);
    Route::get('agent-performance', [ReportController::class, 'agentPerformance']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('tickets/{ticket}/chat', [ChatController::class, 'index']);
    Route::post('tickets/{ticket}/chat', [ChatController::class, 'store']);
});
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('reports/ticket-status', [ReportController::class, 'ticketStatusSummary']);
});
Route::prefix('reports')->middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('monthly-ticket-summary', [ReportController::class, 'monthlyTicketSummary']);
    Route::get('export-tickets-csv', [ReportController::class, 'exportTicketsToCsv']);
});
Route::middleware('auth:sanctum')->post('ai-chat', [AIChatController::class, 'ask']);
Route::middleware('auth:sanctum')->post('file-upload', [FileUploadController::class, 'upload']);

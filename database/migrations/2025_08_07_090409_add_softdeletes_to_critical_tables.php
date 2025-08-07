<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'tickets',
            'ticket_comments',
            'chat_messages',
            'knowledge_base_articles',
            'customer_surveys',
            'notifications',
            'activity_logs',
            'tags',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                if (!Schema::hasColumn($table->getTable(), 'deleted_at')) {
                    $table->softDeletes();
                }
            });
        }
    }

    public function down(): void
    {
        $tables = [
            'tickets',
            'ticket_comments',
            'chat_messages',
            'knowledge_base_articles',
            'customer_surveys',
            'notifications',
            'activity_logs',
            'tags',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                if (Schema::hasColumn($table->getTable(), 'deleted_at')) {
                    $table->dropSoftDeletes();
                }
            });
        }
    }
};

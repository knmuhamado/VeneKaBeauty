<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('beauty_conversations', function (Blueprint $table) {
            $table->dropColumn('last_message_at');
        });
    }

    public function down(): void
    {
        Schema::table('beauty_conversations', function (Blueprint $table) {
            $table->timestamp('last_message_at')->nullable()->after('user_id');
        });
    }
};

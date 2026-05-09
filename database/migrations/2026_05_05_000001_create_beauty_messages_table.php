<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beauty_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beauty_conversation_id')->constrained()->cascadeOnDelete();
            $table->string('role');
            $table->text('content');
            $table->json('products')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beauty_messages');
    }
};

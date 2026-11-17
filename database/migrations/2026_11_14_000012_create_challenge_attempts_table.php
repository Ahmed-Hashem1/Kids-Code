<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('challenge_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained();
            $table->foreignId('challenge_id')->constrained();
            $table->string('request_key');
            $table->json('response');
            $table->boolean('is_correct');
            $table->unsignedTinyInteger('stars');
            $table->unique(
                ['enrollment_id', 'challenge_id', 'request_key'],
                'challenge_attempt_request_unique',
            );
            $table->timestamps();

            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenge_attempts');
    }
};

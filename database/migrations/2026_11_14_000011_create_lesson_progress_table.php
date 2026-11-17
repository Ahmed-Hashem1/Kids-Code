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
        Schema::create('lesson_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained();
            $table->foreignId('lesson_id')->constrained();
            $table->json('played_ranges')->nullable();
            $table->timestamp('video_done_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamp('activity_tried_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->boolean('xp_awarded')->default(false);
            $table->unique(['enrollment_id', 'lesson_id']);
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
        Schema::dropIfExists('lesson_progress');
    }
};

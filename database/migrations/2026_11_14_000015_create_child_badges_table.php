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
        Schema::create('child_badges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained();
            $table->foreignId('badge_id')->constrained();
            $table->timestamp('earned_at');
            $table->unique(['child_id', 'badge_id']);
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
        Schema::dropIfExists('child_badges');
    }
};

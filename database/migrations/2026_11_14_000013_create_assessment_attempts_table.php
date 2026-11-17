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
        Schema::create('assessment_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained();
            $table->foreignId('assessment_id')->constrained();
            $table->string('request_key');
            $table->integer('score_percent');
            $table->boolean('passed')->nullable();
            $table->unique(
                ['enrollment_id', 'assessment_id', 'request_key'],
                'assess_attempts_request_unique',
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
        Schema::dropIfExists('assessment_attempts');
    }
};

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
        Schema::create('path_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pathway_id')->constrained();
            $table->integer('version_no');
            $table->enum('status', ['draft', 'published', 'archived']);
            $table->timestamp('published_at')->nullable();
            $table->unique(['pathway_id', 'version_no']);
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
        Schema::dropIfExists('path_versions');
    }
};

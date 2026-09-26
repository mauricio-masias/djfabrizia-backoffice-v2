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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('youtube_id', 32)->unique();
            $table->string('title');
            $table->string('duration', 16)->nullable();
            $table->string('source', 16)->default('manual');
            $table->string('status', 16)->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->timestamp('source_missing_at')->nullable();
            $table->unsignedBigInteger('legacy_wp_id')->nullable()->unique();
            $table->timestamps();

            $table->index(['status', 'published_at']);
            $table->index(['status', 'sort']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};

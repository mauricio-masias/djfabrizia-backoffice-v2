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
        Schema::create('mixes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('short_name', 64)->nullable();
            $table->string('url', 512);
            $table->string('image_url', 512)->nullable();
            $table->string('image_small_url', 512)->nullable();
            $table->timestamp('released_at')->nullable();
            $table->string('duration', 16)->nullable();
            $table->json('source_tags')->nullable();
            $table->string('source', 16)->default('manual');
            $table->string('external_id')->nullable()->unique();
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
        Schema::dropIfExists('mixes');
    }
};

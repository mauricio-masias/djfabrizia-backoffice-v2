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
        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('short_name')->nullable();
            $table->string('url', 512);
            $table->string('uri')->nullable();
            $table->string('image_url', 512)->nullable();
            $table->string('owner_url', 512)->nullable();
            $table->string('owner_id')->nullable();
            $table->unsignedInteger('tracks_total')->nullable();
            $table->boolean('collaborative')->default(false);
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
        Schema::dropIfExists('playlists');
    }
};

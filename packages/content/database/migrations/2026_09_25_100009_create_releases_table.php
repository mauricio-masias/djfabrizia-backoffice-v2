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
        Schema::create('releases', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('cover_source', 16)->default('local');
            $table->foreignId('cover_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->string('cover_external_url', 512)->nullable();
            $table->foreignId('track_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->string('duration', 16)->nullable();
            $table->string('bpm', 16)->nullable();
            $table->foreignId('record_label_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('primary_genre_id')->nullable()->constrained('genres')->nullOnDelete();
            $table->unsignedSmallInteger('year')->nullable();
            $table->text('description')->nullable();
            $table->string('legacy_description')->nullable();
            $table->string('status', 16)->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->unsignedInteger('sort')->default(0);
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
        Schema::dropIfExists('releases');
    }
};

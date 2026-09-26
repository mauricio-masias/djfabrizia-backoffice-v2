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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('template', 32)->index();
            $table->string('locale', 5)->default('en');
            $table->string('status', 16)->default('draft');
            $table->json('blocks');
            $table->json('seo')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->unsignedBigInteger('legacy_wp_id')->nullable()->unique();
            $table->timestamps();

            $table->index(['status', 'published_at']);
            $table->index(['template', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};

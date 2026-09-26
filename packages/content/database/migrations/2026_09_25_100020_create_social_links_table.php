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
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->string('network', 64);
            $table->string('icon_class', 64)->nullable();
            $table->string('type', 64)->nullable();
            $table->string('url', 512);
            $table->string('app_url', 512)->nullable();
            $table->unsignedInteger('sort')->default(0)->index();
            $table->string('legacy_key')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_links');
    }
};

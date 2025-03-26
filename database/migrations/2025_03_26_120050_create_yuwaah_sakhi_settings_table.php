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
        Schema::create('yuwaah_sakhi_settings', function (Blueprint $table) {
            $table->id();
            $table->text('home_page_title')->nullable();
            $table->longText('description')->nullable();
            $table->integer('home_page_banner_type')->nullable();
            $table->text('youtube_url')->nullable();
            $table->text('banners')->nullable(); // Can be JSON data
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yuwaah_sakhi_settings');
    }
};

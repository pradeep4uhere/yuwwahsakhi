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
        Schema::create('yuwaah_sakhi_login_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Assuming YuwaahSakhi users have IDs
            $table->string('user_type')->nullable(); // Admin, Partner, Sakhi, etc.
            $table->string('ip_address')->nullable();
            $table->string('device')->nullable();
            $table->string('platform')->nullable();
            $table->string('browser')->nullable();
            $table->json('location')->nullable();
            $table->timestamp('login_time')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yuwaah_sakhi_login_logs');
    }
};

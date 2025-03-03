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
        Schema::create('partners', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('partner_id')->unique(); // Unique Partner ID
            $table->string('name'); // Partner name
            $table->string('contact_number'); // Contact number
            $table->string('email')->unique(); // Unique email
            $table->string('district')->nullable(); // Unique email
            $table->string('city')->nullable(); // Unique email
            $table->string('state')->nullable(); // Unique email
            //$table->string('address')->nullable(); // Unique email
            $table->dateTime('onboard_date'); // Onboard date
            $table->boolean('status')->default(1); // Status with default value true
            $table->timestamp('modified_at')->useCurrent()->useCurrentOnUpdate(); // Modified timestamp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};

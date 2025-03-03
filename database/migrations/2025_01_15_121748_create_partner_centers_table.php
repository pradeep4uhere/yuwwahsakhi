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
        Schema::create('partner_centers', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('partner_id'); // Unique Partner Center ID
            $table->string('center_name')->nullable(); // Center Name
            $table->string('contact_number')->nullable(); // Contact Number
            $table->string('email')->unique(); // Unique email
            $table->dateTime('onboard_date'); // Onboard Date
            $table->boolean('status')->default(1); // Status (active/inactive) with default value 1
            $table->text('address')->nullable();
            $table->string('district')->nullable(); // Replace 'column_name' with the name of the column after which you want to add these fields
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->timestamps(); // created_at and updated_at
            $table->timestamp('modified_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_centers');
    }
};

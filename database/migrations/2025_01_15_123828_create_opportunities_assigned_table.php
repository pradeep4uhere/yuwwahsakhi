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
        Schema::create('opportunities_assigned', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('leaner_id'); // Foreign key to leaners table
            $table->unsignedBigInteger('opportunites_id'); // Foreign key to opportunities table
            $table->unsignedBigInteger('yuwah_sakhi_id'); // Foreign key to yuwaah_sakhi table
            $table->dateTime('assigned_date'); // Date when the opportunity was assigned
            $table->timestamps(); // created_at and updated_at
            $table->timestamp('modified_at')->useCurrent()->useCurrentOnUpdate(); // Modified timestamp
        });

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opportunities_assigned');
    }
};

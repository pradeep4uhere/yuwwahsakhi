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
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('opportunities_title'); // Opportunities Title
            $table->longText('description'); // Detailed description of the opportunity
            $table->integer('payout_monthly'); // Monthly payout amount
            $table->date('start_date'); // Start date of the opportunity
            $table->date('end_date'); // End date of the opportunity
            $table->integer('number_of_openings'); // Number of available openings
            $table->string('provider_name'); // Name of the provider
            $table->string('document')->nullable(); // Optional document related to the opportunity (path)
            $table->timestamps(); // created_at and updated_at
            $table->timestamp('modified_at')->useCurrent()->useCurrentOnUpdate(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};

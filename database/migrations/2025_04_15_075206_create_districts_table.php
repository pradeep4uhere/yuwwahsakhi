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
        Schema::create('districts', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing id column
            $table->string('name'); // Creates a string column for district name
            $table->foreignId('state_id') // Creates the state_id column and sets it as a foreign key
                  ->constrained('states') // This automatically references the 'id' column in the 'states' table
                  ->onDelete('cascade'); // Ensures that if a state is deleted, the corresponding districts are also deleted
            $table->timestamps(); // Creates created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};

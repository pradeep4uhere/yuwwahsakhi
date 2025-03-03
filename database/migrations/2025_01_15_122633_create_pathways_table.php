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
        Schema::create('pathways', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('opportunity_id'); // Foreign key linking to opportunities table
            $table->string('pathway_title'); // Title of the pathway
            $table->integer('pathway_order'); // Order of the pathway
            $table->boolean('status')->default(1); // Status (active/inactive) with default value true
            $table->timestamps(); // created_at and updated_at
            $table->timestamp('modified_at')->useCurrent()->useCurrentOnUpdate(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pathways');
    }
};

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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->longText('promotional_descriptions'); // Description of the promotion
            $table->json('material_file'); // JSON field for promotion-related materials (e.g., links or file paths)
            $table->string('thumbnail')->nullable(); // Path to the thumbnail image (nullable)
            $table->string('banner')->nullable(); // Path to the banner image (nullable)
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
        Schema::dropIfExists('promotions');
    }
};

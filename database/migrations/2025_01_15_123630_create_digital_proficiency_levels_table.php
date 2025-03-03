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
        Schema::create('digital_proficiency_levels', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('proficiency_level'); // Level of digital proficiency
            $table->timestamps(); // created_at and updated_at
            $table->timestamp('modified_at')->useCurrent()->useCurrentOnUpdate(); // Modified timestamp
        });

        // Insert predefined digital proficiency levels
        DB::table('digital_proficiency_levels')->insert([
            ['proficiency_level' => 'Beginner'],
            ['proficiency_level' => 'Intermediate'],
            ['proficiency_level' => 'Advanced'],
            ['proficiency_level' => 'Expert'],
            ['proficiency_level' => 'Other']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digital_proficiency_levels');
    }
};

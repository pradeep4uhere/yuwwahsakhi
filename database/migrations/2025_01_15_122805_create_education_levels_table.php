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
        Schema::create('education_levels', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('level'); // Name of the education level
            $table->timestamps(); // created_at and updated_at
            $table->timestamp('modified_at')->useCurrent()->useCurrentOnUpdate();
        });


         // Insert predefined education levels
         DB::table('education_levels')->insert([
            ['level' => 'No Formal Education'],
            ['level' => 'Pre-Primary Education'],
            ['level' => 'Primary Education'],
            ['level' => 'Middle School'],
            ['level' => 'Secondary Education or High School'],
            ['level' => 'GED (General Educational Development)'],
            ['level' => 'Vocational Qualification'],
            ['level' => 'Technical Education'],
            ['level' => 'Certificate Program'],
            ['level' => 'Associate Degree'],
            ['level' => 'Bachelor\'s Degree'],
            ['level' => 'Post-Graduate Diploma'],
            ['level' => 'Professional Certification'],
            ['level' => 'Master\'s Degree'],
            ['level' => 'Doctoral Degree (Ph.D., Ed.D., etc.)'],
            ['level' => 'Professional Degree (MD, JD, DDS, etc.)'],
            ['level' => 'Post-Doctoral Studies'],
            ['level' => 'Other']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_levels');
    }
};

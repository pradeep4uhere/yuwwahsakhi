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
        Schema::create('specification_qualifications', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('qualification'); // Name of the specification qualification
            $table->timestamps(); // created_at and updated_at
            $table->timestamp('modified_at')->useCurrent()->useCurrentOnUpdate(); 
        });


         // Insert predefined specification qualifications
         DB::table('specification_qualifications')->insert([
            ['qualification' => 'No Formal Qualification'],
            ['qualification' => 'Basic Skill Certification'],
            ['qualification' => 'Intermediate Skill Certification'],
            ['qualification' => 'Advanced Skill Certification'],
            ['qualification' => 'Professional Certification'],
            ['qualification' => 'Vocational Qualification'],
            ['qualification' => 'Technical Certification'],
            ['qualification' => 'Degree Program'],
            ['qualification' => 'Post-Graduate Qualification'],
            ['qualification' => 'Doctoral Qualification'],
            ['qualification' => 'Diploma Program'],
            ['qualification' => 'Other']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specification_qualifications');
    }
};

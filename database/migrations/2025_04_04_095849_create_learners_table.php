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
        Schema::create('learners', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->string('email')->unique();
            $table->string('institution')->nullable();
            $table->string('education_level')->nullable();
            $table->string('digital_proficiency')->nullable();
            $table->string('english_knowledge')->nullable();
            $table->boolean('interested_in_opportunities')->default(false);
            $table->json('opportunity_types')->nullable(); // ["Get a job", "Earn at my own time", "Run a business"]
            
            // Get a Job section
            $table->string('job_mobility')->nullable(); // Nearby City
            $table->string('job_kind')->nullable(); // Customer Service
            $table->json('job_qualifications')->nullable(); // ["Excel", "CRM System", "Low-code No code"]
            $table->string('job_timing')->nullable(); // Immediately
            $table->string('experience_years')->nullable(); // 2 years

            // Earn at My Own Time section
            $table->integer('work_hours_per_day')->nullable(); // 6 hours
            $table->string('work_kind')->nullable(); // Computer based, phone based
            $table->json('earn_qualifications')->nullable();

            // Run a Business section
            $table->string('business_status')->nullable(); // Have an idea
            $table->text('business_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learners');
    }
};

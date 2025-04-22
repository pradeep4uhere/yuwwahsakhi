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
            $table->string('account_login_id')->nullable();
            $table->string('experiance')->nullable();
            $table->string('current_job_title')->nullable();
            $table->string('current_company_name')->nullable();
            $table->string('primary_email')->nullable();
            $table->string('primary_phone_number')->nullable();
            $table->string('secondary_phone_number')->nullable();
            $table->string('preferred_job_domain1')->nullable();
            $table->string('preferred_job_domain2')->nullable();
            $table->string('preferred_job_domain3')->nullable();
            $table->string('preferred_job_domain4')->nullable();
            $table->string('preferred_mode_of_work')->nullable();
            $table->string('highest_education_qualification')->nullable();
            $table->string('preferred_work_location1')->nullable();
            $table->string('preferred_work_location2')->nullable();
            $table->string('preferred_work_location3')->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('update_date')->nullable();
            $table->string('last_month_salary')->nullable();
            $table->string('preferred_skill1')->nullable();
            $table->string('preferred_skill1_proficiency')->nullable();
            $table->string('preferred_skill2')->nullable();
            $table->string('preferred_skill2_proficiency')->nullable();
            $table->string('preferred_skill3')->nullable();
            $table->string('preferred_skill3_proficiency')->nullable();
            $table->string('preferred_skill4')->nullable();
            $table->string('preferred_skill4_proficiency')->nullable();
            $table->string('preferred_skill5')->nullable();
            $table->string('preferred_skill5_proficiency')->nullable();
            $table->string('current_street')->nullable();
            $table->string('current_location_zip')->nullable();
            $table->text('career_objective')->nullable();
            $table->string('resume_url')->nullable();
            $table->boolean('dont_show_my_profile_to_current_employer')->default(false);
            $table->boolean('receive_email_updates')->default(false);
            $table->string('profile_photo_url')->nullable();
            $table->string('yuwaah_resume_url')->nullable();
            $table->boolean('profile_visible_to_others')->default(false);
            $table->string('additional_link')->nullable();
            $table->string('preferred_job_type')->nullable();
            $table->string('preferred_industry1')->nullable();
            $table->string('preferred_industry2')->nullable();
            $table->string('preferred_industry3')->nullable();
            $table->string('preferred_work_time')->nullable();
            $table->string('app_version_used')->nullable();
            $table->timestamp('yuwaah_resume_create_date')->nullable();
            $table->timestamp('yuwaah_resume_update_date')->nullable();
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

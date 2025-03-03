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
        Schema::create('yuwaah_sakhi', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('sakhi_id')->unique(); // Unique Sakhi ID
            $table->string('name'); // Name
            $table->string('contact_number'); // Contact Number
            $table->string('email')->unique(); // Unique email
            $table->dateTime('onboard_date'); // Onboard Date
            $table->boolean('status')->default(1); // Status (active/inactive) with default value true
            $table->date('dob'); // Date of Birth
            $table->enum('kof', ['Beigner', 'Intermidieate', 'Fluent']); // Level of Knowledge of Functions (KOF)
            $table->integer('year_of_exp'); // Years of experience
            $table->enum('gender', ['Male', 'Female', 'Other']); // Gender
            $table->integer('work_hour_in_day'); // Work hours per day
            $table->integer('education_level'); // Education level (numeric representation)
            $table->string('infrastructure_available'); // Infrastructure available
            $table->integer('specific_qualification'); // Specific qualification (numeric representation)
            $table->integer('service_offered'); // Number of services offered
            $table->enum('loan_taken', ['Yes', 'No']); // Whether loan has been taken
            $table->enum('courses_completed', ['Yes', 'No']); // Whether courses are completed
            $table->integer('type_of_loan')->nullable(); // Type of loan (numeric representation)
            $table->integer('digital_proficiency'); // Digital proficiency (numeric representation)
            $table->decimal('loan_amount', 15, 2)->nullable(); // Loan amount
            $table->decimal('loan_balance', 15, 2)->nullable(); // Loan balance
            $table->string('center_picture')->nullable(); // Center picture path
            $table->string('profile_picture')->nullable(); // Profile picture path
            $table->string('state'); // State
            $table->string('city'); // City
            $table->string('address'); // Address
            $table->timestamps(); // created_at and updated_at
            $table->timestamp('modified_at')->useCurrent()->useCurrentOnUpdate(); // Modified timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yuwaah_sakhi');
    }
};

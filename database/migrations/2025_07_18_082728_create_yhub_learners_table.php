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
        Schema::create('yhub_learners', function (Blueprint $table) {
            $table->id();
            $table->string('country')->nullable();
            $table->string('user_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email_address')->nullable();
            $table->string('gender')->nullable();
            $table->string('role')->nullable();
            $table->string('grade')->nullable();
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('school')->nullable();
            $table->string('course_name')->nullable();
            $table->boolean('completion_status')->default(0);
            $table->dateTime('course_end_datetime')->nullable();
            $table->string('completion_percent')->nullable(); // If always '100%', you may store as integer.
            $table->date('load_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yhub_learners');
    }
};

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
        Schema::create('learner_courses', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number',150);
            $table->string('course_name')->nullable();
            $table->enum('completed_course',['Yes','No'])->default('No');
            $table->dateTime('load_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learner_courses');
    }
};

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
            $table->id(); // Auto-incrementing primary key
            $table->string('firstname'); // First name of the learner
            $table->string('lastname'); // Last name of the learner
            $table->string('email')->unique(); // Email of the learner, unique
            $table->string('mobile'); // Mobile number of the learner
            $table->integer('age'); // Age of the learner
            $table->string('gender'); // Gender of the learner
            $table->string('address'); // Address of the learner
            $table->string('city'); // City of the learner
            $table->string('district'); // District of the learner
            $table->string('state'); // State of the learner
            $table->timestamps(); // created_at and updated_at
            $table->timestamp('modified_at')->useCurrent()->useCurrentOnUpdate(); // Modified timestamp
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

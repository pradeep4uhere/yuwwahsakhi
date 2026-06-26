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
        Schema::create('field_agent_summaries', function (Blueprint $table) {

            $table->id();

            // Agent Information
            $table->unsignedBigInteger('sakhi_id')->unique();
            $table->unsignedBigInteger('partner_id')->index();
            $table->string('csc_id')->nullable()->index();

            /*
            |--------------------------------------------------------------------------
            | Job Summary
            |--------------------------------------------------------------------------
            */

            $table->integer('total_jobs')->default(0);
            $table->integer('open_jobs')->default(0);
            $table->integer('pending_jobs')->default(0);
            $table->integer('accepted_jobs')->default(0);
            $table->integer('rejected_jobs')->default(0);

            /*
            |--------------------------------------------------------------------------
            | Social Protection Summary
            |--------------------------------------------------------------------------
            */

            $table->integer('total_social')->default(0);
            $table->integer('open_social')->default(0);
            $table->integer('pending_social')->default(0);
            $table->integer('accepted_social')->default(0);
            $table->integer('rejected_social')->default(0);

            /*
            |--------------------------------------------------------------------------
            | Learner Summary
            |--------------------------------------------------------------------------
            */

            $table->integer('learner_count')->default(0);
            $table->integer('completed_learners')->default(0);

            /*
            |--------------------------------------------------------------------------
            | Optional
            |--------------------------------------------------------------------------
            */

            $table->timestamp('summary_generated_at')->nullable();

            $table->timestamps();

            // Foreign key (optional)
            //$table->foreign('sakhi_id')
            //      ->references('id')
            //      ->on('yuwaah_sakhi')
            //      ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_agent_summaries');
    }
};

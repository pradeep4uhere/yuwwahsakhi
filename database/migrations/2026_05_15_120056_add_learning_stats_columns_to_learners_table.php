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
        Schema::table('learners', function (Blueprint $table) {
      
        $table->integer('no_of_applied_jobs')
            ->default(0)
            ->after('no_of_pathway_enrolled');

        $table->integer('no_of_applied_courses')
            ->default(0)
            ->after('no_of_applied_jobs');

        $table->json('partner_wise_course_counts')
            ->nullable()
            ->after('no_of_applied_courses');

        $table->json('partner_wise_job_counts')
            ->nullable()
            ->after('partner_wise_course_counts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('learners', function (Blueprint $table) {
            $table->dropColumn([
                'no_of_applied_jobs',
                'no_of_applied_courses',
                'partner_wise_course_counts',
                'partner_wise_job_counts',
            ]);
        });
    }
};

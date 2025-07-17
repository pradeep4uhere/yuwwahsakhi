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
            $table->string('MONTHLY_FAMILY_INCOME_RANGE', 100)->nullable();
            $table->string('USER_EMAIL', 150)->nullable();
            $table->string('DISTRICT_CITY', 100)->nullable();
            $table->string('STATE', 100)->nullable();
            $table->string('PIN_CODE', 20)->nullable();
            
            $table->string('PROGRAM_CODE', 100)->nullable();
            $table->string('PROGRAM_STATE', 100)->nullable();
            $table->string('PROGRAM_DISTRICT', 100)->nullable();
            $table->string('UNIT_INSTITUTE', 150)->nullable();
        
            $table->string('SOCIAL_CATEGORY', 100)->nullable();
            $table->string('RELIGION', 100)->nullable();
            $table->string('USER_MARIAL_STATUS', 100)->nullable();
            $table->string('DIFFRENTLY_ABLED', 100)->nullable();
        
            $table->text('IDENTITY_DOCUMENTS')->nullable();
            $table->text('REASON_FOR_LEARNING_NEW_SKILLS')->nullable();
            $table->text('EARN_AT_MY_OWN_TIME')->nullable();
            $table->text('RELOCATE_FOR_JOB')->nullable();
            $table->text('WHEN_CAN_USER_START')->nullable();
            $table->text('USER_NEED_HELP_WITH')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('learners', function (Blueprint $table) {
            $table->dropColumn([
                'MONTHLY_FAMILY_INCOME_RANGE',
                'USER_EMAIL',
                'DISTRICT_CITY',
                'STATE',
                'PIN_CODE',
                'PROGRAM_CODE',
                'PROGRAM_STATE',
                'PROGRAM_DISTRICT',
                'UNIT_INSTITUTE',
                'SOCIAL_CATEGORY',
                'RELIGION',
                'USER_MARIAL_STATUS',
                'DIFFRENTLY_ABLED',
                'IDENTITY_DOCUMENTS',
                'REASON_FOR_LEARNING_NEW_SKILLS',
                'EARN_AT_MY_OWN_TIME',
                'RELOCATE_FOR_JOB',
                'WHEN_CAN_USER_START',
                'USER_NEED_HELP_WITH',
            ]);
        });
    }
};

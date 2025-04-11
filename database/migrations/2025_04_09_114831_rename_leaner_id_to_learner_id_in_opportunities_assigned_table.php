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
        Schema::table('opportunities_assigned', function (Blueprint $table) {
            $table->renameColumn('leaner_id', 'learner_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('opportunities_assigned', function (Blueprint $table) {
            $table->renameColumn('learner_id', 'leaner_id');
        });
    }
};

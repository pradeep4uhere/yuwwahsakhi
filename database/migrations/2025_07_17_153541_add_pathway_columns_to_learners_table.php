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
            $table->integer('no_of_pathway_completed')->default(0)->after('interested_in_opportunities');
            $table->integer('no_of_pathway_enrolled')->default(0)->after('no_of_pathway_completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('learners', function (Blueprint $table) {
            $table->dropColumn(['no_of_pathway_completed', 'no_of_pathway_enrolled']);
        });
    }
};

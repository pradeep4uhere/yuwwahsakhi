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
        Schema::table('event_transactions', function (Blueprint $table) {
            $table->string('review_status')->nullable()->after('id'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_transactions', function (Blueprint $table) {
            $table->dropColumn('review_status');
        });
    }
};

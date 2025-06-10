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
        Schema::table('yuwaah_event_masters', function (Blueprint $table) {
            $table->unsignedBigInteger('event_type_id')->nullable()->after('id'); // Adjust position as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('yuwaah_event_masters', function (Blueprint $table) {
            $table->dropColumn('event_type_id');
        });
    }
};

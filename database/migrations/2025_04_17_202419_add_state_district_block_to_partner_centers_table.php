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
        Schema::table('partner_centers', function (Blueprint $table) {
            $table->unsignedBigInteger('state_id')->nullable()->after('id');
            $table->unsignedBigInteger('district_id')->nullable()->after('state_id');
            $table->unsignedBigInteger('block_id')->nullable()->after('district_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partner_centers', function (Blueprint $table) {
            $table->dropColumn(['state_id', 'district_id', 'block_id']);
        });
    }
};

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
        Schema::table('partners', function (Blueprint $table) {
            $table->unsignedBigInteger('state_id')->nullable()->after('id');
            $table->unsignedBigInteger('district_id')->nullable()->after('state_id');
            $table->unsignedBigInteger('block_id')->nullable()->after('district_id');
            $table->string('pincode', 10)->nullable()->after('block_id');

            // Add foreign keys if related tables exist
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('set null');
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropForeign(['state_id']);
            $table->dropForeign(['district_id']);
            $table->dropForeign(['block_id']);
            $table->dropColumn(['state_id', 'district_id', 'block_id', 'pincode']);
        });
    }
};

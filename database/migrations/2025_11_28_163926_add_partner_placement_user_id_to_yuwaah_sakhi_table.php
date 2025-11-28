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
        Schema::table('yuwaah_sakhi', function (Blueprint $table) {
            $table->unsignedBigInteger('partner_placement_user_id')
              ->nullable()
              ->after('id');

            $table->foreign('partner_placement_user_id')
                ->references('id')
                ->on('partner_placement_users')
                ->onDelete('set null'); // optional
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('yuwaah_sakhi', function (Blueprint $table) {
            $table->dropForeign(['partner_placement_user_id']);
            $table->dropColumn('partner_placement_user_id');
        });
    }
};

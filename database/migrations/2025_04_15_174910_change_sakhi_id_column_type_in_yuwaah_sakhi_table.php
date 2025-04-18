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
            $table->string('sakhi_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('yuwaah_sakhi', function (Blueprint $table) {
            $table->bigInteger('sakhi_id')->unsigned()->change();
        });
    }
};

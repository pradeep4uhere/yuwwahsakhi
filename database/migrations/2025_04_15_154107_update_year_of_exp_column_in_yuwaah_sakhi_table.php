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
            $table->string('year_of_exp')->change(); // change to string
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('yuwaah_sakhi', function (Blueprint $table) {
            $table->integer('year_of_exp')->change(); 
        });
    }
};

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
            $table->string('district')->nullable()->after('status'); // Replace 'column_name' with the name of the column after which you want to add these fields
            $table->string('city')->nullable()->after('district');
            $table->string('state')->nullable()->after('city');
            $table->string('address')->nullable()->after('state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partner_centers', function (Blueprint $table) {
            $table->dropColumn(['district', 'city', 'state']);
        });
    }
};

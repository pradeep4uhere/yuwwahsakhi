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
            $table->string('status')->default(1)->after('document_3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('yuwaah_event_masters', function (Blueprint $table) {
            //
        });
    }
};

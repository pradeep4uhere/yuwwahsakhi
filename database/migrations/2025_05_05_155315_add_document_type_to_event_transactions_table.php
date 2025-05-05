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
            $table->string('document_type')->nullable()->after('uploaded_doc_links');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_transactions', function (Blueprint $table) {
            $table->dropColumn('document_type');
        });
    }
};

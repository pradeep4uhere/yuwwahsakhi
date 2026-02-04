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
        Schema::table('yhub_learners', function (Blueprint $table) {
            DB::statement("
            ALTER TABLE yhub_learners
            ADD normalized_mobile VARCHAR(10)
            GENERATED ALWAYS AS (RIGHT(email_address,10)) STORED
            ");

            DB::statement("
                CREATE INDEX idx_norm_mobile_yhub
                ON yhub_learners(normalized_mobile)
            ");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('yhub_learners', function (Blueprint $table) {
            DB::statement("DROP INDEX idx_norm_mobile_yhub ON yhub_learners");
            DB::statement("ALTER TABLE yhub_learners DROP COLUMN normalized_mobile");
        });
    }
};

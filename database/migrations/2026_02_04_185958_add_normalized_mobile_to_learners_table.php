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
        Schema::table('learners', function (Blueprint $table) {
            DB::statement("
            ALTER TABLE learners 
            ADD normalized_mobile VARCHAR(10)
            GENERATED ALWAYS AS (RIGHT(primary_phone_number,10)) STORED
            ");

            DB::statement("
                CREATE INDEX idx_norm_mobile1 
                ON learners(normalized_mobile)
            ");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('learners', function (Blueprint $table) {
            DB::statement("DROP INDEX idx_norm_mobile1 ON learners");
            DB::statement("ALTER TABLE learners DROP COLUMN normalized_mobile");
        });
    }
};

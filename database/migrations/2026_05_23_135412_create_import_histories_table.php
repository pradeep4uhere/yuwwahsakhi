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
        Schema::create('import_histories', function (Blueprint $table) {
            $table->id();

            $table->integer('total_rows')->default(0);

            $table->integer('processed_rows')->default(0);

            $table->integer('updated_rows')->default(0);

            $table->integer('inserted_rows')->default(0);

            $table->longText('logs')->nullable();

            $table->string('status')->default('processing');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_histories');
    }
};

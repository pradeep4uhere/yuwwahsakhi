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
        Schema::create('yuwaah_event_masters', function (Blueprint $table) {
            $table->id();
            $table->enum('event_type', ['Course', 'Social Protection', 'Jobs', 'Self Empl / Entrepreneurship']);
            $table->string('event_category');
            $table->text('description')->nullable();
            $table->string('eligibility')->nullable();
            $table->decimal('fee_per_completed_transaction', 10, 2)->nullable();
            $table->date('date_event_created_in_master');
            $table->string('document_1')->nullable();
            $table->string('document_2')->nullable();
            $table->string('document_3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
        public function down(): void
        {
            Schema::dropIfExists('yuwaah_event_masters');
        }
};

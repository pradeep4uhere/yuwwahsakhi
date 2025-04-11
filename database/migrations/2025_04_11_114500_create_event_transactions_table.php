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
        Schema::create('event_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('beneficiary_phone_number')->nullable();
            $table->string('beneficiary_name')->nullable();
            $table->string('event_id')->nullable();
            $table->string('event_type')->nullable();
            $table->string('event_category')->nullable();
            $table->string('event_name')->nullable();
            $table->date('event_date_created')->nullable();
            $table->date('event_date_submitted')->nullable();
            $table->decimal('event_value', 10, 2)->nullable(); // adjust precision if needed
            $table->unsignedBigInteger('ys_id')->nullable();
            $table->text('uploaded_doc_links')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_transactions');
    }
};

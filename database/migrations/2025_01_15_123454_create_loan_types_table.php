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
        Schema::create('loan_types', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('loan_type'); // Type of loan
            $table->timestamps(); // created_at and updated_at
            $table->timestamp('modified_at')->useCurrent()->useCurrentOnUpdate(); // Modified timestamp
        });

        // Insert predefined types of loans
        DB::table('loan_types')->insert([
            ['loan_type' => 'Personal Loan'],
            ['loan_type' => 'Home Loan'],
            ['loan_type' => 'Car Loan'],
            ['loan_type' => 'Education Loan'],
            ['loan_type' => 'Business Loan'],
            ['loan_type' => 'Government Loan'],
            ['loan_type' => 'Micro Loan'],
            ['loan_type' => 'Payday Loan'],
            ['loan_type' => 'Loan Against Property'],
            ['loan_type' => 'Gold Loan'],
            ['loan_type' => 'Consumer Loan'],
            ['loan_type' => 'Other']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_types');
    }
};

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
        Schema::create('services_offered', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('service_name'); // Name of the service offered
            $table->timestamps(); // created_at and updated_at
            $table->timestamp('modified_at')->useCurrent()->useCurrentOnUpdate(); // Modified timestamp
        });


         // Insert predefined services offered
         DB::table('services_offered')->insert([
            ['service_name' => 'Consultation'],
            ['service_name' => 'Technical Support'],
            ['service_name' => 'Training'],
            ['service_name' => 'Product Installation'],
            ['service_name' => 'Maintenance'],
            ['service_name' => 'Customer Support'],
            ['service_name' => 'Project Management'],
            ['service_name' => 'Financial Services'],
            ['service_name' => 'Marketing Services'],
            ['service_name' => 'Content Creation'],
            ['service_name' => 'Research and Development'],
            ['service_name' => 'Logistics'],
            ['service_name' => 'Other']
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_offered');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrat
     */
    public function up(): void
    {
        Schema::create('delivery_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId("Delivery_Id")->constrained("delaveries");
            $table->foreignId("Clinic_Id")->constrained("users");
            $table->foreignId("bills_Id")->constrained("bills");
            $table->enum("status",["Success","failure","Underway"])->default("Underway");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_reports');
    }
};

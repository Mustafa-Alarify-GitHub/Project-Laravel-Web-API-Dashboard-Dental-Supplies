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
        Schema::create('delaveries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId("Manger_Id")->constrained("users");
            $table->enum('status',["Online","OffLine","Busy"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delaveries');
    }
};

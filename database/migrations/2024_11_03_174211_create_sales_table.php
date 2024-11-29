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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_Id")->constrained("products");
            $table->foreignId("Manger_Id")->constrained("users");
            $table->integer('counter');
            $table->decimal('total_price');
            $table->boolean('Order')->default(false);
            $table->enum('StatusOrder',["A","B","C"])->nullable();
            $table->foreignId("deliver_id")->nullable()->constrained("delaveries");
            $table->foreignId("Bill_Id")->constrained("bills");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

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
        Schema::create('resell', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->comment('reseller id');
            $table->string('product_id')->comment('product id');
            $table->string('price')->comment('price');
            $table->string('quantity')->comment('quantity');
            $table->string('status')->comment('1=active, 0=inactive, 2=sold');
            $table->string('product_condition')->comment('1=new, 2=used');
            $table->string('description')->comment('description');
            $table->string('images')->comment('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resell');
    }
};

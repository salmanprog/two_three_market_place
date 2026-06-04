<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingPlanFeaturesTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('pricing_plan_features')) {
            return;
        }

        Schema::create('pricing_plan_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pricing_id');
            $table->string('title');
            $table->string('icon')->nullable()->default('fas fa-check');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('pricing_id')
                ->references('id')
                ->on('pricings')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pricing_plan_features');
    }
}

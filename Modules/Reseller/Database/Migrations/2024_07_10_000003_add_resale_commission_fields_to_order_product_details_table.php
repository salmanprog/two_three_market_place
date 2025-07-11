<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResaleCommissionFieldsToOrderProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_product_details', function (Blueprint $table) {
            $table->decimal('reseller_commission', 10, 2)->nullable()->after('total_price');
            $table->decimal('admin_commission', 10, 2)->nullable()->after('reseller_commission');
            $table->unsignedBigInteger('resell_request_id')->nullable()->after('admin_commission');
            
            // Foreign key constraint
            $table->foreign('resell_request_id')->references('id')->on('resell_requests')->onDelete('set null');
            
            // Index
            $table->index(['reseller_commission', 'admin_commission']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_product_details', function (Blueprint $table) {
            $table->dropForeign(['resell_request_id']);
            $table->dropIndex(['reseller_commission', 'admin_commission']);
            $table->dropColumn(['reseller_commission', 'admin_commission', 'resell_request_id']);
        });
    }
} 
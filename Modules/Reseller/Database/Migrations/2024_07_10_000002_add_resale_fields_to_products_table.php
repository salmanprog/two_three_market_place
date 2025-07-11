<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResaleFieldsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_resale_enabled')->default(false)->after('status');
            $table->unsignedBigInteger('resell_request_id')->nullable()->after('is_resale_enabled');
            $table->decimal('resale_price', 10, 2)->nullable()->after('resell_request_id');
            $table->enum('resale_condition', ['new', 'used'])->nullable()->after('resale_price');
            $table->unsignedBigInteger('reseller_id')->nullable()->after('resale_condition');
            
            // Foreign key constraint
            $table->foreign('resell_request_id')->references('id')->on('resell_requests')->onDelete('set null');
            $table->foreign('reseller_id')->references('id')->on('users')->onDelete('set null');
            
            // Index
            $table->index(['is_resale_enabled', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['resell_request_id']);
            $table->dropForeign(['reseller_id']);
            $table->dropIndex(['is_resale_enabled', 'status']);
            $table->dropColumn(['is_resale_enabled', 'resell_request_id', 'resale_price', 'resale_condition', 'reseller_id']);
        });
    }
} 
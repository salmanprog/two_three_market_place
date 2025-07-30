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
        Schema::table('products', function (Blueprint $table) {
            // Add resell-related columns if they don't exist
            if (!Schema::hasColumn('products', 'resell_price')) {
                $table->decimal('resell_price', 10, 2)->nullable()->after('resell_product');
            }
            if (!Schema::hasColumn('products', 'resell_condition')) {
                $table->string('resell_condition')->nullable()->after('resell_price');
            }
            if (!Schema::hasColumn('products', 'resell_description')) {
                $table->text('resell_description')->nullable()->after('resell_condition');
            }
            if (!Schema::hasColumn('products', 'reseller_id')) {
                $table->unsignedBigInteger('reseller_id')->nullable()->after('resell_description');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['resell_price', 'resell_condition', 'resell_description', 'reseller_id']);
        });
    }
};

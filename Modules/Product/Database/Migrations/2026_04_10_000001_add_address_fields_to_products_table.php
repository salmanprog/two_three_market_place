<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'city')) {
                $table->string('city', 191)->nullable()->after('location');
            }
            if (! Schema::hasColumn('products', 'state')) {
                $table->string('state', 191)->nullable()->after('city');
            }
            if (! Schema::hasColumn('products', 'zip_code')) {
                $table->string('zip_code', 32)->nullable()->after('state');
            }
            if (! Schema::hasColumn('products', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable()->after('zip_code');
            }
            if (! Schema::hasColumn('products', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            foreach (['longitude', 'latitude', 'zip_code', 'state', 'city'] as $col) {
                if (Schema::hasColumn('products', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};

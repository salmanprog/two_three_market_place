<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (! Schema::hasColumn('events', 'current_latitude')) {
                $table->decimal('current_latitude', 10, 8)->nullable()->after('location');
            }
            if (! Schema::hasColumn('events', 'current_longitude')) {
                $table->decimal('current_longitude', 11, 8)->nullable()->after('current_latitude');
            }
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'current_longitude')) {
                $table->dropColumn('current_longitude');
            }
            if (Schema::hasColumn('events', 'current_latitude')) {
                $table->dropColumn('current_latitude');
            }
        });
    }
};

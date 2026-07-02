<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('user_suggest_colors') || Schema::hasColumn('user_suggest_colors', 'job_name')) {
            return;
        }

        Schema::table('user_suggest_colors', function (Blueprint $table) {
            $table->string('job_name', 191)->nullable()->after('colors');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('user_suggest_colors') || ! Schema::hasColumn('user_suggest_colors', 'job_name')) {
            return;
        }

        Schema::table('user_suggest_colors', function (Blueprint $table) {
            $table->dropColumn('job_name');
        });
    }
};

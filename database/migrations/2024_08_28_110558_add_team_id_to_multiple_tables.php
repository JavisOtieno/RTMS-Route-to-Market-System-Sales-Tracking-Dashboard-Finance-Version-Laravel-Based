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
        $tables = [
            'clockins',
            'clockouts',
            'competitors',
            'feedback',
            'outlets',
            'posaudits',
            'products',
            'regions',
            'routeplans',
            'sales',
            'target_groups',
            'territories',
            'users',
            'visits',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                if (!Schema::hasColumn($table->getTable(), 'team_id')) {
                    $table->unsignedBigInteger('team_id')->nullable()->after('organization_id');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'clockins',
            'clockouts',
            'competitors',
            'feedback',
            'outlets',
            'posaudits',
            'products',
            'regions',
            'routeplans',
            'sales',
            'target_groups',
            'territories',
            'users',
            'visits',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('team_id');
            });
        }
    }
};

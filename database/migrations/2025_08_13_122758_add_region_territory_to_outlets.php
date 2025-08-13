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
        Schema::table('outlets', function (Blueprint $table) {
            //
            $table->string('region_id')->nullable()->after('image'); 
            $table->string('territory_id')->nullable()->after('region_id'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('outlets', function (Blueprint $table) {
            //
            $table->dropColumn('region_id');
            $table->dropColumn('territory_id');
        });
    }
};

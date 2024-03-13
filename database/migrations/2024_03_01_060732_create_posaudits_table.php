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
        Schema::create('posaudits', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('outlet_id');
            $table->string('name');
            $table->string('sku');
            $table->string('pieces');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posaudits');
    }
};

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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->integer('outlet_id');
            $table->integer('user_id');
            $table->string('checkin_time');
            $table->string('checkin_latitude');
            $table->string('checkin_longitude');
            $table->string('checkout_time');
            $table->string('checkout_latitude');
            $table->string('checkout_longitude');
            $table->string('duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};

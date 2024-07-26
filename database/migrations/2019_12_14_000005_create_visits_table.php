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
            $table->unsignedBigInteger('outlet_id'); 
            $table->foreign('outlet_id')->references('id')->on('outlets');
            //->onDelete('cascade')
            //$table->foreign('outlet_id')->constrained();
            //$table->integer('user_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('clockin_id');
            $table->foreign('clockin_id')->references('id')->on('clockins');
            //$table->foreign('user_id')->constrained();
            $table->string('checkin_time');
            $table->string('checkin_latitude');
            $table->string('checkin_longitude');
            $table->string('checkout_time');
            $table->string('checkout_latitude');
            $table->string('checkout_longitude');
            $table->string('duration');
            //$table->integer('organization_id');
            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->softDeletes();
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

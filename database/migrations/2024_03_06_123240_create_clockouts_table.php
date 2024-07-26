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
        Schema::create('clockouts', function (Blueprint $table) {
            $table->id();
            //$table->integer('user_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('clockin_id');
            $table->foreign('clockin_id')->references('id')->on('clockins');
            
            //->onDelete('cascade');
            $table->string('time');
            $table->string('lat');
            $table->string('long');
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
        Schema::dropIfExists('clockouts');
    }
};

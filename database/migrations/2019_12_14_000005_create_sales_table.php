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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            // $table->integer('user_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            //$table->integer('outlet_id');
            $table->unsignedBigInteger('outlet_id'); 
            $table->foreign('outlet_id')->references('id')->on('outlets');
            //$table->integer('visit_id');
            $table->unsignedBigInteger('visit_id'); 
            $table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
            $table->string('pieces');
            $table->string('value');
            // $table->integer('organization_id');
            $table->unsignedBigInteger('organization_id');
            //$table->foreign('organization_id')->references('id')->on('organizations');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

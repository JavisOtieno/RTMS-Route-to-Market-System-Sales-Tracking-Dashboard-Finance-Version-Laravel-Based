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
        Schema::create('posaudit_items', function (Blueprint $table) {
            $table->id();
            //$table->string('posaudit_id');
            $table->unsignedBigInteger('posaudit_id'); 
            $table->foreign('posaudit_id')->references('id')->on('posaudits')->onDelete('cascade');
            // $table->string('product_id');
            $table->unsignedBigInteger('product_id'); 
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('pieces');
            // $table->integer('organization_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posaudit_items');
    }
};

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('usertype');
            // WE ALLOW DEFAULT TARGET GROUP, REGION, TERRITORY AS ZERO SO THEY DON'T HAVE TO BE WITHIN THE TABLE

            // $table->integer('target_group_id');
            $table->unsignedBigInteger('target_group_id');
            // $table->foreign('target_group_id')->references('id')->on('target_groups');
            $table->unsignedBigInteger('region_id');
            // $table->foreign('region_id')->references('id')->on('regions');
            $table->unsignedBigInteger('territory_id');
            // $table->foreign('territory_id')->references('id')->on('territories');
            // $table->integer('organization_id');
            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

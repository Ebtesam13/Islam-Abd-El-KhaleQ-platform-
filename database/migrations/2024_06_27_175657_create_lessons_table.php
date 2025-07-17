<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->float('duration')->nullable();
            $table->integer('unit_id');
            $table->integer('number_of_codes')->default(0);
            $table->float('price');
            $table->string('video');
            $table->string('image_path')->nullable();
            $table->string('facebook_link')->default('https://www.facebook.com/');
            $table->string('instagram_link')->default('https://www.instagram.com/');
            $table->string('x_link')->nullable('https://x.comz');
            $table->integer('expiry_days')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};

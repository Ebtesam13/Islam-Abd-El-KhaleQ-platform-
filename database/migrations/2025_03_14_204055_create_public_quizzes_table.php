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
        Schema::create('public_quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('active')->default(0);
            $table->integer('time')->comment('Quiz duration in minutes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_quizzes');
    }
};

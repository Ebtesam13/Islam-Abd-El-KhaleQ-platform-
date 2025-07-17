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
        Schema::create('student_lesson_access', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // Reference to user
            $table->unsignedBigInteger('lesson_id'); // Reference to lesson
            $table->string('access_code'); // Code provided by student
            $table->timestamp('expires_at'); // Expiry of the code
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_lesson_access');
    }
};

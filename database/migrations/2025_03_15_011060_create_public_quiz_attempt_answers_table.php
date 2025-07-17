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
        Schema::create('public_quiz_attempt_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_attempt_id')->constrained('public_quiz_attempts')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('public_questions')->onDelete('cascade');
            $table->unsignedBigInteger('answer_id')->nullable();
            $table->timestamps();
        });

        // Add foreign key constraint after table creation
        Schema::table('public_quiz_attempt_answers', function (Blueprint $table) {
            $table->foreign('answer_id')->references('id')->on('public_answers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('public_quiz_attempt_answers', function (Blueprint $table) {
            $table->dropForeign(['answer_id']);
        });
        Schema::dropIfExists('public_quiz_attempt_answers');
    }
};

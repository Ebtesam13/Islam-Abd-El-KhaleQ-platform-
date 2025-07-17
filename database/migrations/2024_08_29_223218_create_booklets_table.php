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
        Schema::create('booklets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('number_of_codes');
            $table->string('file_path'); // To store the path of the PDF file
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade'); // Foreign key to Quiz model
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booklets');
    }
};

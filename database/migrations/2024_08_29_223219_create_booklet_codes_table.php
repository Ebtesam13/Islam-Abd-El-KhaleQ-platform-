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
        Schema::create('booklet_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('booklet_id')->constrained()->onDelete('cascade'); // Foreign key to Booklet model
            $table->integer('expiry_days')->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booklet_codes');
    }
};

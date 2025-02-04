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
        Schema::create('libraries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->string('year')->nullable();
            $table->string('isbn')->nullable();
            $table->string('lang')->nullable();
            $table->string('pages')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('book_category_id')->default(1);
            $table->foreignId('user_id');
            $table->string('images')->nullable();
            $table->string('pdf')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libraries');
    }
};

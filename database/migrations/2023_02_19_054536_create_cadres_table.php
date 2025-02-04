<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cadres', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('address', 150)->nullable();
            $table->string('nim', 16)->nullable();
            $table->enum('gender', ['L', 'P'])->nullable();
            $table->string('place_of_borth', 20)->nullable();
            $table->string('date_of_birth', 20)->nullable();
            $table->string('wa', 15)->nullable();
            $table->string('hobby', 15)->nullable();
            $table->string('highschool', 50)->nullable();
            $table->string('grad_year', 10)->nullable();
            $table->string('boarding_school', 50)->nullable();
            $table->string('college_year', 10)->nullable();
            $table->string('fakultas')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('makesta_year', 10)->nullable();
            $table->string('organizer_makesta', 30)->nullable();
            $table->string('lakmud_year', 10)->nullable();
            $table->string('lakut_year', 10)->nullable();
            $table->string('latinpel_year', 10)->nullable();
            $table->string('informal', 100)->nullable();
            $table->string('organizer_informal', 100)->nullable();
            $table->string('nonformal', 100)->nullable();
            $table->string('organizer_nonformal', 100)->nullable();
            $table->string('images', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cadres');
    }
};

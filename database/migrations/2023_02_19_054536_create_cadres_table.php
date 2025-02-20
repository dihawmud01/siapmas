<?php

use App\Enums\CadreLevel;
use App\Enums\Gender;
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
            $table->enum('gender', Gender::getAll())->nullable();
            $table->string('place_of_birth', 20)->nullable();
            $table->string('date_of_birth', 20)->nullable();
            $table->string('phone', 13)->nullable();
            $table->string('highschool', 50)->nullable();
            $table->year('grad_year')->nullable();
            $table->string('boarding_school', 50)->nullable();
            $table->year('college_year')->nullable();
            $table->enum('cadre_level', CadreLevel::getAll())->default(CadreLevel::NON_MAKESTA);
            $table->string('organizer_makesta', 255)->nullable();
            $table->year('makesta_year')->nullable();
            $table->year('lakmud_year')->nullable();
            $table->year('lakut_year')->nullable();
            $table->year('latinpel_year')->nullable();
            $table->string('informal', 100)->nullable();
            $table->string('organizer_informal', 100)->nullable();
            $table->string('nonformal', 100)->nullable();
            $table->string('organizer_nonformal', 100)->nullable();
            $table->string('img', 100)->nullable();
            $table
                ->foreignId('pac_id')
                ->constrained('pac')
                ->onDelete('cascade');
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

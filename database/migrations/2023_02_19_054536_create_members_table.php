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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->enum('gender', Gender::getAll());
            $table->string('place_of_birth', 20);
            $table->date('date_of_birth');
            $table->text('address');
            $table->string('phone', 13);
            $table->enum('cadre_levels', CadreLevel::getAll());
            $table->year('makesta_year')->nullable();
            $table->year('lakmud_year')->nullable();
            $table->year('lakut_year')->nullable();
            $table->year('latinpel_year')->nullable();
            $table->json('nonformal_cadre');
            $table->enum('membership_status', ['Anggota PAC', 'Anggota PC'])->default('Anggota PAC');
            $table->string('photo')->default('default.png');
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
        Schema::dropIfExists('members');
    }
};

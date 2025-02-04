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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender')->nullable();
            $table->string('nim')->unique();
            $table->string('img')->default('users.png');
            $table->string('province_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('district_id')->nullable();
            $table->string('village_id')->nullable();
            $table
                ->string('address')
                ->nullable()
                ->dafault('pc ippnu banyumas pride');
            $table->string('boarding_school')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('date_of_birth', 20)->nullable();
            $table->string('hobby')->nullable();
            $table->string('highschool', 100)->nullable();
            $table->string('grad_year', 10)->nullable();
            $table->string('bachelor_year', 10)->nullable();
            $table->string('telephone')->nullable();
            $table->string('twitter')->nullable();
            $table->string('fb')->nullable();
            $table->string('ig')->nullable();
            $table->string('bio')->default('tangan terkepan dan maju kemuka!!!');
            $table
                ->string('username')
                ->nullable()
                ->unique();
            $table->string('slug')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('check', 2)->default('0');
            $table->string('pac_id');
            $table->string('cadre_level')->default('Belum Makesta');
            $table->string('makesta_year', 50)->nullable();
            $table->string('lakmud_year', 50)->nullable();
            $table->string('lakut_year', 50)->nullable();
            $table->string('latinpel_year', 50)->nullable();
            $table->string('informal', 100)->nullable();
            $table->string('nonformal', 100)->nullable();
            $table
                ->foreignId('role_id')
                ->default(4)
                ->constrained()
                ->onDelete('cascade');
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

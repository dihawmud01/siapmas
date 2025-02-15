<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('nim')->unique();
            $table->string('img')->default('users.png');
            $table->string('province_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('district_id')->nullable();
            $table->string('village_id')->nullable();
            $table
                ->string('address')
                ->nullable()
                ->default('pc ippnu banyumas pride');
            $table->string('boarding_school')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('highschool', 100)->nullable();
            $table->year('grad_year')->nullable();
            $table->year('bachelor_year')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('bio')->default('tangan terkepan dan maju kemuka!!!');
            $table->string('username')->unique();
            $table->string('slug')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('check')->default(false);
            $table->string('cadre_level')->default('Belum Makesta');
            $table->year('makesta_year')->nullable();
            $table->year('lakmud_year')->nullable();
            $table->year('lakut_year')->nullable();
            $table->year('latinpel_year')->nullable();
            $table->string('informal', 100)->nullable();
            $table->string('nonformal', 100)->nullable();
            $table
                ->foreignId('role_id')
                ->default(4)
                ->constrained()
                ->onDelete('cascade');
            $table
                ->foreignId('pac_id')
                ->constrained('pac')
                ->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

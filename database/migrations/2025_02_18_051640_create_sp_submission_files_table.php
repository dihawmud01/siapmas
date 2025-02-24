<?php

use App\Enums\FileCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('submission_files', function (Blueprint $table) {
            $table->id();
            $table->enum('category', FileCategory::getAll());
            $table->string('attachment', 255);

            $table->uuid('letter_of_validation_id');
            $table
                ->foreign('letter_of_validation_id')
                ->references('id')
                ->on('letter_of_validations')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_files');
    }
};

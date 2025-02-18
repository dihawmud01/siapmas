<?php

use App\Enums\SubmissionStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('submission_requests', function (Blueprint $table) {
            $table->id();
            $table->date('event_date');
            $table->string('event_location', 255);
            $table->string('mwc_letter_number', 100);
            $table->json('protectors');
            $table->json('advisors');
            $table->string('chairman', 100);
            $table->json('vice_chairman');
            $table->string('secretary', 100);
            $table->json('vice_secretaries');
            $table->string('treasurer', 100);
            $table->json('vice_treasurers');
            $table->json('organization_department');
            $table->json('cadre_department');
            $table->json('dakwah_department');
            $table->json('culture_department');
            $table->json('economy_institution');
            $table->json('press_institution');
            $table->json('brigade_institution');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_requests');
    }
};

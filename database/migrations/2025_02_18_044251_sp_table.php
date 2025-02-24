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
        Schema::create('letter_of_validations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('letter_number', 100);
            $table->date('event_date');
            $table->string('event_location', 255);
            $table->string('mwc_letter_number', 100);
            $table->json('protectors');
            $table->json('advisors');
            $table->string('chairman', 100);
            $table->json('vice_chairmen');
            $table->string('secretary', 100);
            $table->json('vice_secretaries');
            $table->string('treasurer', 100);
            $table->json('vice_treasurers');
            $table->string('organization_department_coordinator', 100);
            $table->json('organization_department_members');
            $table->string('cadre_department_coordinator', 100);
            $table->json('cadre_department_members');
            $table->string('dakwah_department_coordinator', 100);
            $table->json('dakwah_department_members');
            $table->string('culture_department_coordinator', 100);
            $table->json('culture_department_members');
            $table->string('economy_institution_director', 100);
            $table->json('economy_institution_members');
            $table->string('press_institution_director', 100);
            $table->json('press_institution_members');
            $table->string('brigade_institution_director', 100);
            $table->json('brigade_institution_members');
            $table->enum('status', SubmissionStatus::getAll())->default('pending');

            $table
                ->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
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

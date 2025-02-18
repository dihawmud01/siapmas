<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\SubmissionStatus;

class SubmissionRequest extends Model
{
    protected $table = 'submission_requests';

    protected $fillable = [
        'sender_pac',
        'event_date',
        'event_location',
        'status',
        'mwc_letter_number',
        'protectors',
        'advisors',
        'chairman',
        'vice_chairmen',
        'secretary',
        'vice_secretaries',
        'treasurer',
        'vice_treasurers',
        'department_organization',
        'department_cadre',
        'department_dakwah',
        'department_culture',
        'institution_economy',
        'institution_press',
        'institution_brigade',
    ];

    protected $casts = [
        'status' => SubmissionStatus::class,
        'protectors' => 'array',
        'advisors' => 'array',
        'vice_chairmen' => 'array',
        'vice_secretaries' => 'array',
        'vice_treasurers' => 'array',
        'organization_department' => 'array',
        'cadre_department' => 'array',
        'dakwah_department' => 'array',
        'culture_department' => 'array',
        'economy_institution' => 'array',
        'press_institution' => 'array',
        'brigade_institution' => 'array',
    ];
}

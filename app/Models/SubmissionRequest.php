<?php

namespace App\Models;

use App\Enums\SubmissionStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class SubmissionRequest extends Model
{
    use HasFactory;

    protected $table = 'submission_requests';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (! $model->id) {
                $model->id = preg_replace('/[^0-9]/', '', md5(Str::uuid()->toString()));
            }
        });
    }

    protected $fillable = [
        'user_id',
        'event_date',
        'event_location',
        'mwc_letter_number',
        'protectors',
        'advisors',
        'chairman',
        'vice_chairmen',
        'secretary',
        'vice_secretaries',
        'treasurer',
        'vice_treasurers',
        'organization_department_coordinator',
        'organization_department_members',
        'cadre_department_coordinator',
        'cadre_department_members',
        'dakwah_department_coordinator',
        'dakwah_department_members',
        'culture_department_coordinator',
        'culture_department_members',
        'economy_institution_director',
        'economy_institution_members',
        'press_institution_director',
        'press_institution_members',
        'brigade_institution_director',
        'brigade_institution_members',
    ];

    protected $casts = [
        'status' => SubmissionStatus::class,
        'protectors' => 'array',
        'advisors' => 'array',
        'vice_chairmen' => 'array',
        'vice_secretaries' => 'array',
        'vice_treasurers' => 'array',
        'organization_department_members' => 'array',
        'cadre_department_members' => 'array',
        'dakwah_department_members' => 'array',
        'culture_department_members' => 'array',
        'economy_institution_members' => 'array',
        'press_institution_members' => 'array',
        'brigade_institution_members' => 'array',
        'created_at' => 'datetime',
    ];

    protected $appends = ['formatted_submission_date'];

    public function getFormattedSubmissionDateAttribute(): string
    {
        Carbon::setLocale('id');

        return Carbon::parse($this->created_at)->isoFormat('dddd, D MMMM YYYY');
    }

    public function getFormattedEventDateAttribute(): string
    {
        Carbon::setLocale('id');

        return Carbon::parse($this->event_date)->isoFormat('dddd, D MMMM YYYY');
    }

    public function files(): HasMany
    {
        return $this->hasMany(SubmissionFile::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

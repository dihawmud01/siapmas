<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';
    protected $guarded = [];

    protected $fillable = [
        'name',
        'address',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'is_makesta',
        'is_lakmud',
        'is_lakut',
        'makesta_year',
        'lakmud_year',
        'lakut_year',
        'is_diklatama',
        'is_diklatnas',
        'is_diklatmad',
        'is_latinpel',
        'phone',
        'photo',
        'pac_id',
    ];

    protected $casts = [
        'non_formal_cadre_levels' => 'array',
        'is_makesta' => 'boolean',
        'is_lakmud' => 'boolean',
        'is_lakut' => 'boolean',
        'is_diklatama' => 'boolean',
        'is_diklatnas' => 'boolean',
        'is_diklatmad' => 'boolean',
        'is_latinpel' => 'boolean',
    ];

    public function getFormattedDateOfBirthAttribute(): string
    {
        Carbon::setLocale('id');

        return Carbon::parse($this->date_of_birth)->isoFormat('D MMMM YYYY');
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        });
    }

    public function pac(): BelongsTo
    {
        return $this->belongsTo(PAC::class);
    }
}

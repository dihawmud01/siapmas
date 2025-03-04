<?php

namespace App\Models;

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
        'phone',
        'highschool',
        'grad_year',
        'boarding_school',
        'college_year',
        'organizer_makesta',
        'makesta_year',
        'lakmud_year',
        'lakut_year',
        'latinpel_year',
        'informal',
        'organizer_informal',
        'nonformal',
        'organizer_nonformal',
        'img',
        'pac_id',
        'cadre_levels',
    ];

    protected $casts = ['cadre_levels' => 'array'];

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

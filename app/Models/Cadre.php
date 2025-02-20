<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cadre extends Model
{
    use HasFactory;
    protected $table = 'cadres';
    protected $guarded = [];

    protected $fillable = [
        'name',
        'address',
        'nim',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'telephone',
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
        'cadre_level',
    ];

    //    public function user(): BelongsTo
    //    {
    //        return $this->belongsTo(User::class);
    //    }
}

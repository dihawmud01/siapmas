<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cadre extends Model
{
    use HasFactory;
    protected $table = 'Cadre';
    // fungsi protected guarded untuk meng fillabel semuanya
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

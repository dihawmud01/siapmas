<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PAC extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'pac';
    protected $fillable = ['pac', 'slug'];

    // Define the accessor for the slug
    public function getSlugAttribute()
    {
        return Str::slug($this->pac);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'pac_id', 'id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'pac'
            ]
        ];
    }
}

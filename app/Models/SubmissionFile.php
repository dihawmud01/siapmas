<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\FileCategory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubmissionFile extends Model
{
    protected $fillable = ['file_type', 'file_category', 'file_path', 'file_size', 'submission_id'];

    protected $casts = [
        'file_category' => FileCategory::class,
    ];

    public function submission(): BelongsTo
    {
        return $this->belongsTo(SubmissionRequest::class);
    }
}

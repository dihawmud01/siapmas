<?php

namespace App\Models;

use App\Http\Controllers\LetterOfValidationController;
use Illuminate\Database\Eloquent\Model;
use App\Enums\FileCategory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubmissionFile extends Model
{
    protected $fillable = ['type', 'category', 'attachment', 'submission_id'];

    protected $casts = [
        'category' => FileCategory::class,
    ];

    public function submission(): BelongsTo
    {
        return $this->belongsTo(LetterOfValidationController::class);
    }
}

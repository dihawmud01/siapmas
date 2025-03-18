<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LetterOfValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'event_date' => 'required|date',
            'event_location' => 'required|string',
            'mwc_letter_number' => 'required|string',

            'documentations' => 'nullable|array',
            'documentations.*' => 'file|mimes:docx,jpg,jpeg,png,mp4|max:10240',

            'request_letter' => 'nullable|file|mimes:pdf|max:10240',
            'mwc_recommendation' => 'nullable|file|mimes:pdf|max:10240',
            'pac_recommendation' => 'nullable|file|mimes:pdf|max:10240',
            'election_report' => 'nullable|file|mimes:pdf|max:10240',
            'formation_report' => 'nullable|file|mimes:pdf|max:10240',
            'id_cv_photo_certificate' => 'nullable|file|mimes:pdf|max:10240',
            'management_structure' => 'nullable|file|mimes:docx|max:10240',
        ];
    }
}

<?php

namespace App\Enums;

enum FileCategory: string
{
    case DOCUMENTATION = 'documentation';
    case REQUEST_LETTER = 'request_letter';
    case MWC_RECOMMENDATION = 'mwc_recommendation';
    case PAC_RECOMMENDATION = 'pac_recommendation';
    case ELECTION_REPORT = 'election_report';
    case FORMATION_REPORT = 'formation_report';
    case MANAGEMENT_STRUCTURE = 'management_structure';
    case ID_CV_PHOTO_CERTIFICATE = 'id_cv_photo_certificate';

    // Helper untuk mendapatkan label yang lebih manusiawi
    public function label(): string
    {
        return match ($this) {
            self::DOCUMENTATION => 'Documentation of the Event',
            self::REQUEST_LETTER => 'Request Letter for Validation',
            self::MWC_RECOMMENDATION => 'MWC Recommendation Letter',
            self::PAC_RECOMMENDATION => 'PAC Recommendation Letter',
            self::ELECTION_REPORT => 'Election Report',
            self::FORMATION_REPORT => 'Formation Report',
            self::MANAGEMENT_STRUCTURE => 'Complete Management Structure',
            self::ID_CV_PHOTO_CERTIFICATE => 'ID, CV, Photo, and Certificate',
        };
    }

    // Helper untuk mendapatkan daftar semua kategori
    public static function getAll(): array
    {
        return array_column(self::cases(), 'value');
    }
}

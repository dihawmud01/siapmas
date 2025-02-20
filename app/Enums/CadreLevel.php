<?php

namespace App\Enums;

enum CadreLevel: string
{
    case NON_MAKESTA = 'non_makesta';
    case MAKESTA = 'makesta';
    case LAKMUD = 'lakmud';
    case LAKUT = 'lakut';
    case LATINPEL = 'latinpel';

    public function label(): string
    {
        return match ($this) {
            self::NON_MAKESTA => 'Belum Makesta',
            self::MAKESTA => 'Makesta',
            self::LAKMUD => 'Lakmud',
            self::LAKUT => 'Lakut',
            self::LATINPEL => 'Latinpel',
        };
    }

    public static function getAll(): array
    {
        return array_column(self::cases(), 'value');
    }
}

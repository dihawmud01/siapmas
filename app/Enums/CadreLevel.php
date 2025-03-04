<?php

namespace App\Enums;

enum CadreLevel: string
{
    case MAKESTA = 'makesta';
    case LAKMUD = 'lakmud';
    case LAKUT = 'lakut';
    case LATINPEL = 'latinpel';

    public function label(): string
    {
        return match ($this) {
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

    public static function getLabels(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($cadreLevel) => [$cadreLevel->value => $cadreLevel->label()])
            ->toArray();
    }
}

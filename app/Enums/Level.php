<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Level extends Enum
{
    const MuyFacil = 1;
    const Facil = 2;
    const Normal = 3;
    const Dificil = 4;
    const MuyDificil = 5;

    public static function getName($level)
    {
        switch ($level) {
            case Level::MuyFacil:
                return 'Muy Fácil';
                break;
            case Level::Facil:
                return 'Fácil';
                break;
            case Level::Normal:
                return 'Normal';
                break;
            case Level::Dificil:
                return 'Difícil';
                break;
            case Level::MuyDificil:
                return 'Muy Difícil';
                break;
            default:
                return '-';
                break;
        }
    }

    public static function getOptions()
    {
        return [
            Level::MuyFacil => Level::getName(Level::MuyFacil),
            Level::Facil => Level::getName(Level::Facil),
            Level::Normal => Level::getName(Level::Normal),
            Level::Dificil => Level::getName(Level::Dificil),
            Level::MuyDificil => Level::getName(Level::MuyDificil),
        ];
    }
}

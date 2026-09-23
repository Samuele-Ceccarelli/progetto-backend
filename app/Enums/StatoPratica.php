<?php

namespace App\Enums;

enum StatoPratica: string
{
    case NUOVA = 'Nuova';
    case IN_LAVORAZIONE = 'In lavorazione';
    case CHIUSA = 'Chiusa';

    // Metodo helper utile per estrarre facilmente solo i valori (stringhe)
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
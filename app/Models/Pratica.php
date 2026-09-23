<?php

namespace App\Models;

use Database\Factories\PraticaFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use App\Enums\StatoPratica;

#[UseFactory(PraticaFactory::class)]
#[Table('pratiche', key: 'id_pratica')]
#[Fillable(['id_cliente', 'importo', 'descrizione', 'stato'])]

class Pratica extends Model
{
    use HasFactory;
    
    public const CREATED_AT = 'data_apertura';

    protected $casts = [
        'stato' => StatoPratica::class,
    ];
    
    protected $attributes = [
        'importo' => 0,
        'stato' => StatoPratica::NUOVA->value,
    ];

    public function clienti(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}
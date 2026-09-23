<?php

namespace App\Models;

use Database\Factories\ClienteFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\UseFactory;

#[UseFactory(ClienteFactory::class)]
#[Table('clienti', key: 'id_cliente')]
#[Fillable(['nome', 'cognome', 'email'])]

class Cliente extends Model
{
    use HasFactory;

    protected $attributes = [
        'nome' => '',
        'cognome' => '',
        'email' => '',
    ];

    // Per la relazione (1,N)
    public function pratiche(): HasMany
    {
        return $this->hasMany(Pratica::class, 'id_cliente');
    }
}
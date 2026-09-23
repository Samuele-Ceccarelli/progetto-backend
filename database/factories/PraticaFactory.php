<?php

namespace Database\Factories;

use App\Enums\StatoPratica;
use App\Models\Cliente;
use App\Models\Pratica;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pratica>
 */
class PraticaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_cliente' => Cliente::factory(), 
            'importo' => fake()->randomFloat(2, 1000, 10e6),
            'descrizione' => fake()->sentence(),
            'data_apertura' => fake()->date('Y-m-d', now()),
            'stato' => fake()->randomElement(StatoPratica::cases()),
        ];
    }
}

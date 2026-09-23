<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pratica;

class PraticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pratica::factory()
        ->count(10)
        ->create();
    }
}

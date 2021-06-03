<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jugada;

class JugadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jugada::create(['nombre' => 'Pleno']);
        Jugada::create(['nombre' => 'Par']);
        Jugada::create(['nombre' => 'Impar']);
        Jugada::create(['nombre' => 'Negro']);
        Jugada::create(['nombre' => 'Rojo']);
    }
}

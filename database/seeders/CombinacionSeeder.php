<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Combinacion;

class CombinacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Combinacion::create([
            'nombre' => 'Pleno', 
            'tipo' => 'Jugada Multiple',
            'pago' => '35',
        ]);
        Combinacion::create([
            'nombre' => 'Rojo', 
            'tipo' => 'Jugada Simple',
            'pago' => '1',
        ]);
        Combinacion::create([
            'nombre' => 'Negro', 
            'tipo' => 'Jugada Simple',
            'pago' => '1',
        ]);
        Combinacion::create([
            'nombre' => 'Par', 
            'tipo' => 'Jugada Simple',
            'pago' => '1',
        ]);
        Combinacion::create([
            'nombre' => 'Impar', 
            'tipo' => 'Jugada Simple',
            'pago' => '1',
        ]);
    }
}

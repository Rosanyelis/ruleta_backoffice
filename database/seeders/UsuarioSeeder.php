<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
            'nombre' => 'Rosanyelis Mendoza', 
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'rol' => 'Desarrollador',
        ]);

        \App\Models\Usuario::factory(10)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\MoldeHora;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UsuarioSeeder::class,
            PersonaSeeder::class,
            ResponsableSeeder::class,
            ClienteSeeder::class,
            HoraSeeder::class,
            JugadaSeeder::class,
            MoldeHorariosSeeder::class,
        ]);
    }
}

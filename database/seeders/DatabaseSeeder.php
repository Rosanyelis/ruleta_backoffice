<?php

namespace Database\Seeders;

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
            TaquillaSeeder::class,
            CombinacionSeeder::class,
            TicketSeeder::class,
            DetallesTicketSeeder::class,
            BalanceSeeder::class,
        ]);
    }
}

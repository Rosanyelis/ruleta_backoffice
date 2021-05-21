<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaquillaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Taquilla::factory(10)->create();
    }
}

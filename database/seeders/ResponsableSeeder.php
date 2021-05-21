<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ResponsableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Responsable::factory(10)->create();
    }
}

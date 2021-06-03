<?php

namespace Database\Factories;

use App\Models\Taquilla;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class TaquillaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Taquilla::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $responsables = DB::table('responsables')->inRandomOrder()->first();
        $personas = DB::table('personas')->inRandomOrder()->first();
        return [
            'responsable_id' => $responsables->id,
            'persona_id' => $personas->id,
            'codigo' => $this->faker->uuid(),
            'direccion' => $this->faker->address(),
            'direccion_mac' => $this->faker->macAddress(),
        ];
    }
}

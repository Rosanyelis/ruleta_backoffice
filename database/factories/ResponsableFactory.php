<?php

namespace Database\Factories;

use App\Models\Responsable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ResponsableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Responsable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $personas = DB::table('personas')->inRandomOrder()->first();
        return [
            'persona_id' => $personas->id,
            'rif' => $this->faker->uuid(),
            'direccion' => $this->faker->address(),

        ];
    }
}

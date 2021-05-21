<?php

namespace Database\Factories;

use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class PersonaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Persona::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $usuarios = DB::table('usuarios')->inRandomOrder()->first();
        return [
            'usuario_id' => $usuarios->id,
            'nombre' => $this->faker->name(),
            'apellido' => $this->faker->lastName(),
            'sexo' => $this->faker->randomElement(['Femenino', 'Masculino']),
            

        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $usuarios = DB::table('usuarios')->inRandomOrder()->first();
        $responsables = DB::table('responsables')->inRandomOrder()->first();
        $personas = DB::table('personas')->inRandomOrder()->first();
        return [
            'usuario_id' => $usuarios->id,
            'responsable_id' => $responsables->id,
            'persona_id' => $personas->id,
            'sector' => $this->faker->word(),
            'direccion' => $this->faker->address(),
        ];
    }
}

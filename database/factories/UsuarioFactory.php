<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsuarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Usuario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $responsables = DB::table('responsables')->inRandomOrder()->first();
        $clientes = DB::table('clientes')->inRandomOrder()->first();
        $taquillas = DB::table('taquillas')->inRandomOrder()->first();
        return [
            'responsable_id' => $responsables->id,
            'cliente_id' => $clientes->id,
            'taquilla_id' => $taquillas->id,
            'nombre' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'rol' => $this->faker->randomElement(['Administrador', 'Responsable', 'Taquillero', 'Cliente']),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'direccion_mac' => $this->faker->macAddress(),
            'estatus' => true,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}

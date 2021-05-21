<?php

namespace Database\Factories;

use App\Models\Balance;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class BalanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Balance::class;

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
        $tickets = DB::table('tickets')->inRandomOrder()->first();

        return [
            'responsable_id' => $responsables->id,
            'cliente_id' => $clientes->id,
            'taquilla_id' => $taquillas->id,
            'ticket_id' => $tickets->id,
            'fecha_hora' => Carbon::now(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $taquillas = DB::table('taquillas')->inRandomOrder()->first();
        return [
            'taquilla_id' => $taquillas->id,
            'fecha_hora' => Carbon::now(),
            'estatus' => $this->faker->randomElement(['Por Pagar', 'Pagado', 'Anulado']),
        ];
    }
}

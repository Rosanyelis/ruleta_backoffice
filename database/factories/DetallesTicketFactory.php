<?php

namespace Database\Factories;

use App\Models\DetallesTicket;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class DetallesTicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetallesTicket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tickets = DB::table('tickets')->inRandomOrder()->first();
        $combinaciones = DB::table('combinaciones')->inRandomOrder()->first();
        return [
            'ticket_id' => $tickets->id,
            'combinacion_id' => $combinaciones->id,
            'monto_jugado' => $this->faker->randomFloat(),
            'monto_pagado' => $this->faker->randomFloat(),
        ];
    }
}

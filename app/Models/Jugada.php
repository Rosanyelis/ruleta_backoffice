<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class Jugada extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'jugadas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];

    /**
     * Las jugadas son de muchas plantillas de jugadas.
     */
    public function plantillajugadas()
    {
        return $this->hasMany(PlantillaJugadaJugada::class, 'jugada_id', 'id');
    }

    /**
     * Las jugadas tienen muchos detalles de tickets.
     */
    public function detalleticketjugadas()
    {
        return $this->hasMany(DetalleTicket::class, 'jugada_id', 'id');
    }
}

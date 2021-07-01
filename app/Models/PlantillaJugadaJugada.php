<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class PlantillaJugadaJugada extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'plantilla_jugadas_jugadas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'plantilla_jugada_id',
        'jugada_id',
    ];

    /**
     * Muchas jugadas pertenecen a una jugada.
     */
    public function jugada() 
    {
        return $this->belongsTo(Jugada::class, 'jugada_id', 'id');
    }

    /**
     * Muchas plantillas jugadas pertenecen a una plantilla jugada
     */
    public function plantillajugada() 
    {
        return $this->belongsTo(PlantillaJugadas::class, 'plantilla_jugada_id', 'id');
    }
}

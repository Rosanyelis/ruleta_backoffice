<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class PlantillaJugada extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'plantilla_jugadas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];

    /**
     * La plantilla tienen muchas jugadas
     */
    public function plantillajugadajugadas()
    {
        return $this->hasMany(PlantillaJugadaJugada::class, 'plantilla_jugada_id', 'id');
    }

    /**
     * la plantilla tienen muchos responsables
     */
    public function plantillaresponsable()
    {
        return $this->hasMany(PlantillaResponsable::class, 'plantilla_jugada_id', 'id');
    }

    /**
     * la plantilla tienen muchos clientes asignados por el responsable
     */
    public function plantillacliente()
    {
        return $this->hasMany(PlantillaClientes::class, 'plantilla_jugada_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class PlantillaHorario extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'plantilla_horarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];

    /**
     * La plantilla tienen muchas horas
     */
    public function plantillahorarioshoras()
    {
        return $this->hasMany(PlantillaHorarioHora::class, 'plantilla_horario_id', 'id');
    }

    /**
     * la plantilla tienen muchos responsables
     */
    public function plantillaresponsable()
    {
        return $this->hasMany(PlantillaResponsable::class, 'plantilla_horario_id', 'id');
    }

    /**
     * la plantilla tienen muchos clientes
     */
    public function plantillacliente()
    {
        return $this->hasMany(PlantillaClientes::class, 'plantilla_horario_id', 'id');
    }
}

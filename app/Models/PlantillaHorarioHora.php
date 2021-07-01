<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class PlantillaHorarioHora extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'plantilla_horarios_hora';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'plantilla_horario_id',
        'hora_id',
    ];

    /**
     * Muchas horas pertenecen a una hora.
     */
    public function hora() 
    {
        return $this->belongsTo(Hora::class, 'hora_id', 'id');
    }

    /**
     * Muchas plantillas horarios pertenecen a una plantilla horario
     */
    public function plantillahorario() 
    {
        return $this->belongsTo(PlantillaHorario::class, 'plantilla_horario_id', 'id');
    }
}

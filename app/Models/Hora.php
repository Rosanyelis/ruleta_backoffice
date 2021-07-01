<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class Hora extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'horas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hora',
    ];

    /**
     * La hora está en muchas plantillas de horarios.
     */
    public function plantillahoras()
    {
        return $this->hasMany(PlantillaHorarioHora::class, 'hora_id', 'id');
    }

    /**
     * Las horas tienen muchos detalles de tickets.
     */
    public function detalletickethoras()
    {
        return $this->hasMany(DetalleTicket::class, 'hora_id', 'id');
    }
}

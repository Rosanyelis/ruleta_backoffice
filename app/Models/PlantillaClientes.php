<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class PlantillaClientes extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'plantilla_cliente';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cliente_id',
        'plantilla_ruleta_id',
        'plantilla_jugada_id',
        'plantilla_horario_id',
    ];

    /**
     * las plantillas pertenecen a un responsable asignado a un cliente.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    /**
     * las plantillas ruletas pertenecen a una plantilla ruleta.
     */
    public function plantillaruleta()
    {
        return $this->belongsTo(PlantillaRuleta::class, 'plantilla_ruleta_id', 'id');
    }

    /**
     * las plantillas jugadas pertenecen a una plantilla jugada.
     */
    public function plantillajugada()
    {
        return $this->belongsTo(PlantillaJugada::class, 'plantilla_jugada_id', 'id');
    }

    /**
     * las plantillas horarios pertenecen a una plantilla horarios.
     */
    public function plantillahorario()
    {
        return $this->belongsTo(PlantillaHorario::class, 'plantilla_horario_id', 'id');
    }

}

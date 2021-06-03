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
     * Los moldes pertenecen a una hora.
     */
    public function moldehorarios()
    {
        return $this->belongsToMany(MoldeHorarios::class, 'hora_molde_horario');
    }
}

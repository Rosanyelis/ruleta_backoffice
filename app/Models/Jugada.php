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
     * Los moldes pertenecen a una hora.
     */
    public function moldejugadas()
    {
        return $this->belongsToMany(MoldeHorarios::class, 'hora_molde_horario');
    }
}

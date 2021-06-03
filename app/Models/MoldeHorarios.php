<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class MoldeHorarios extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'molde_horarios';

    /**
     * Las horas que pertenecen a una plantilla
     */
    public function horas()
    {
        return $this->belongsToMany(Hora::class, 'hora_molde_hora');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class MoldeJugadas extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'molde_jugadas';

    /**
     * Las jugadas que pertenecen a una plantilla
     */
    public function jugadas()
    {
        return $this->belongsToMany(Jugada::class, 'jugada_molde_jugada');
    }
}

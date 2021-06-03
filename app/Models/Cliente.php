<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class Cliente extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'clientes';

    /**
     * Cliente pertenece a una persona.
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }

    /**
     * Cliente tiene un usuario.
     */
    public function usuario()
    {
        return $this->hasOne(Usuario::class);
    }

    /**
     * Cliente pertenece a una persona.
     */
    public function responsable()
    {
        return $this->belongsTo(Responsable::class, 'responsable_id', 'id');
    }
}

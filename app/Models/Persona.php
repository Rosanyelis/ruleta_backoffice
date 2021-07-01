<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class Persona extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'personas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id',
        'nombre',
        'apellido',
        'sexo',
    ];

    /**
     * Persona es un responsable.
     */
    public function responsables()
    {
        return $this->hasMany(Responsable::class, 'persona_id', 'id');
    }

    /**
     * Persona es un cliente.
     */
    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'persona_id', 'id');
    }

    /**
     * Persona es una taquilla.
     */
    public function taquillas()
    {
        return $this->hasMany(Taquilla::class, 'persona_id', 'id');
    }

}

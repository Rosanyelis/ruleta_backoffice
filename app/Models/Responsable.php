<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;


class Responsable extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'responsables';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rif',
        'direccion',
        'estatus',
    ];

    /**
     * Responsable pertenece a una persona.
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }

    /**
     * Responsable tiene un usuario.
     */
    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'responsable_id', 'id');
    }

    /**
     * Responsable tiene un usuario.
     */
    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'responsable_id', 'id');
    }

    /**
     * Responsable tiene muchas plantillas asignadas.
     */
    public function plantillas()
    {
        return $this->hasMany(PlantillaResponsable::class, 'responsable_id', 'id');
    }
}

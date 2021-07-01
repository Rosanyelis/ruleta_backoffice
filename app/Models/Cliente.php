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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'responsable_id',
        'persona_id',
        'sector',
        'direccion',
        'estatus',
    ];

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
        return $this->hasOne(Usuario::class, 'usuario_id', 'id');
    }

    /**
     * Cliente pertenece a una persona.
     */
    public function responsable()
    {
        return $this->belongsTo(Responsable::class, 'responsable_id', 'id');
    }
    
}

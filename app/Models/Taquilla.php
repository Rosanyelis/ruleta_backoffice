<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class Taquilla extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'taquillas';

    
    /**
     * Taquilla pertenece a una persona.
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    /**
     * Taquilla tiene un usuario.
     */
    public function usuario()
    {
        return $this->hasOne(Usuario::class);
    }
}

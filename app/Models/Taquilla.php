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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cliente_id',
        'persona_id',
        'codigo',
        'direccion',
        'telefono',
        'estatus',
    ];

    
    /**
     * Taquilla pertenece a una persona.
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }

    /**
     * Taquilla tiene un usuario.
     */
    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'usuario_id', 'id');
    }

    /**
     * Taquilla tiene muchos tickets.
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'taquilla_id', 'id');
    }

    /**
     * Taquilla tiene muchos tickets anulados.
     */
    public function ticket_anulados()
    {
        return $this->hasMany(TicketAnulado::class, 'taquilla_id', 'id');
    }

    /**
     * Taquilla tiene muchos tickets pagados.
     */
    public function ticket_pagados()
    {
        return $this->hasMany(TicketPagado::class, 'taquilla_id', 'id');
    }
}

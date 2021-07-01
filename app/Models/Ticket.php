<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class Ticket extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'tickets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'cliente_id',
        'taquilla_id',
        'fecha',
        'monto',
        'estatus',
        'fecha_vencimiento',
    ];

    /**
     * Muchos Clientes tienen tickets en su balance.
     */
    public function cliente() 
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    /**
     * Muchos tickets pertenecen a una taquilla.
     */
    public function taquilla() 
    {
        return $this->belongsTo(Taquilla::class, 'taquilla_id', 'id');
    }

    /**
     * un ticket tiene muchos detalles de ticket.
     */
    public function detalletickets() 
    {
        return $this->hasMany(DetalleTicket::class, 'ticket_id', 'id');
    }
}

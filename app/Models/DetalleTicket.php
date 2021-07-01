<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class DetalleTicket extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'detalle_tickets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'ticket_id',
        'ruleta_id',
        'hora_id',
        'jugada_id',
        'estatus',
        'monto_jugado',
        'monto_pagar',
    ];

    /**
     * Un detalle de ticket pertenece a un ticket.
     */
    public function ticket() 
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    /**
     * Un detalle ruleta pertenece a una ruleta.
     */
    public function ruleta() 
    {
        return $this->belongsTo(Ruleta::class, 'ruleta_id', 'id');
    }

    /**
     * Un detalle hora pertenece a una hora.
     */
    public function hora() 
    {
        return $this->belongsTo(Hora::class, 'hora_id', 'id');
    }

    /**
     * Un detalle jugada pertenece a una jugada.
     */
    public function jugada() 
    {
        return $this->belongsTo(Jugada::class, 'jugada_id', 'id');
    }
}

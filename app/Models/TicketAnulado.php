<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class TicketAnulado extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'ticket_anulados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'ticket_id',
        'taquilla_id',
        'fecha',
        'motivo',
        'estatus',
    ];

    /**
     * Un ticket anulado pertenece a un ticket.
     */
    public function ticket() 
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    /**
     * Muchos tickets anulados pertenecen a una taquilla.
     */
    public function taquilla() 
    {
        return $this->belongsTo(Taquilla::class, 'taquilla_id', 'id');
    }
}

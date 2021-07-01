<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class Ruleta extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'ruletas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];

    /**
     * Las ruletas son de muchas plantillas
     */
    public function plantillaruletas()
    {
        return $this->hasMany(PlantillaRuletaRuleta::class, 'ruleta_id', 'id');
    }

    /**
     * Las ruletas tienen muchos detalles de tickets.
     */
    public function detalleticketruletas()
    {
        return $this->hasMany(DetalleTicket::class, 'ruleta_id', 'id');
    }
}

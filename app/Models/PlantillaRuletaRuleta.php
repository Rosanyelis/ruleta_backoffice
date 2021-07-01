<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class PlantillaRuletaRuleta extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'plantilla_ruletas_ruletas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'plantilla_ruleta_id',
        'ruleta_id',
    ];

    /**
     * Muchas ruletas pertenecen a una ruleta.
     */
    public function ruleta() 
    {
        return $this->belongsTo(Ruleta::class, 'ruleta_id', 'id');
    }

    /**
     * Muchas plantillas pertenecen a una plantilla.
     */
    public function plantillaruleta() 
    {
        return $this->belongsTo(PlantillaRuleta::class, 'plantilla_ruleta_id', 'id');
    }
}

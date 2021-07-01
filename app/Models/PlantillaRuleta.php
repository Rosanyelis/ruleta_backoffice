<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class PlantillaRuleta extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'plantilla_ruletas';

    /**
     * la plantilla tienen muchas ruletas
     */
    public function plantillaruletasruletas()
    {
        return $this->hasMany(PlantillaRuletaRuleta::class, 'plantilla_ruleta_id', 'id');
    }

    /**
     * la plantilla tienen muchos responsables
     */
    public function plantillaresponsable()
    {
        return $this->hasMany(PlantillaResponsable::class, 'plantilla_ruleta_id', 'id');
    }

    /**
     * la plantilla tienen muchos responsables asignado a un cliente
     */
    public function plantillacliente()
    {
        return $this->hasMany(PlantillaClientes::class, 'plantilla_ruleta_id', 'id');
    }
}

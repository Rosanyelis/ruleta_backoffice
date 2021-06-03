<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class MoldeRuletas extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'molde_ruletas';

    /**
     * Las ruletas que pertenecen a una plantilla
     */
    public function ruletas()
    {
        return $this->belongsToMany(Ruleta::class, 'molde_ruleta_ruleta');
    }
}

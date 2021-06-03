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
     * Los moldes pertenecen a una hora.
     */
    public function molderuletas()
    {
        return $this->belongsToMany(MoldeRuletas::class, 'molde_ruleta_ruleta');
    }
}

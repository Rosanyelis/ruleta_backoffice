<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;


class Responsable extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'responsables';
}

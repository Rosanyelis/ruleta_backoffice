<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoGenerateUuid;

class Cliente extends Model
{
    use HasFactory, AutoGenerateUuid;

    protected $table = 'clientes';
}
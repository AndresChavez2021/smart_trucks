<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoRecorrido extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_empleado',
        'id_camion',
    ];
}

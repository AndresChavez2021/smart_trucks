<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recorrido extends Model
{
    use HasFactory;

    protected $fillable = [
        'fechaHora',
        'horaIni',
        'horaFin',
        'coordenadas',
        'id_equipoRecorrido',
        'id_ruta',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    use HasFactory;

    protected $fillable = [
        'fechaHora',
        'cantidad',
        'observacion',
        'id_basura',
        'id_recorrido',
    ];
}

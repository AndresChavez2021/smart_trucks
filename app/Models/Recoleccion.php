<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recoleccion extends Model
{
    use HasFactory;
    protected $fillable = [
        'fechaHora',
        'peso',
        'id_categoria',
        'id_usuario',
    ];
}

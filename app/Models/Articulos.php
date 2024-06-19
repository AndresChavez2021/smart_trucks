<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'foto',
        'descripcion',
        'fecha_publicacion',
        'id_cliente',
    ];
}

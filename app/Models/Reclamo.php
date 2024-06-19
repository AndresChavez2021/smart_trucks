<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'fechaHora',
        'foto',
        'coordenada',
        'id_cliente',
        
    ];
}

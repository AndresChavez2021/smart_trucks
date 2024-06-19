<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class establecimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'id_ruta',
        'id_distrito',
        'id_red',
    ];
}

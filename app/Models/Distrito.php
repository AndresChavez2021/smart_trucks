<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'id_zona',
    ];

    public function barrios()
    {
        return $this->hasMany(Barrio::class, 'id_distrito','id');
    }

}

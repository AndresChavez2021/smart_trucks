<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'coordenada',
        'id_distrito',
    ];

    public function distrito()
    {
        return $this->hasOne(Distrito::class,'id','id_distrito');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $fillable = [
        'evento',
    ];

    use HasFactory;

    //Tiene un id
    public function eventos()
    {
        return $this->hasOne('App\Models\Evento', 'id', 'evento');
    }


    public function registros()
    {
        return $this->hasMany('App\Models\Registro', 'origen', 'id');
    }
}

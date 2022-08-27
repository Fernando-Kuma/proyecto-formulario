<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Formulario extends Model
{
    static $rules = [
        'evento' => 'required',
        'pregunta' => 'required',
        'respuesta' => 'required',
        'created_by' => 'required'
    ];

    protected $fillable = [
        'evento',
        'pregunta',
        'respuesta',
        'created_by'
    ];

    use HasFactory;

    //Tiene un id
    public function eventos()
    {
        return $this->hasOne('App\Models\Evento', 'id', 'evento');
    }
    public function respuestas()
    {
        return $this->hasOne('App\Models\Respuesta', 'id', 'respuesta');
    }
    public function users()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }
}

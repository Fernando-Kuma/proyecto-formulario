<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Contenido extends Model
{
    static $rules = [
        'correo' => 'required',
		'img_fondo' => 'required',
        'img_logo' => 'required',
        'mostrar_correo' => 'required',
        'texto_inicial' => 'required',
        'texto_final' => 'required',
        'texto_correo' => 'required',
        'color_fondo' => 'required',
        'color_texto' => 'required',
        'created_by' => 'required'
    ];

    protected $fillable = [
        'correo',
        'img_fondo',
        'img_logo',
        'mostrar_correo',
        'texto_inicial',
        'texto_final',
        'texto_correo',
        'color_fondo',
        'color_texto',
        'evento',
        'created_by',
    ];

    use HasFactory;

    //Tiene un id
    public function users()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }
    public function eventos()
    {
        return $this->hasOne('App\Models\Evento', 'id', 'evento');
    }
}

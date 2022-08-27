<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    static $rules = [
		'nombre' => 'required',
        'empresa' => 'required',
        'created_by' => 'required',
    ];

    protected $fillable = [
        'nombre',
        'empresa',
        'created_by',
    ];

    //Tiene muchos id
    public function formularios()
    {
        return $this->hasMany('App\Models\Formulario', 'evento', 'id');
    }
    public function contenidos()
    {
        return $this->hasMany('App\Models\Contenido', 'evento', 'id');
    }
    public function solicituds()
    {
        return $this->hasMany('App\Models\Solicitud', 'evento', 'id');
    }
    public function registros()
    {
        return $this->hasManyThrough(
            'App\Models\Registro', 
            'App\Models\Solicitud',
            'evento',
            'origen',
            'id',
            'id'
        );
    }




    public function users()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

}

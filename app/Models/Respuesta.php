<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Respuesta extends Model
{
    static $rules = [
		'nombre' => 'required',
        'created_by' => 'required'
    ];

    protected $fillable = [
        'nombre',
        'tipo',
        'created_by'
    ];

    use HasFactory;

    //Tiene un id
    public function users()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    //Tiene muchos id
    public function formularios()
    {
        return $this->hasMany('App\Models\Formulario', 'respuesta', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    static $rules = [
		'nombre' => 'required',
    ];

    protected $fillable = [
        'nombre',
    ];

    use HasFactory;

    //Tiene muchos id
    public function users()
    {
        return $this->hasMany('App\Models\User', 'rol_id', 'id');
    }
    public function accesos()
    {
        return $this->hasMany('App\Models\Acceso', 'rol', 'id');
    }
}

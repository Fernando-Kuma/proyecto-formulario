<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Menu extends Model
{
    static $rules = [
		'nombre' => 'required',
        'estatus' => 'required',
        'created_by' => 'required'
    ];

    protected $fillable = [
        'icono',
        'nombre',
        'estatus',
        'created_by'
    ];
    use HasFactory;
    
    //Tiene un id
    public function users()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    //Tiene muchos id
    public function accesos()
    {
        return $this->hasMany('App\Models\Acceso', 'menu', 'id');
    }
}

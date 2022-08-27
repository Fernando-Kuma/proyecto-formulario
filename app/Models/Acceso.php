<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Acceso extends Model
{

    static $rules = [
		'rol' => 'required',
        'menu' => 'required',
        'estatus' => 'required',
        'created_by' => 'required'
    ];

    protected $fillable = [
        'rol',
        'menu',
        'estatus',
        'created_by',
    ];
    use HasFactory;

    //Tiene un id
    public function rols()
    {
        return $this->hasOne('App\Models\Rol', 'id', 'rol');
    }
    public function menus()
    {
        return $this->hasOne('App\Models\Menu', 'id', 'menu');
    }
    public function users()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }
}

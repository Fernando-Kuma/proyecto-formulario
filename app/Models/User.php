<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surnames',
        'email',
        'password',
        'phone',
        'empresa',
        'rol_id',
        'created_by'
    ];
    
    static $rules = [
		    'name' => 'required|string|max:100',
            'surnames' => 'required|string|max:100',
            'password' => 'required|string|min:8|sometimes',
            'phone' => 'required|string|min:10',
            'email' => 'required|email|unique:users',
            'empresa' => 'required|unique:users',
            'rol_id' => 'required',
            'created_by' => 'required'
        ];

    static $mensaje = [
        'required'=>'El :attribute es requerido',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    //Tiene un id
    public function rols()
    {
        return $this->hasOne('App\Models\Rol', 'id', 'rol_id');
    }
    

    //Tiene muchos id
    public function menus()
    {
        return $this->hasMany('App\Models\Menu', 'created_by', 'id');
    }
    public function accesos()
    {
        return $this->hasMany('App\Models\Acceso', 'created_by', 'id');
    }
    public function respuestas()
    {
        return $this->hasMany('App\Models\Respuesta', 'created_by', 'id');
    }
    public function formularios()
    {
        return $this->hasMany('App\Models\Formulario', 'created_by', 'id');
    }
    public function correos()
    {
        return $this->hasMany('App\Models\Correo', 'created_by', 'id');
    }
    public function contenidos()
    {
        return $this->hasMany('App\Models\Contenido', 'created_by', 'id');
    }
    public function eventos()
    {
        return $this->hasMany('App\Models\Evento', 'created_by', 'id');
    }
}

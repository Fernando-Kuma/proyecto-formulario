<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Registro extends Model
{
    protected $fillable = [
        'titulo',
        'respuesta',
        'origen',
    ];

    use HasFactory;

    public function solicituds()
    {
        return $this->hasOne('App\Models\Solicitud', 'id', 'origen');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';
    protected $fillable = array(
        'apellido_paterno',
        'apellido_materno',
        'nombre',
        'celular',
        'estado_registro'
    );
    protected $primaryKey = 'id';
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
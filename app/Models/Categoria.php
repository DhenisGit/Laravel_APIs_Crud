<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $fillable = array(
        'descripcion',
        'estado_registro'
    );
    protected $primaryKey = 'id';
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
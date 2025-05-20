<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class genre extends Model
{
    //
    protected $table = 'genre';
    protected $primaryKey = 'genre_id'; // <-- Agrega esta línea
    public $incrementing = false; // Si tu clave primaria no es auto-incremental
    protected $keyType = 'int';   // Si tu clave primaria es un entero
}

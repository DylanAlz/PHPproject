<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    // Tabla asociada
    protected $table = 'document_type';

    // Clave primaria personalizada
    protected $primaryKey = 'type_doc_id';

    // Indica si la clave primaria es auto-incremental
    public $incrementing = false;

    // Campos asignables en masa
    protected $fillable = [
        'type',
    ];
}

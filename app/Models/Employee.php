<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // Tabla asociada
    protected $table = 'employee';

    // Clave primaria personalizada
    protected $primaryKey = 'Empleado_ID';

    // Campos asignables en masa
    protected $fillable = [
        'nombre',
        'fecha_ingreso',
        'salario',
        'tipo_doc_id',
        'cargo_id',
        'jefe_id',
        'activo',
        'bit_usuario',
    ];

    // Relación con el modelo DocumentType
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class, 'tipo_doc_id');
    }

    // Relación con el modelo Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'cargo_id');
    }

    // Relación con el modelo Employee (jefe)
    public function jefe()
    {
        return $this->belongsTo(Employee::class, 'jefe_id');
    }

    // Relación con los empleados subordinados
    public function subordinados()
    {
        return $this->hasMany(Employee::class, 'jefe_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'role_id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'role_id',
        'name',
        'description',
    ];
}

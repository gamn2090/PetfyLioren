<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compania extends Model
{
    protected $table = 'compania';
    protected $fillable = [
        'razonSocial', 'rut', 'giro', 'direccion', 'telefono', 'comuna_id', 'ciudad_id'
    ];
}

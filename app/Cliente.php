<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $fillable = [
        'rut', 'direccion', 'razonSocial', 'giro', 'email', 'comuna_id','ciudad_id', 'telefono'
    ];
}

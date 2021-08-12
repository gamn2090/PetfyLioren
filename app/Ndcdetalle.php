<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ndcdetalle extends Model
{
    protected $table = 'ndcdetalle';
    protected $fillable = [
        'codigoItem', 'nombreItem', 'cantidad', 'unidad', 'precio', 'folio'
    ];
}

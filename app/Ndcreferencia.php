<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ndcreferencia extends Model
{
    protected $table = 'ndcreferencia';
    protected $fillable = [
        'folio','tipoDocumentoRef', 'folioReferencia', 'fechaReferencia', 'glosa', 'razon'
    ];
}

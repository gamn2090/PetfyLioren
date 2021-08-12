<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ndc extends Model
{
    protected $table = 'ndc';
    protected $fillable = [
        'tipoDocumento', 'folio', 'fechaCreacion', 'pdf','xml','errors','estado', 'folioReferencia'
    ];
}

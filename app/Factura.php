<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas';
    protected $fillable = [
        'tipoDocumento', 'folio', 'fechaCreacion', 'pdf','xml','errors','estado', 'cliente_id', 'comuna_id', 'ciudad_id'
    ];

    public function GetTotal($id){
        $folio = $this->find($id)->folio;
        $detalles = Detalle::where('folio',$folio)->get();
        $total = 0;
        foreach($detalles as $deta){
            $total = $total + ($deta->precio * $deta->cantidad);
        }
        return $total;
    }

    public function GetClientName($id)
    {   
        return Cliente::find($this->find($id)->cliente_id)->razonSocial;
    }
}

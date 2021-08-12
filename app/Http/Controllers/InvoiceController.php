<?php

namespace App\Http\Controllers;
use App\Factura;
use App\Referencia;
use App\Detalle;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function listadoFacturas()
    {
        $invoices = Factura::where('estado','1')->orWhere('estado','2')->get();
        $Invoice = new Factura();
        
        return view('invoices.list', compact('Invoice','invoices'));
    }

    public function FacturasCargadas()
    {
        $invoices = Factura::where('estado','0')->get();
        $Invoice = new Factura();
        
        return view('invoices.subidas', compact('Invoice','invoices'));
    }

    public function findRefs(Request $req)
    {
        $post = $req->all();
        
        $invoices = Factura::find($post['id']);
        $referencias = Referencia::where('folio',$invoices->folio)->get();
        
        echo (json_encode($referencias));
    }

    public function findDets(Request $req)
    {
        $post = $req->all();
        
        $invoices = Factura::find($post['id']);
        $referencias = Detalle::where('folio',$invoices->folio)->get();
        
        echo (json_encode($referencias));
    }
}

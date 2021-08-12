<?php

namespace App\Http\Controllers;
use App\Factura;
use File;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function DownloadPdf($id)
    {
    	$id = base64_decode($id);

    	$invoice = Factura::find($id)->first();
        dd($id);
    	$pdf = base64_decode($invoice->pdf);
        
        $folder = storage_path('pdf/');
        //compruebo si la carpeta no existe para así crearla
        if (!file_exists($folder)) {
            File::makeDirectory($folder);
        }

    	$path = storage_path('pdf/PDF-FOLIO:'.$invoice->folio.'.pdf');

    	file_put_contents($path, $pdf);

    	return response()->download($path)->deleteFileAfterSend(true);
    }

    public function DownloadXml($id)
    {
    	$id = base64_decode($id);

    	$invoice = Factura::find($id)->first();

    	$xml = base64_decode($invoice->xml);

        $folder = storage_path('xml/');
        //compruebo si la carpeta no existe para así crearla
        if (!file_exists($folder)) {
            File::makeDirectory($folder);
        }

    	$path = storage_path('xml/XML-FOLIO:'.$invoice->folio.'.xml');

    	file_put_contents($path, $xml);

    	return response()->download($path)->deleteFileAfterSend(true);
    }
}

<?php

namespace App\Imports;

use App\Factura;
use App\Cliente;
use App\Referencia;
use App\Detalle;
use App\Ciudad;
use App\Comuna;
use App\Ndc;
use App\Ndcdetalle;
use App\Ndcreferencia;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;

class NdcImport implements ToCollection, WithValidation
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $documento = 61;

        DB::connection('mysql')->beginTransaction();
        try {
            foreach($rows as $row ){
                $factura = Factura::where('folio',$row[1])->first();
                
                if(!$factura){
                    return redirect('UpdaloadNdcExcel')->with('Error', "No puede ingresar notas de crédito si el documento al que hace referencia no existe");
                }
                $cliente = Cliente::find($factura->cliente_id)->first();
                
                $detalles = Detalle::where('folio',$row[1])->get();
                
                $ndc = 0;
                $ndc = Ndc::where('folio',$row[0])->count();

                if($ndc == 0){
                    Ndc::create([
                        'folio' => $row[0],
                        'fechaCreacion' =>  Carbon::now()->format('Y-m-d'),
                        'folioReferencia' => $factura->folio,
                        'tipoDocumento' => $documento, 
                    ]);

                    foreach($detalles as $deta)
                    {
                        Ndcdetalle::create([
                            'folio' => $row[0],
                            'codigoItem' => $deta->codigoItem, 
                            'nombreItem' => $deta->nombreItem, 
                            'cantidad' => $deta->cantidad, 
                            'unidad' => $deta->unidad, 
                            'precio' => $deta->precio,
                        ]);
                    }

                    Ndcreferencia::create([
                        'folio' => $row[0],
                        'tipoDocumentoRef' => $factura->tipoDocumento, 
                        'folioReferencia' => $factura->folio,
                        'fechaReferencia' => $factura->fechaCreacion,
                        'glosa' => $row[3],
                        'razon' => $row[2],
                    ]);

                }else{
                    foreach($detalles as $deta)
                    {
                        Ndcdetalle::create([
                            'folio' => $row[0],
                            'codigoItem' => $deta->codigoItem, 
                            'nombreItem' => $deta->nombreItem, 
                            'cantidad' => $deta->cantidad, 
                            'unidad' => $deta->unidad, 
                            'precio' => $deta->precio,
                        ]);
                    }

                    Ndcreferencia::create([
                        'folio' => $row[0],
                        'tipoDocumentoRef' => $factura->tipoDocumento, 
                        'folioReferencia' => $factura->folio,
                        'fechaReferencia' => $factura->fechaCreacion,
                        'glosa' => $row[3],
                        'razon' => $row[2],
                    ]);
                }
            }
            
            DB::connection('mysql')->commit();
        }
        catch (Exception $e) {
            DB::connection('mysql')->rollBack();
            return redirect('UpdaloadNdcExcel')->with('Error', "No puede ingresar notas de crédito si el documento al que hace referencia no existe");
        }
        //cambiar por vista de revisión de NDC
        return redirect('home')->with('Exito', "Datos de clientes, facturas y detalles cargados con éxito");

    }

    public function rules(): array
    {
        return [
            '0' => 'required',
            '1' => 'required',
            '2' => 'required',
            '3' => 'required',
        ];
    }
    
}

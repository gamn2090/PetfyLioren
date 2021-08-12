<?php

namespace App\Imports;

use App\Factura;
use App\Cliente;
use App\Referencia;
use App\Detalle;
use App\Ciudad;
use App\Comuna;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;

class InvoiceImport implements ToCollection, WithValidation
{
    /**
     * @param array $row
     *
     * @return Factura|null
     */
    public function collection(Collection $rows)
    {
        $documento = 33;

        DB::connection('mysql')->beginTransaction();
        try {
            foreach($rows as $row ){
                $cliente = 0;
                $cliente = Cliente::where('rut',$row[8])->count();
                //dd($row[11]);
                $comuna = Comuna::where('nombre','like',$row[11])->first()->codigo;
                $ciudad = Ciudad::where('nombre','like',$row[12])->first()->codigo;
                if($cliente == 0){
                    Cliente::create([
                        'rut' => $row[8],
                        'direccion' => $row[13], 
                        'razonSocial' => $row[9], 
                        'giro' => $row[10], 
                        'email' => $row[15], 
                        'comuna_id' => $comuna,//buscar en sus tablas
                        'ciudad_id' => $ciudad,//buscar en sus tablas
                        'telefono' => $row[14],
                    ]);
                }

                $factura = 0;
                $factura = Factura::where('folio',$row[0])->count();
                $clienteId = Cliente::where('rut',$row[8])->first()->id;

                if($factura == 0){
                    Factura::create([
                        'folio' => $row[0],
                        'tipoDocumento' => $documento, 
                        'fechaCreacion' => Carbon::now()->format('Y-m-d'), 
                        'cliente_id' => $clienteId,
                    ]);

                    Detalle::create([
                        'folio' => $row[0],
                        'codigoItem' => $row[16], 
                        'nombreItem' => $row[17], 
                        'cantidad' => $row[18], 
                        'unidad' => $row[19], 
                        'precio' => $row[20]
                    ]);

                    Referencia::create([
                        'folio' => $row[0],
                        'tipoDocumentoRef' => $row[21], 
                        'folioReferencia' => $row[22],
                        'fechaReferencia' => carbon::parse(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[23]))->format('Y-m-d'),//revisar formateo de la fecha
                        'glosa' => $row[25],
                        'razon' => $row[24],
                    ]);

                }else{
                    Detalle::create([
                        'folio' => $row[0],
                        'codigoItem' => $row[16], 
                        'nombreItem' => $row[17], 
                        'cantidad' => $row[18], 
                        'unidad' => $row[19], 
                        'precio' => $row[20]
                    ]);

                    Referencia::create([
                        'tipoDocumentoRef' => $row[21], 
                        'folioReferencia' => $row[22],
                        'fechaReferencia' => carbon::parse(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[23]))->format('Y-m-d'),//revisar formateo de la fecha
                        'glosa' => $row[25],
                        'razon' => $row[24],
                    ]);
                }
            }
            
            DB::connection('mysql')->commit();
        }
        catch (Exception $e) {
            DB::connection('mysql')->rollBack();
            return redirect('UpdaloadExcel')->with('Error', "No pudo cargar el excel, por favor revisar que tiene el formato correcto");
        }
        return redirect('FacturasCargadas')->with('Exito', "Datos de clientes, facturas y detalles cargados con éxito");
    }

    public function rules(): array
    {
        return [
            '0' => 'required',
            '1' => 'required',
            '2' => 'required',
            '3' => 'required',
            '4' => 'required',
            '5' => 'required',
            '6' => 'required',
            '7' => 'required',
            '8' => 'required',
            '9' => 'required',
            '10' => 'required',
            '11' => 'required',
            '12' => 'required',
            '15' => 'required',
            '16' => 'required',
            '17' => 'required',
            '18' => 'required',
            '19' => 'required',
            '20' => 'required',//colocar validación de que el monto mínimo debe se 100
        ];
    }
}
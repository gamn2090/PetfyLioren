<?php

namespace App\Http\Controllers;
use App\Factura;
use App\Cliente;
use App\Detalle;
use App\Referencia;
use App\Compania;
use App\Ndc;
use App\Ndcdetalle;
use App\Ndcreferencia;

use \GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Client as ClientGuzzle;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;

class EnviarController extends Controller
{
    public function enviarFacturas()
    {
        //el token de liioren para las peticiones producción:
        $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzMjkiLCJqdGkiOiI5NDdjODdlMWI0MTU1N2Q1NzRiMmIzOTgzM2ViZWJjZWY3NjZmZTA3Yjc5NjllYTI3NTc1NTgwNTYzNTBlOGUyMjBlMDhhZTA0ZjhlYzM3MyIsImlhdCI6MTYyNTI0MjM0MywibmJmIjoxNjI1MjQyMzQzLCJleHAiOjE2NTY3NzgzNDMsInN1YiI6IjE0NjEiLCJzY29wZXMiOltdfQ.RjIAPcd6oSptTTKM0HhDIp8vA_xqhI5iccoxw1whZRvCzYHVii-WHiHU3JwRQDtJXKzRheqqcioUKkpoHH2SZQ1biWX0S5mqmunITFLoIHXhi61YYp4ctvlfvxud-9EGeQ4agqLazGDwxgCAwbo5dJRhvSX_SLcq0XLIdHU-_WqYXyb1Cy7vejsfR2Tx26vDqKsneHOiOTji7RT8TRg0Ej222WivgfBfcB-FzKPlFoKp6kYoSeLBvd5hZLERzFjfeWDVd38S4zxTFoSZH6Sg-WqZ5s3472CJ36_zWsh3R3Ebu0S7s-0uriCkdrVlzNY1xZABkVAedd-JyNgmKgA-zVb4AsNUXOqKJ-S7Nn3uVZmdbBWYjMPJBomsjt3xSSP4zq3-aJGJabG-GMvzWSGMxBDQeYlzFy_B3JLK0ZWaWLFN8eLJsHuHhF2zjypcPZkOajuQvrXNSFgm69_x57SSveM0eFkcbcvYzfHDcw6EvBrwPcvGE9RDajqBz3_So57WJRx2P_S7DJm64O_1m53AsmJz34MQxwCcDSUc7ZKwEX8mRRcu2RjWWoCLvOtA3mWx7v8nuREKXweBeHgSoPwXAJLIlsLT0yWVT603mseTVZ1MDSdtr46demlr_FGwqsKHyu5Fz54SBMpUEsqD3qIkFDT4VMc6Ge8v3ll_WVRui3M';

        //$accessToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzMzAiLCJqdGkiOiJhNTNmMjY2NTBiY2QwMDVhN2Y4YTgxNDk4ZDM1MGU5OGIwMWYxYTMxNTA1NTk4YjRmNDk3YzY0YmFkNWRlMDczYmQ3ODQ4M2MwNjI3N2RjNCIsImlhdCI6MTYyNTUwNTA5MSwibmJmIjoxNjI1NTA1MDkxLCJleHAiOjE2NTcwNDEwOTEsInN1YiI6IjE0NjEiLCJzY29wZXMiOltdfQ.DeBZpYe7tpJXx-P8nN2LcFYfxO8Ob045qDZ5f3_Sbpsem32mC4lxniXt0p6w-Drbua5xPSF7xIBaVIpZ4vFLdDIMet0zAUdurj7KztaRXKUWVQ3U5rcy3v8Yb6lu4tmCsRJ7ehPAvGKTC-wxF_U7vHe0gQOdyCS8t3M7e3nH-DzIDuX29KSrPEZ0cSbi6o6ORmFg_Zx61PZjIauevaQpga3IdiLXl4P4IVeBcctg0fs5ReVO_Nu9wPMbdCpfTzvKSMZsTACwKgk-Rrs5lrNSwho0RUBz6yjOo1ET6r3r-ehnHeeveCXGRtmpo3eWpdhUD5Qwz49aQySnH2Rzebk6TF4JsVJmdYRSx7v_NWjaeEAe2B_4yHKnufObhsIcJgCKQcJjexKtVg-EM_ktbfpVOXmZdGhyZR1EmrWXDuod3uhDbIPQaqSLyQc-s8p1CukUpKp2bXTS4k86Mwd33KCis6lsxnnGGV1CHlzicIGAXsANz4MRbq5KQw_Uul8eKGOtCVXKZBSl4pLbyhmeOCJWDwztvULTLgUDy5H0-h-sNZZY37AkB-LbkHRdsEHJ6bZxgSrr_UjxaP8o-eo8ZrDkk2wLYH6Pzsp3xhXfFPYKua_gSGIRFPuFACVltvZAtqCC5PiJxXpIndMYG-HLH02l6w7Ecmf2qVi0Yb4TZYgtZws";


        //recuperamos las facturas no enviadas
        $facturas = Factura::where('estado',0)->get();
        $compania = Compania::first();

        foreach($facturas as $invoice){
            //por cada factura se obtienen el cliente y los detalles
            $cliente = Cliente::find($invoice->cliente_id);
            $detalles = Detalle::where('folio',$invoice->folio)->get();
            $referencias = Referencia::where('folio',$invoice->folio)->get();
           
            //se arma el array con los detalles
            $z = 1;
            $items = [];
            foreach ($detalles as $value) {
                $items[$z]['codigo'] = $value->codigoItem;
                $items[$z]['nombre'] = $value->nombreItem;
                $items[$z]['cantidad'] = $value->cantidad;
                $items[$z]['precio'] = $value->precio;
                $items[$z]['exento'] = false;
                $z++;
            }
            $items = array_values($items);
            $z = 1;
            $referenciasArr = [];
            if(!is_null($referencias)){
                foreach ($referencias as $value) {
                    $referenciasArr[$z]['fecha'] = $value->fechaReferencia;
                    $referenciasArr[$z]['tipodoc'] = $value->tipoDocumentoRef;
                    $referenciasArr[$z]['folio'] = $value->folioReferencia;
                    $referenciasArr[$z]['razon'] = $value->razon;
                    $referenciasArr[$z]['glosa'] = $value->glosa;
                    $z++;
                }
                $referenciasArr = array_values($referenciasArr);
            }

            $data = [
                'emisor' => 
                [
                    'tipodoc' => strval($invoice->tipoDocumento),
                    'fecha' => $invoice->fechaCreacion
                ],
                'receptor' => [
                    'rut' => $cliente->rut,
                    'rs' => $cliente->razonSocial,
                    'giro' => $cliente->giro,
                    'comuna' => $cliente->comuna_id,
                    'ciudad' => $cliente->ciudad_id,
                    'direccion' => $cliente->direccion,
                    'email' => $cliente->email,
                ],
                'detalles' => 
                    $items
                ,
                'referencias' =>
                    $referenciasArr
                ,
                'expects' => 'all',
            ];

            //dd($data);
            //hacemos la petición creando la cabecera
            $client = new ClientGuzzle;
            try{
                $response = $client->post('https://www.lioren.cl/api/dtes', [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$accessToken,
                        'Content-Type' => 'application/json'
                    ],
                    'body' => json_encode($data),
                ]);
    
                $responseBody = json_decode((string) $response->getBody(), true);
                //dd($responseBody);
                $facturaUpdate = Factura::find($invoice->id);
                
                if(isset($responseBody['pdf'])){
                    $facturaUpdate->estado = 1;
                    $facturaUpdate->pdf = $responseBody['pdf'];
                    $facturaUpdate->xml = $responseBody['xml'];
                }                
                else{
                    $facturaUpdate->estado = 2;
                    $facturaUpdate->errors = json_encode($responseBody['errors']);
                }
                $facturaUpdate->save();
                sleep(20);
            }catch(Exception $ex){
                throw($ex);
            }
        }

        return json_encode("Facturas enviadas correctamente");
    }

    public function checkInvoices()
    {
        $facturas = 0;
        $facturas = Factura::where('estado',0)->count();

        return $facturas;
    }

    public function enviarNdc()
    {
        //el token de liioren para las peticiones:
        $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzMjkiLCJqdGkiOiI5NDdjODdlMWI0MTU1N2Q1NzRiMmIzOTgzM2ViZWJjZWY3NjZmZTA3Yjc5NjllYTI3NTc1NTgwNTYzNTBlOGUyMjBlMDhhZTA0ZjhlYzM3MyIsImlhdCI6MTYyNTI0MjM0MywibmJmIjoxNjI1MjQyMzQzLCJleHAiOjE2NTY3NzgzNDMsInN1YiI6IjE0NjEiLCJzY29wZXMiOltdfQ.RjIAPcd6oSptTTKM0HhDIp8vA_xqhI5iccoxw1whZRvCzYHVii-WHiHU3JwRQDtJXKzRheqqcioUKkpoHH2SZQ1biWX0S5mqmunITFLoIHXhi61YYp4ctvlfvxud-9EGeQ4agqLazGDwxgCAwbo5dJRhvSX_SLcq0XLIdHU-_WqYXyb1Cy7vejsfR2Tx26vDqKsneHOiOTji7RT8TRg0Ej222WivgfBfcB-FzKPlFoKp6kYoSeLBvd5hZLERzFjfeWDVd38S4zxTFoSZH6Sg-WqZ5s3472CJ36_zWsh3R3Ebu0S7s-0uriCkdrVlzNY1xZABkVAedd-JyNgmKgA-zVb4AsNUXOqKJ-S7Nn3uVZmdbBWYjMPJBomsjt3xSSP4zq3-aJGJabG-GMvzWSGMxBDQeYlzFy_B3JLK0ZWaWLFN8eLJsHuHhF2zjypcPZkOajuQvrXNSFgm69_x57SSveM0eFkcbcvYzfHDcw6EvBrwPcvGE9RDajqBz3_So57WJRx2P_S7DJm64O_1m53AsmJz34MQxwCcDSUc7ZKwEX8mRRcu2RjWWoCLvOtA3mWx7v8nuREKXweBeHgSoPwXAJLIlsLT0yWVT603mseTVZ1MDSdtr46demlr_FGwqsKHyu5Fz54SBMpUEsqD3qIkFDT4VMc6Ge8v3ll_WVRui3M';

        //recuperamos las facturas no enviadas
        $ndc = Ndc::where('estado',0)->get();
        $compania = Compania::first();

        foreach($ndc as $doc){
            //por cada factura se obtienen el cliente y los detalles
            $cliente = Cliente::find(Factura::where('folio',$doc->folioReferencia)->first()->cliente_id);
            $detalles = Ndcdetalle::where('folio',$doc->folio)->get();
            $referencias = Ndcreferencia::where('folio',$doc->folio)->get();
           
            //se arma el array con los detalles
            $z = 1;
            $items = [];
            foreach ($detalles as $value) {
                $items[$z]['codigo'] = $value->codigoItem;
                $items[$z]['nombre'] = $value->nombreItem;
                $items[$z]['cantidad'] = $value->cantidad;
                $items[$z]['precio'] = $value->precio;
                $items[$z]['exento'] = false;
                $z++;
            }
            $items = array_values($items);
            //se arma el array con las diferencias
            $z = 1;
            $referenciasArr = [];
            if(!is_null($referencias)){
                foreach ($referencias as $value) {
                    $referenciasArr[$z]['fecha'] = $value->fechaReferencia;
                    $referenciasArr[$z]['tipodoc'] = $value->tipoDocumentoRef;
                    $referenciasArr[$z]['folio'] = $value->folioReferencia;
                    $referenciasArr[$z]['razon'] = $value->razon;
                    $referenciasArr[$z]['glosa'] = $value->glosa;
                    $z++;
                }
                $referenciasArr = array_values($referenciasArr);
            }

            $data = [
                'emisor' => 
                [
                    'tipodoc' => strval($doc->tipoDocumento),
                    'fecha' => $doc->fechaCreacion
                ],
                'receptor' => [
                    'rut' => $cliente->rut,
                    'rs' => $cliente->razonSocial,
                    'giro' => $cliente->giro,
                    'comuna' => $cliente->comuna_id,
                    'ciudad' => $cliente->ciudad_id,
                    'direccion' => $cliente->direccion,
                    'email' => $cliente->email,
                ],
                'detalles' => 
                    $items
                ,
                'referencias' =>
                    $referenciasArr
                ,
                'expects' => 'all',
            ];

            //dd($data);
            //hacemos la petición creando la cabecera
            $client = new ClientGuzzle;

            $response = $client->post('https://www.lioren.cl/api/dtes', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$accessToken,
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($data),
            ]);

            $responseBody = json_decode((string) $response->getBody(), true);
            //dd($responseBody);
            $facturaUpdate = Ndc::find($doc->id);
            
            if(isset($responseBody['pdf'])){
                $facturaUpdate->estado = 1;
                $facturaUpdate->pdf = $responseBody['pdf'];
                $facturaUpdate->xml = $responseBody['xml'];
            }                
            else{
                $facturaUpdate->estado = 2;
                $facturaUpdate->errors = json_encode($responseBody['errors']);
            }
            $facturaUpdate->save();
            sleep(15);
        }

        return redirect('home')->with('Exito', 'Facturas enviadas, proceda a revisarlas en el listado');
    }

    public function checkNdc()
    {
        $ndc = 0;
        $ndc = Ndc::where('estado',0)->count();

        return $ndc;
    }

    public function refsrazones()
    {
        $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzMjkiLCJqdGkiOiI5NDdjODdlMWI0MTU1N2Q1NzRiMmIzOTgzM2ViZWJjZWY3NjZmZTA3Yjc5NjllYTI3NTc1NTgwNTYzNTBlOGUyMjBlMDhhZTA0ZjhlYzM3MyIsImlhdCI6MTYyNTI0MjM0MywibmJmIjoxNjI1MjQyMzQzLCJleHAiOjE2NTY3NzgzNDMsInN1YiI6IjE0NjEiLCJzY29wZXMiOltdfQ.RjIAPcd6oSptTTKM0HhDIp8vA_xqhI5iccoxw1whZRvCzYHVii-WHiHU3JwRQDtJXKzRheqqcioUKkpoHH2SZQ1biWX0S5mqmunITFLoIHXhi61YYp4ctvlfvxud-9EGeQ4agqLazGDwxgCAwbo5dJRhvSX_SLcq0XLIdHU-_WqYXyb1Cy7vejsfR2Tx26vDqKsneHOiOTji7RT8TRg0Ej222WivgfBfcB-FzKPlFoKp6kYoSeLBvd5hZLERzFjfeWDVd38S4zxTFoSZH6Sg-WqZ5s3472CJ36_zWsh3R3Ebu0S7s-0uriCkdrVlzNY1xZABkVAedd-JyNgmKgA-zVb4AsNUXOqKJ-S7Nn3uVZmdbBWYjMPJBomsjt3xSSP4zq3-aJGJabG-GMvzWSGMxBDQeYlzFy_B3JLK0ZWaWLFN8eLJsHuHhF2zjypcPZkOajuQvrXNSFgm69_x57SSveM0eFkcbcvYzfHDcw6EvBrwPcvGE9RDajqBz3_So57WJRx2P_S7DJm64O_1m53AsmJz34MQxwCcDSUc7ZKwEX8mRRcu2RjWWoCLvOtA3mWx7v8nuREKXweBeHgSoPwXAJLIlsLT0yWVT603mseTVZ1MDSdtr46demlr_FGwqsKHyu5Fz54SBMpUEsqD3qIkFDT4VMc6Ge8v3ll_WVRui3M';

        $client = new ClientGuzzle([
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
                'Content-Type' => 'application/json'
            ],
        ]);

        $response = $client->get('https://www.lioren.cl/api/razonesref');
        $responseBody = json_decode((string) $response->getBody(), true);
        dd($responseBody);
    }

    public function regiones()
    {
        $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzMjkiLCJqdGkiOiI5NDdjODdlMWI0MTU1N2Q1NzRiMmIzOTgzM2ViZWJjZWY3NjZmZTA3Yjc5NjllYTI3NTc1NTgwNTYzNTBlOGUyMjBlMDhhZTA0ZjhlYzM3MyIsImlhdCI6MTYyNTI0MjM0MywibmJmIjoxNjI1MjQyMzQzLCJleHAiOjE2NTY3NzgzNDMsInN1YiI6IjE0NjEiLCJzY29wZXMiOltdfQ.RjIAPcd6oSptTTKM0HhDIp8vA_xqhI5iccoxw1whZRvCzYHVii-WHiHU3JwRQDtJXKzRheqqcioUKkpoHH2SZQ1biWX0S5mqmunITFLoIHXhi61YYp4ctvlfvxud-9EGeQ4agqLazGDwxgCAwbo5dJRhvSX_SLcq0XLIdHU-_WqYXyb1Cy7vejsfR2Tx26vDqKsneHOiOTji7RT8TRg0Ej222WivgfBfcB-FzKPlFoKp6kYoSeLBvd5hZLERzFjfeWDVd38S4zxTFoSZH6Sg-WqZ5s3472CJ36_zWsh3R3Ebu0S7s-0uriCkdrVlzNY1xZABkVAedd-JyNgmKgA-zVb4AsNUXOqKJ-S7Nn3uVZmdbBWYjMPJBomsjt3xSSP4zq3-aJGJabG-GMvzWSGMxBDQeYlzFy_B3JLK0ZWaWLFN8eLJsHuHhF2zjypcPZkOajuQvrXNSFgm69_x57SSveM0eFkcbcvYzfHDcw6EvBrwPcvGE9RDajqBz3_So57WJRx2P_S7DJm64O_1m53AsmJz34MQxwCcDSUc7ZKwEX8mRRcu2RjWWoCLvOtA3mWx7v8nuREKXweBeHgSoPwXAJLIlsLT0yWVT603mseTVZ1MDSdtr46demlr_FGwqsKHyu5Fz54SBMpUEsqD3qIkFDT4VMc6Ge8v3ll_WVRui3M';

        $client = new ClientGuzzle([
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
                'Content-Type' => 'application/json'
            ],
        ]);

        $response = $client->get('https://www.lioren.cl/api/regiones');
        $responseBody = json_decode((string) $response->getBody(), true);
        dd($responseBody);
    }

    public function comunas()
    {
        $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzMjkiLCJqdGkiOiI5NDdjODdlMWI0MTU1N2Q1NzRiMmIzOTgzM2ViZWJjZWY3NjZmZTA3Yjc5NjllYTI3NTc1NTgwNTYzNTBlOGUyMjBlMDhhZTA0ZjhlYzM3MyIsImlhdCI6MTYyNTI0MjM0MywibmJmIjoxNjI1MjQyMzQzLCJleHAiOjE2NTY3NzgzNDMsInN1YiI6IjE0NjEiLCJzY29wZXMiOltdfQ.RjIAPcd6oSptTTKM0HhDIp8vA_xqhI5iccoxw1whZRvCzYHVii-WHiHU3JwRQDtJXKzRheqqcioUKkpoHH2SZQ1biWX0S5mqmunITFLoIHXhi61YYp4ctvlfvxud-9EGeQ4agqLazGDwxgCAwbo5dJRhvSX_SLcq0XLIdHU-_WqYXyb1Cy7vejsfR2Tx26vDqKsneHOiOTji7RT8TRg0Ej222WivgfBfcB-FzKPlFoKp6kYoSeLBvd5hZLERzFjfeWDVd38S4zxTFoSZH6Sg-WqZ5s3472CJ36_zWsh3R3Ebu0S7s-0uriCkdrVlzNY1xZABkVAedd-JyNgmKgA-zVb4AsNUXOqKJ-S7Nn3uVZmdbBWYjMPJBomsjt3xSSP4zq3-aJGJabG-GMvzWSGMxBDQeYlzFy_B3JLK0ZWaWLFN8eLJsHuHhF2zjypcPZkOajuQvrXNSFgm69_x57SSveM0eFkcbcvYzfHDcw6EvBrwPcvGE9RDajqBz3_So57WJRx2P_S7DJm64O_1m53AsmJz34MQxwCcDSUc7ZKwEX8mRRcu2RjWWoCLvOtA3mWx7v8nuREKXweBeHgSoPwXAJLIlsLT0yWVT603mseTVZ1MDSdtr46demlr_FGwqsKHyu5Fz54SBMpUEsqD3qIkFDT4VMc6Ge8v3ll_WVRui3M';

        $client = new ClientGuzzle([
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
                'Content-Type' => 'application/json'
            ],
        ]);

        $response = $client->get('https://www.lioren.cl/api/comunas');
        $responseBody = json_decode((string) $response->getBody(), true);
        dd($responseBody);
    }

    public function ciudades()
    {
        $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzMjkiLCJqdGkiOiI5NDdjODdlMWI0MTU1N2Q1NzRiMmIzOTgzM2ViZWJjZWY3NjZmZTA3Yjc5NjllYTI3NTc1NTgwNTYzNTBlOGUyMjBlMDhhZTA0ZjhlYzM3MyIsImlhdCI6MTYyNTI0MjM0MywibmJmIjoxNjI1MjQyMzQzLCJleHAiOjE2NTY3NzgzNDMsInN1YiI6IjE0NjEiLCJzY29wZXMiOltdfQ.RjIAPcd6oSptTTKM0HhDIp8vA_xqhI5iccoxw1whZRvCzYHVii-WHiHU3JwRQDtJXKzRheqqcioUKkpoHH2SZQ1biWX0S5mqmunITFLoIHXhi61YYp4ctvlfvxud-9EGeQ4agqLazGDwxgCAwbo5dJRhvSX_SLcq0XLIdHU-_WqYXyb1Cy7vejsfR2Tx26vDqKsneHOiOTji7RT8TRg0Ej222WivgfBfcB-FzKPlFoKp6kYoSeLBvd5hZLERzFjfeWDVd38S4zxTFoSZH6Sg-WqZ5s3472CJ36_zWsh3R3Ebu0S7s-0uriCkdrVlzNY1xZABkVAedd-JyNgmKgA-zVb4AsNUXOqKJ-S7Nn3uVZmdbBWYjMPJBomsjt3xSSP4zq3-aJGJabG-GMvzWSGMxBDQeYlzFy_B3JLK0ZWaWLFN8eLJsHuHhF2zjypcPZkOajuQvrXNSFgm69_x57SSveM0eFkcbcvYzfHDcw6EvBrwPcvGE9RDajqBz3_So57WJRx2P_S7DJm64O_1m53AsmJz34MQxwCcDSUc7ZKwEX8mRRcu2RjWWoCLvOtA3mWx7v8nuREKXweBeHgSoPwXAJLIlsLT0yWVT603mseTVZ1MDSdtr46demlr_FGwqsKHyu5Fz54SBMpUEsqD3qIkFDT4VMc6Ge8v3ll_WVRui3M';

        $client = new ClientGuzzle([
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
                'Content-Type' => 'application/json'
            ],
        ]);

        $response = $client->get('https://www.lioren.cl/api/ciudades');
        $responseBody = json_decode((string) $response->getBody(), true);
        dd($responseBody);
    }

    
}

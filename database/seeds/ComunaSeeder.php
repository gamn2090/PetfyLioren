<?php

use Illuminate\Database\Seeder;
use \GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Client as ClientGuzzle;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use App\Comuna;
class ComunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
        foreach($responseBody as $ciudad){
            Comuna::create([
                'nombre' => $ciudad['nombre'],
                'codigo' => $ciudad['id'],
            ]);
        }
    }
}

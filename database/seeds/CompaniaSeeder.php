<?php

use Illuminate\Database\Seeder;
use App\Compania;

class CompaniaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   
    public function run()
    {
        factory(Compania::class)->create([
            'id' => '1',
            'razonSocial' => 'DISENO SCHOIHET & CABALLERO LIMITADA',
            'giro' => '477391 VENTA AL POR MENOR DE ALIMENTO Y ACCESORIOS PARA MASCOTAS EN COMERCIOS ESPECIALIZADOS',
            'rut' => '76262331-5',
            'direccion' => 'LO BELTRAN 1829 V IMPERIO',
            'telefono' => '+562 24167171',
            'comuna_id' => 3,
            'ciudad_id' => 3,
        ]);
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tipoDocumento');//33 factura, 39 boletas
            $table->string('folio')->unique();
            $table->string('fechaCreacion');            
            $table->string('estado')->default(0);//0 no enviada, 1 enviada
            //documentos que retorna en base 64
            $table->longText('xml')->nullable();
            $table->longText('pdf')->nullable();
            $table->longText('errors')->nullable();
            //foreigns
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}

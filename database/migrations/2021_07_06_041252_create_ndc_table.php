<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNdcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ndc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tipoDocumento');//60 ndc 
            $table->string('folio');
            $table->string('fechaCreacion');//33
            $table->string('folioReferencia');
            $table->string('estado')->default(0);//0 no enviada, 1 enviada
            //documentos que retorna en base 64
            $table->longText('xml')->nullable();
            $table->longText('pdf')->nullable();
            $table->longText('errors')->nullable();
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
        Schema::dropIfExists('ndc');
    }
}

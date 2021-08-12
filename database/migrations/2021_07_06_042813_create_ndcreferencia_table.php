<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNdcreferenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ndcreferencia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('folio');
            $table->string('tipoDocumentoRef');//801
            $table->string('folioReferencia');
            $table->string('fechaReferencia');
            $table->string('glosa');
            $table->string('razon');
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
        Schema::dropIfExists('ndcreferencia');
    }
}

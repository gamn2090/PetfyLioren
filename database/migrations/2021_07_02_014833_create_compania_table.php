<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compania', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('razonSocial');
            $table->string('giro');
            $table->string('rut');
            $table->string('direccion');
            $table->string('telefono');
            //foreigns
            $table->unsignedBigInteger('comuna_id');
            $table->foreign('comuna_id')->references('id')->on('comunas');
            $table->unsignedBigInteger('ciudad_id');
            $table->foreign('ciudad_id')->references('id')->on('ciudades');
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
        Schema::dropIfExists('compania');
    }
}

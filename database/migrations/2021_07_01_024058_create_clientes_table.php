<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rut');
            $table->string('direccion')->nullable();
            $table->string('razonSocial');
            $table->string('giro')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}

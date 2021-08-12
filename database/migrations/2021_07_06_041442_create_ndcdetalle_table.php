<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNdcdetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ndcdetalle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigoItem');
            $table->string('folio');
            $table->string('nombreItem');
            $table->integer('cantidad');
            $table->string('unidad')->nullable();
            $table->string('precio');
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
        Schema::dropIfExists('ndcdetalle');
    }
}

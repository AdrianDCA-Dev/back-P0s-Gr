<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleCronogramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_cronogramas', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fechaIni');
            //$table->string('duracion_dc');
            $table->string('grupo');
            $table->string('vigente');
            $table->integer('ambiente_id')->unsigned();
            $table->integer('modulo_id')->unsigned();
            $table->integer('cronograma_id')->unsigned();

            $table->integer('persona_id')->unsigned();


            $table->foreign('modulo_id')->references('id')->on('modulos')->onUpdate('cascade');
            $table->foreign('cronograma_id')->references('id')->on('cronogramas')->onUpdate('cascade');
            $table->foreign('ambiente_id')->references('id')->on('ambientes')->onUpdate('cascade');
            $table->foreign('persona_id')->references('id')->on('personas')->onUpdate('cascade');

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
        Schema::dropIfExists('detalle_cronogramas');
    }
}

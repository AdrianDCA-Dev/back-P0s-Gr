<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleAvaluacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_avaluacions', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_detalle');
            $table->integer('valor');
            $table->integer('detalle_cronograma_id')->unsigned();
            $table->integer('criterio_evaluacion_id')->nullable()->unsigned();
            $table->integer('inscripcion_id')->nullable()->unsigned();
            $table->integer('indicador_id')->nullable()->unsigned();

            $table->foreign('detalle_cronograma_id')->references('id')->on('detalle_cronogramas')->onUpdate('cascade');
            $table->foreign('criterio_evaluacion_id')->references('id')->on('criterio_evaluacions')->onUpdate('cascade');
            $table->foreign('inscripcion_id')->references('id')->on('inscripcions')->onUpdate('cascade');
            $table->foreign('indicador_id')->references('id')->on('indicadores')->onUpdate('cascade');
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
        Schema::dropIfExists('detalle_avaluacions');
    }
}

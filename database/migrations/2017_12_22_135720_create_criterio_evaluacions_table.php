<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCriterioEvaluacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterio_evaluacions', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->string('nombre');
            $table->string('porcentaje');
            $table->boolean('tipo_evaluacion');
            $table->boolean('valido');
            $table->integer('detalle_cronograma_id')->nullable()->unsigned();

            $table->foreign('detalle_cronograma_id')->references('id')->on('detalle_cronogramas')->onUpdate('cascade');
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
        Schema::dropIfExists('criterio_evaluacions');
    }
}

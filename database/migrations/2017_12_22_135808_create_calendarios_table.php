<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendarios', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fechaCalendario');
            $table->time('horaIni');
            $table->time('horaFin');

            $table->integer('detalle_cronograma_id')->unsigned();
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
        Schema::dropIfExists('calendarios');
    }
}

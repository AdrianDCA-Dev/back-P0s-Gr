<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscripcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcions', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->boolean('valido');
            $table->integer('persona_id')->unsigned();
            $table->integer('detalle_cronograma_id')->unsigned();

            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('inscripcions');
    }
}

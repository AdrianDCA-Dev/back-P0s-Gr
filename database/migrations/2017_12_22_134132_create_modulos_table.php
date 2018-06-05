<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulos', function (Blueprint $table) {
            $table->increments('id');
            //aumentar atributo Numero no olvidar maximo 20 numeros, automaticos
            $table->string('nombremodulo');
            $table->string('numero');
            $table->string('numCredito');
            $table->boolean('valido');
            //aumentar atributo duracion_m
            $table->string("duracion");
            $table->integer('programa_academico_id')->unsigned();
            $table->foreign('programa_academico_id')->references('id')->on('programa_academicos')->onUpdate('cascade');

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
        Schema::dropIfExists('modulos');
    }
}

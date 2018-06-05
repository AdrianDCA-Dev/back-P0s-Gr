<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramaAcademicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programa_academicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->boolean('valido');
            $table->string('modalidad');
            $table->text('objetivo');
            //$table->string('duracion_pa');
            $table->integer('tipo_pa_id')->unsigned();
            $table->foreign('tipo_pa_id')->references('id')->on('tipo_pas')->onUpdate('cascade');

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
        Schema::dropIfExists('programa_academicos');
    }
}

<?php

use Illuminate\Database\Seeder;

class PersonaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('users')->truncate();

        $academico = new \App\Persona();

        $academico->dni = "10203040-tj";
        $academico->nombres = "Carlos Benito";
        $academico->app = "Choque";
        $academico->apm = "Altamirano";
        $academico->sexo = "Masculino";
        $academico->fechaNac = "1990-02-10";
        $academico->direccion = "B/Juan 23";
        $academico->fono = "6689325";
        $academico->save();
/*
        $administrativo = new \App\Persona();
        $administrativo->dni = "58696523";
        $administrativo->nombres = "Jose Antonio";
        $administrativo->app = "Peralez";
        $administrativo->apm = "Chilaca";
        $administrativo->sexo = "Masculino";
        $administrativo->fechaNac = "2018-02-10";
        $administrativo->direccion = "B/Juan Pablo II";
        $administrativo->fono = "6689565";
        $administrativo->save();

        $becario = new \App\Persona();
        $becario->dni = "89785456";
        $becario->nombres = "Ramiro Diego";
        $becario->app = "Ramirez";
        $becario->apm = "Cardoso";
        $becario->sexo = "Masculino";
        $becario->fechaNac = "2018-02-10";
        $becario->direccion = "B/Carlos Murillo";
        $becario->fono = "6623654";
        $becario->save();

        $persona1 = new \App\Persona();
        $persona1->dni = "89754583";
        $persona1->nombres = "Julia";
        $persona1->app = "Ramos";
        $persona1->apm = "Pedregal";
        $persona1->sexo = "Femenino";
        $persona1->fechaNac = "2018-02-10";
        $persona1->direccion = "B/Carlos Murillo";
        $persona1->fono = "6623684";
        $persona1->save();

        $persona2 = new \App\Persona();
        $persona2->dni = "82584456";
        $persona2->nombres = "Ana";
        $persona2->app = "Altamirano";
        $persona2->apm = "Cardoso";
        $persona2->sexo = "Femenino";
        $persona2->fechaNac = "2018-02-10";
        $persona2->direccion = "B/Murillo";
        $persona2->fono = "6625654";
        $persona2->save();*/
    }
}

<?php

use Illuminate\Database\Seeder;

class PerfilSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('perfils')->truncate();

        $academico = new \App\Perfil();

        $academico->nombre = "Academico";
        $academico->valido = true;
        $academico->save();

        $administrativo = new \App\Perfil();
        $administrativo->nombre = "Administrativo";
        $administrativo->valido = true;
        $administrativo->save();

        $becario = new \App\Perfil();
        $becario->nombre = "Becario";
        $becario->valido = true;
        $becario->save();
    }
}

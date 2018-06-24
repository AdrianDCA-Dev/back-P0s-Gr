<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // DB::table('users')->truncate();

        $academico = new \App\User();

        $academico->name = "10203040";
        $academico->email = "admin@admin.com";
        $academico->password = bcrypt('10203040');
        $academico->estado = true;
        $academico->persona_id = 1;
        $academico->save();

     /*   $administrativo = new \App\User();
        $administrativo->name = "joselito";
        $administrativo->email = "admin@admin.com";
        $administrativo->password = bcrypt('123456789');
        $administrativo->estado = true;
        $administrativo->persona_id = 2;

        $administrativo->save();

        $becario = new \App\User();
        $becario->name = "Ramirez";
        $becario->email = "estudiante@estudiante.com";
        $becario->password = bcrypt('123456789');
        $becario->estado = true;
        $becario->persona_id = 3;
        $becario->save();*/
    }
}

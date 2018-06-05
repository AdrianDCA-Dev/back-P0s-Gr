<?php

use Illuminate\Database\Seeder;

class AmbienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ambientes')->truncate();

        $A301 = new \App\Ambiente();
        $A301->nombre = "A301";
        $A301->valido = true;
        $A301->save();

        $B401 = new \App\Ambiente();
        $B401->nombre = "B401";
        $B401->valido = true;
        $B401->save();

        $C201 = new \App\Ambiente();
        $C201->nombre = "C201";
        $C201->valido = true;
        $C201->save();
    }
}

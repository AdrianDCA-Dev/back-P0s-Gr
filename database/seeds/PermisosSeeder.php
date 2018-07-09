<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Permission;
use App\Role;
use App\User;
class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolAdmin = new Role(); // 1
        $rolAdmin->name = 'Director';
        $rolAdmin->display_name = "Administrator";
        $rolAdmin->save();

        $rolEncargado = new Role(); // 2
        $rolEncargado->name = 'Coordinador';
        $rolEncargado->display_name = "Administrador Encargado";
        $rolEncargado->save();

        $rolDocente = new Role(); // 3
        $rolDocente->name = 'Docente';
        $rolDocente->display_name = "Administrador Docente";
        $rolDocente->save();

        $rolEstudiante = new Role(); // 4
        $rolEstudiante->name = 'Estudiante';
        $rolEstudiante->display_name = "Administrador Estudiante";
        $rolEstudiante->save();

        //ADMINISTRADOR
        $user = User::where('email', '=', 'admin@admin.com')->first();
        $user->attachRole($rolAdmin);
        /*//
        //ENCARGADO
        $user = User::where('email', '=', 'sabrina@gmail.com')->first();
        $user->attachRole($rolEncargado);
        //
        //DOCENTE
        $user = User::where('email', '=', 'jose@gmail.com')->first();
        $user->attachRole($rolDocente);

        $user = User::where('email', '=', 'ramiro@gmail.com')->first();
        $user->attachRole($rolDocente);

        $user = User::where('email', '=', 'julia@gmail.com')->first();
        $user->attachRole($rolDocente);
        //
        //ALUMNOS
        $user = User::where('email', '=', 'estudiante1@gmail.com')->first();
        $user->attachRole($rolEstudiante);

        $user = User::where('email', '=', 'estudiante2@gmail.com')->first();
        $user->attachRole($rolEstudiante);

        $user = User::where('email', '=', 'estudiante3@gmail.com')->first();
        $user->attachRole($rolEstudiante);

        $user = User::where('email', '=', 'estudiante4@gmail.com')->first();
        $user->attachRole($rolEstudiante);

        $user = User::where('email', '=', 'estudiante5@gmail.com')->first();
        $user->attachRole($rolEstudiante);
        //*/

        $admin = new Permission();
        $admin->name = "admin_director";
        $admin->display_name = "Administrador";
        $admin->description = "";
        $admin->save();

        $encargado = new Permission();
        $encargado->name = "admin_coordinador";
        $encargado->display_name = "Admin Coordinador";
        $encargado->description = "";
        $encargado->save();

        $docente = new Permission();
        $docente->name = "admin_docente";
        $docente->display_name = "Admin Docente";
        $docente->description = "";
        $docente->save();

        $estudiante = new Permission();
        $estudiante->name = "admin_estudiante";
        $estudiante->display_name = "Admin Estudiante";
        $estudiante->description = "";
        $estudiante->save();

        $rolAdmin->attachPermissions([$admin]);
        $rolEncargado->attachPermissions([$encargado]);
        $rolDocente->attachPermissions([$docente]);
        $rolEstudiante->attachPermissions([$estudiante]);

    }
}

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

        $rolCoordinador = new Role(); // 2
        $rolCoordinador->name = 'Coordinador';
        $rolCoordinador->display_name = "Administrador coordinador";
        $rolCoordinador->save();

        $rolDocente = new Role(); // 3
        $rolDocente->name = 'Docente';
        $rolDocente->display_name = "Administrador Docente";
        $rolDocente->save();

        $rolEstudiante = new Role(); // 4
        $rolEstudiante->name = 'Estudiante';
        $rolEstudiante->display_name = "Administrador Estudiante";
        $rolEstudiante->save();

        $user = User::where('email', '=', 'admin@admin.com')->first();
        $user->attachRole($rolAdmin);

        $admin = new Permission();
        $admin->name = "admin_director";
        $admin->display_name = "Administrador";
        $admin->description = "";
        $admin->save();

        $coordinador = new Permission();
        $coordinador->name = "admin_coordinador";
        $coordinador->display_name = "Admin Coordinador";
        $coordinador->description = "";
        $coordinador->save();

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
        $rolCoordinador->attachPermissions([$coordinador]);
        $rolDocente->attachPermissions([$docente]);
        $rolEstudiante->attachPermissions([$estudiante]);
    }
}

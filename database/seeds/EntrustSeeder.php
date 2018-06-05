<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
use App\User;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->truncate();
        DB::table('permission_role')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();

        $admin = new Role(); // 1
        $admin->name = 'admin';
        $admin->display_name = "Administrator";
        $admin->save();

        $editor = new Role(); // 2
        $editor->name = 'docente';
        $editor->display_name = "Docente";
        $editor->save();

        $userRole = new Role(); // 3
        $userRole->name = 'estudiante';
        $userRole->display_name = "Estudiante";

        $userRole->save();

        $user = User::where('email', '=', 'admin@admin.com')->first();
        $user->attachRole($admin);
        //$user->roles()->attach($admin->id); Eloquent basic

        $user1 = User::where('email', '=', 'docente@docente.com')->first();
        $user1->attachRole($editor);

        $user2 = User::where('email', '=', 'estudiante@estudiante.com')->first();
        $user2->attachRole($userRole);

        $manageRoles = new Permission();
        $manageRoles->name = 'manage_roles';
        $manageRoles->display_name = "Manage roles";
        $manageRoles->description = "";
        $manageRoles->save();

        $createRoles = new Permission();
        $createRoles->name = 'create_roles';
        $createRoles->display_name = "Create roles";
        $createRoles->description = "";
        $createRoles->save();

        $updateRoles = new Permission();
        $updateRoles->name = 'update_roles';
        $updateRoles->display_name = "Update roles";
        $updateRoles->description = "";
        $updateRoles->save();

        $destroyRoles = new Permission();
        $destroyRoles->name = 'delete_roles';
        $destroyRoles->display_name = "Delete roles";
        $destroyRoles->description = "";
        $destroyRoles->save();


        $manageUsers = new Permission();
        $manageUsers->name = 'manage_users';
        $manageUsers->display_name = "Manager users";
        $manageUsers->description = "";
        $manageUsers->save();

        $createUsers = new Permission();
        $createUsers->name = 'create_users';
        $createUsers->display_name = "Create users";
        $createUsers->description = "";
        $createUsers->save();

        $updateUsers = new Permission();
        $updateUsers->name = 'update_users';
        $updateUsers->display_name = "Update users";
        $updateUsers->description = "";
        $updateUsers->save();

        $destroyUsers = new Permission();
        $destroyUsers->name = 'delete_users';
        $destroyUsers->display_name = "Delete users";
        $destroyUsers->description = "";
        $destroyUsers->save();


        $managePerms = new Permission();
        $managePerms->name = 'manage_permissions';
        $managePerms->display_name = "Manage permissions";
        $managePerms->description = "";
        $managePerms->save();

        $createPerms = new Permission();
        $createPerms->name = 'create_permissions';
        $createPerms->display_name = "Create permissions";
        $createPerms->description = "";
        $createPerms->save();

        $updatePerms = new Permission();
        $updatePerms->name = 'update_permissions';
        $updatePerms->display_name = "Update permissions";
        $updatePerms->description = "";
        $updatePerms->save();

        $destroyPerms = new Permission();
        $destroyPerms->name = 'delete_permissions';
        $destroyPerms->display_name = "Delete permissions";
        $destroyPerms->description = "";
        $destroyPerms->save();

        $admin->attachPermissions([$manageRoles, $createRoles, $updateRoles, $destroyRoles, $manageUsers, $createUsers, $updateUsers, $destroyUsers, $managePerms, $createPerms, $updatePerms, $destroyPerms]);
        //$admin->perms()->sync([$manageRoles->id, $manageUsers->id, $managePerms->id]); Eloquent basic

        $editor->attachPermissions([$managePerms, $createPerms, $updatePerms, $destroyPerms]);
    }
}

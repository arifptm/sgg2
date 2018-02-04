<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_super = new Role();
        $role_super->name = 'super';
        $role_super->description = 'Superman';
        $role_super->save();

        $role_user = new Role();
        $role_user->name = 'user';
        $role_user->description = 'Laboran';
        $role_user->save();

        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'Admin';
        $role_admin->save();

        $role_kalab = new Role();
        $role_kalab->name = 'kalab';
        $role_kalab->description = 'Ketua Laborat';
        $role_kalab->save();
    }
}

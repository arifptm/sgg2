<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$role_super = Role::where('name', 'super')->first();
    	$role_user = Role::where('name', 'user')->first();
    	$role_admin = Role::where('name', 'admin')->first();
    	$role_kalab = Role::where('name', 'kalab')->first();

		$super = new User();
        $super->name = 'Super';
        $super->email = 'super@logistiktedi.com';
        $super->password = bcrypt('123456');
        $super->verified = 1;
        $super->save();
        $super->roles()->attach($role_super);

        $user = new User();
        $user->name = 'Laboran';
        $user->email = 'laboran@logistiktedi.com';
        $user->password = bcrypt('123456');
        $user->verified = 1;
        $user->save();
        $user->roles()->attach($role_user);

        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@logistiktedi.com';
        $admin->password = bcrypt('123456');
        $admin->verified = 1;
        $admin->save();
        $admin->roles()->attach($role_admin);

		$kalab = new User();
        $kalab->name = 'Kalab';
        $kalab->email = 'kalab@logistiktedi.com';
        $kalab->password = bcrypt('123456');
        $kalab->verified = 1;
        $kalab->save();
        $kalab->roles()->attach($role_kalab);
    }
}


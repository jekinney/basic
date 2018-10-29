<?php

use App\User;
use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'slug' => 'site_admin',
            'name' => 'Site Admin',
            'description' => 'Sites main admin',
        ]);

        $user = User::create([
        	'name' => 'Jason',
        	'email' => 'jekinneys@yahoo.com',
            'role_id' => $role->id,
        	'password' => bcrypt( 'secret' ),
        ]);

        User::create([
            'name' => 'Jason Kinney',
            'email' => 'jekinneys@gmail.com',
            'role_id' => 0,
            'password' => bcrypt( 'secret' ),
        ]);

        $permissions = [
            /// Access
            ['slug' => 'access-dash', 'name' => 'Access Dashboard', 'description' => 'Access Dashboard admin area.'],
        	/// user
        	['slug' => 'view-user', 'name' => 'View User', 'description' => 'View a list and a single user.'],
        	['slug' => 'update-user', 'name' => 'Update User', 'description' => 'Update a user.'],
        	['slug' => 'delete-user', 'name' => 'Delete User', 'description' => 'Delete a user.'],
        	/// role
        	['slug' => 'view-role', 'name' => 'View Role', 'description' => 'View a list and a single role.'],
        	['slug' => 'create-role', 'name' => 'Create Role', 'description' => 'Create a role.'],
        	['slug' => 'update-role', 'name' => 'Update Role', 'description' => 'Update a role.'],
        	['slug' => 'delete-role', 'name' => 'Delete Role', 'description' => 'Delete a role.'],
            // Support
            ['slug' => 'view-support', 'name' => 'View Support', 'description' => 'View Support requests.'],
            ['slug' => 'view-assigned-support', 'name' => 'View Assigned Support', 'description' => 'View assigned Support requests only.'],
            ['slug' => 'update-support', 'name' => 'Update Support', 'description' => 'Update and assign support requests'],
            // Monitor
            ['slug' => 'view-health', 'name' => 'View Health', 'description' => 'View Health Monitor'],
        ];

        foreach ( $permissions as $perm ) {

        	Permission::create( $perm );

        }

        $role->permissions()->attach( Permission::get() );
    }
}

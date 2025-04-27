<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $allRoles = Role::all();

        // $users = User::factory(4)->create();

        $codegraphicsUser = User::factory()->create([
            'first_name' => 'codegraphics',
            'middle_name' => 'codegraphics',
            'last_name' => 'codegraphics',
            'email' => 'codegraphics@gmail.com',
            'password' => bcrypt('codegraphics'), 
            'email_verified_at' => now(),
        ]);

        // foreach($users as $user) {
        //     User_Role::factory()->create([
        //         'user_id' => $user->id,
        //         'role_id' => $allRoles->random()->id,
        //     ]);
        // }

        $adminRole = $allRoles->where('role_name', 'Admin')->first();

        if ($adminRole) {
            User_Role::factory()->create([
                'user_id' => $codegraphicsUser->id,
                'role_id' => $adminRole->id,
            ]);
        }
    }
}

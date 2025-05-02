<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Program;
use App\Models\Role;
use App\Models\Student;
use App\Models\User_Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $program = Program::where('program_acronym' , 'CSN')->first();

        $roles = Role::all() ; 

        $user = User::create([
            'first_name' => 'nasr',
            'middle_name' => 'hassan',
            'last_name' => 'mpalang\'ombe',
            'email' => 'nasrkihagila@gmail.com',
            'phone' => '0620656604',
            'password' => 'Hassan14@',
        ]);

        $role = $roles->where('role_name' , 'Voter')->first();

        if($role) {
            User_Role::create([
                'user_id' => $user->id ,
                'role_id' => $role->id
            ]);
        }

        $students = [
            [
                'program_id' => $program->id ?? 1,
                'user_id' => $user->id ?? 2,
                'registration_number' => '30326/T.2023',
                'start_date' => Carbon::parse('2023-06-20'),
                'end_date' => Carbon::parse('2026-07-20')
            ]
        ];

        Student::insert($students);
    }
}

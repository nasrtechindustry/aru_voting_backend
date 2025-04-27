<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(StudentSeeder::class);
    }
}

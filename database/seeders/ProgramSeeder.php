<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $department = Department::where('department_name', 'Computer Science and Mathematics')->first();
        $departmentId = $department?->id ?? 5;

        $csmPrograms = [
            [
                'program_name' => 'Bsc IN COMPUTER SYSTEMS AND MATHEMATICS',
                'program_type' => 'bachelors',
                'duration' => 3,
                'description' => null,
                'program_acronym' => 'CSN'
            ],

            [
                'program_name' => 'Bsc IN INFORMATION SYSTEMS MANAGEMENT',
                'program_type' => 'bachelors',
                'duration' => 3,
                'description' => null,
                'program_acronym' => 'ISM'
            ],

            [
                'program_name' => 'Bsc IN DATA SCIENCE AND ARTIFICIAL INTELLIGENCE',
                'program_type' => 'bachelors',
                'duration' => 3,
                'description' => null,
                'program_acronym' => 'DSAI'
            ],
        ];

        foreach ($csmPrograms as $program) {
            $program['department_id'] = $departmentId;
            Program::insert($program);
        }
    }
}

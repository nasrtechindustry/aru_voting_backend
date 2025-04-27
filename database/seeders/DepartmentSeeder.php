<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            1 => [
                ['department_name' => 'Architecture', 'department_acronym' => 'DA'],
                ['department_name' => 'Interior Design', 'department_acronym' => 'ID'],
                ['department_name' => 'Building Economics', 'department_acronym' => 'BE'],
            ],
            2 => [
                ['department_name' => 'GEOSPATIAL SCIENCES AND TECNOLOGY', 'department_acronym' => 'GST'],
                ['department_name' => 'COMPUTER SYSTEMS AND MATHEMATICS', 'department_acronym' => 'CSM'],
                ['department_name' => 'BUSINESS STUDIES', 'department_acronym' => 'BS'],
                ['department_name' => 'LAND MANAGEMENT AND EVALUATION', 'department_acronym' => 'LMV'],
            ],
            3 => [
                ['department_name' => 'CIVIL AND ENVIRONMENTAL ENGINEERING', 'department_acronym' => 'CEE'],
                ['department_name' => 'ENVIRONMENTAL SCIENCE AND MANAGEMENT', 'department_acronym' => 'ESM'],
                ['department_name' => 'ECONOMICS AND SOCIAL STUDIES', 'department_acronym' => 'ESS'],
                ['department_name' => 'URBAN AND REGIONAL PLANNING', 'department_acronym' => 'URP'],
            ],
        ];

        foreach ($departments as $schoolId => $deptList) {
            foreach ($deptList as &$dept) {
                $dept['school_id'] = $schoolId;
            }
            Department::insert($deptList);
        }
    }
}

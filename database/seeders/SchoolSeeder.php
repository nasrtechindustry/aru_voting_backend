<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        $possibleSchools = [
            [
                'school_name' => 'School of Architecture Construction Economics and Management',
                'school_acronym' => 'SACEM'
            ],
            [
                'school_name' => 'School of Earth Sciences, Real Estate, Business and Informatics',
                'school_acronym' => 'SERBI'
            ],
            [
                'school_name' => 'School of Engineering and Environmental Studies',
                'school_acronym' => 'SEES'
            ],
            [
                'school_name' => 'School of Spatial Planning and Social Sciences',
                'school_acronym' => 'SSPSS'
            ],
        ];

        School::insert($possibleSchools);
    }
}

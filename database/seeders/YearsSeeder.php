<?php

namespace Database\Seeders;

use App\Models\Year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class YearsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = [1, 2, 3, 4, 5, 6];

        foreach ($years as $year) {

            Year::create([
                'year_of_study' => $year
            ]);
        }
    }
}

<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentImport implements ToCollection
{
    protected $program_id;
    protected $start_date;
    protected $end_date;

    public function __construct($program_id, $start_date, $end_date)
    {
        $this->program_id = $program_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $users = [];
        $students = [];
        $emails = []; // To store emails for bulk existence check

        foreach ($collection as $row) {
            $emails[] = $row['3']; 
        }

        // Get existing users by email
        $existingUsers = User::whereIn('email', $emails)->pluck('email')->toArray();

        foreach ($collection as $row) {
            if (in_array($row['3'], $existingUsers)) {
                continue; 
            }

            $users[] = [
                'first_name' => $row['0'],
                'middle_name' => $row['1'],
                'last_name' => $row['2'],
                'email' => $row['3'],
                'phone' => $row['5'],
                'password' => 'TANZANIA',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert users in bulk
        if (!empty($users)) {
            User::insert($users);

            // Retrieve inserted users
            $insertedUsers = User::whereIn('email', $emails)->get();

            foreach ($collection as $row) {
                $user = $insertedUsers->where('email', $row['3'])->first();
                if ($user) {
                    $students[] = [
                        'user_id' => $user->id,
                        'program_id' => $this->program_id,
                        'registration_number' => $row['4'],
                        'start_date' => Carbon::parse($this->start_date),
                        'end_date' => Carbon::parse($this->end_date),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            // Bulk insert students
            if (!empty($students)) {
                Student::insert($students);
            }
        }
    }
}

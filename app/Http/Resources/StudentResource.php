<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'program_id' => $this->program_id,
            'user_id' => $this->user_id,
            'first_name' => $this->user->first_name,
            'middle_name' => $this->user->middle_name,
            'last_name' => $this->user->last_name,
            'email' => $this->user->email,
            'phone' => $this->user->phone,
            'start_date' => Carbon::parse($this->start_date)->toIso8601String(),
            'end_date' => Carbon::parse($this->end_date)->toIso8601String(),
            'full_name' => $this->full_name,
            'registration_number' => $this->registration_number,
            'program_name' => $this->program->program_name,
            'department_name' => $this->program->department->department_name,
            'school_name' => $this->program->department->school->school_name,
        ];
    }
}

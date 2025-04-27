<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramEditRequest;
use App\Http\Controllers\BaseContoller;
use App\Http\Requests\ProgramAddRequest;
use App\Models\Department;
use App\Models\Program;

class ProgramController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::with(['department', 'department.school'])->latest()->get();


        $programs = $programs->map(function ($program): array {
            return  [
                'id' => $program->id,
                'program_name' => $program->program_name,
                'program_type' => $program->program_type,
                'program_acronym' => $program->program_acronym,
                'duration' => $program->duration,
                'description' => $program->description,
                'department_id' => $program->department_id,
                'department_name' => $program->department->department_name,
                'school_name' => $program->department->school->school_name
            ];
        });

        return $this->successResponse('All programs fetched successfully', $programs);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(ProgramAddRequest $request)
    {
        $validated = $request->validated();

        $department = Department::find($validated['department_id']);

        if (!$department) {
            return $this->errorResponse('Department not found', status: 404);
        }

        $program_name = Program::where('program_name', $validated['program_name'])->first();

        if ($program_name) {
            return $this->errorResponse("The program name [{$validated['program_name']}] already exist");
        }

        $program = Program::create([
            'department_id' => $validated['department_id'],
            'program_name' => $validated['program_name'],
            'program_acronym' => $validated['program_acronym'],
            'program_type' => $validated['program_type'],
            'duration' => $validated['duration'],
            'description' => $validated['description'] ?? null,
        ]);

        if (!$program) {
            return $this->errorResponse('Failed to create new program', status: 500);
        }

        return $this->successResponse('Program created successfully', $program, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProgramEditRequest $request, string $id)
    {
        $validated = $request->validated();

        $program = Program::find($id);

        if (!$program) {
            return $this->errorResponse('program not found', status: 404);
        }

        $program->update([
            'department_id' => $validated['department_id'],
            'program_name' => $validated['program_name'],
            'program_acronym' => $validated['program_acronym'],
            'program_type' => $validated['program_type'],
            'duration' => $validated['duration'],
            'description' => $validated['description'] ?? null,
        ]);

        return $this->successResponse('program updated successfully', status: 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string|int $id)
    {
        $program = Program::find($id);

        if (!$program) {
            return $this->errorResponse("Program not found", status: 404);
        }

        $program->delete();

        return $this->successResponse('Program deleted successully', status: 201);
    }

    public function count()
    {
        return $this->successResponse('Total programs', Program::count('id'), 200);
    }
}

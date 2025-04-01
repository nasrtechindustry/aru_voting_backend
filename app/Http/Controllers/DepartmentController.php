<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Controllers\BaseContoller;
use App\Http\Requests\DepartmentRequest;
use App\Models\School;

class DepartmentController extends BaseContoller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::with('school')->get();

        $departments = $departments->map(function ($department) {
            return [
                'id' => $department->id,
                'key' => $department->id,
                'school_id' => $department->school_id,
                'department_name' => $department->department_name,
                'department_acronym' => $department->department_acronym,
                'school_name' => $department->school->school_name ?? null, 
            ];
        });

        return $this->successResponse('All departments', $departments);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $validated = $request->validated();

        $school  = School::find($validated['school_id']);

        if ($school) {

            $department = Department::create($validated);

            if (!$department) {
                return $this->errorResponse(' Fail to create departmet . Try again ');
            }

            return $this->successResponse('Department created successfully', $department);
        }
        return $this->errorResponse('No such school ');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, string $id)
    {
        $validated = $request->validated();

        $department  = Department::find($id);

        if ($department) {
            $department->update($validated);
            return $this->successResponse('Department updated successfully', $department);
        }

        return $this->errorResponse('department not found');
    }

    /**ABdfgS 	ABSbghnjm
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::find($id);

        if (!$department) {

            return $this->errorResponse('Department not found');
        }


        $department->delete();

        return $this->successResponse('Department deleted successfully');
    }
}

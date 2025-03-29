<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Requests\SchoolRequest;
use App\Http\Controllers\BaseContoller;

class SchoolController extends  BaseContoller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = School::all();

        if ($schools) {
            return $this->successResponse('All schools fetched succefully', $schools);
        }

        return $this->errorResponse('No  school found . create school ');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SchoolRequest $request)
    {

        $validated = $request->validated();

        if ($validated) {
            $school = School::create($validated);

            if ($school) {
                return $this->successResponse('school created successfully', $school);
            }

            return $this->errorResponse('Fail to create school try again');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(SchoolRequest $request, int $id)
    {
        $validated = $request->validated();

        $school  = School::find($id);

        if ($school) {
            $school->update($validated);
            return $this->successResponse('School updated successfully', $school);
        }

        return $this->errorResponse('No such  school found ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $school = School::find($id);

        if (!$school) {
            return $this->errorResponse('No such school from our server');
        }

        $school->delete();
        return $this->successResponse('School deleted successfully');
    }
}

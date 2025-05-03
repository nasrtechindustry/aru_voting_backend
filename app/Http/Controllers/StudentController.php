<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentChangePassword;
use App\Http\Requests\StudentdChangeProfileRequest;
use App\Imports\StudentImport;
use App\Models\User;
use App\Models\Program;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StudentImportRequest;
use App\Http\Resources\StudentResource;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Role;
use App\Models\User_Role;
use Illuminate\Http\Client\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $students = Student::with([
            'program:id,program_name,department_id',
            'program.department:id,department_name,school_id',
            'program.department.school:id,school_name',
            'user:id,first_name,middle_name,last_name,email,phone,profile'
        ])->latest()->get();

        return $this->successResponse('All students fetched successfully', StudentResource::collection($students));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStoreRequest $request)
    {
        try {


            $validated = $request->validated();


            DB::beginTransaction();


            $user = User::create([
                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => Hash::make('TANZANIA'),
            ]);


            if (!$user) {
                throw new \Exception('Fail to create user');
            }

            $role = Role::where('role_name', 'Voter')->first();

            $setRole = User_Role::create([
                'user_id' => $user->id,
                'role_id' => $role->id
            ]);

            if (!$setRole) {
                throw new \Exception('Fail to insert the role for student');
            }

            $program = Program::find($validated['program_id']);

            if (!$program) {
                throw new \Exception('The program id was not found');
            }

            $student = Student::create([
                'program_id' => $validated['program_id'],
                'year_id' => $validated['year'],
                'user_id' => $user->id,
                'registration_number' => $validated['registration_number'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date']
            ]);

            if (!$student) {
                throw new \Exception('Fail to register new student');
            }




            DB::commit();

            return $this->successResponse('Student created successfully', $student);
        } catch (\Exception $e) {

            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function import(StudentImportRequest $request)
    {
        $validated = $request->validated();

        if (!$request->hasFile('students') || !$request->file('students')->isValid()) {
            return $this->errorResponse('No valid file uploaded.');
        }

        $file = $request->file('students');


        try {
            Excel::import(new StudentImport($validated['program_id'], $validated['start_date'], $validated['end_date']), $file);

            return $this->successResponse('Students imported successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while importing students: ' . $e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, string $id)
    {
        try {
            $validated = $request->validated();


            DB::beginTransaction();

            $student = Student::find($id);
            if (!$student) {
                throw new \Exception('Student was not found');
            }


            $program = Program::find($validated['program_id']);
            if (!$program) {
                throw new \Exception('Program was not found');
            }


            $user = User::find($validated['user_id']);
            if (!$user) {
                throw new \Exception('User was not found');
            }

            $user->update([
                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
            ]);

            $student->update([
                'program_id' => $validated['program_id'],
                'user_id' => $user->id,
                'year_id' => $validated['year'],
                'registration_number' => $validated['registration_number'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date']
            ]);

            DB::commit();

            return $this->successResponse('Student updated successfully', $student);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $student = Student::find($id);

            if (!$student) {
                throw new \Exception('student not found');
            }

            $user = User::find($student->user->id);

            if (!$user) {
                throw new \Exception('User was not found');
            }

            $user->delete();

            return $this->successResponse('Student deleted successully');
        } catch (\Exception $th) {

            return $this->errorResponse($th->getMessage());
        }
    }

    public function count()
    {
        return $this->successResponse('Total departments', Student::count('id'), 200);
    }
    public function changeStudentPassword(StudentChangePassword $request)
    {
        try {
            $validated = $request->validated();

            $user = User::find($validated['user_id']);

            if (!$user) {
                throw new \Exception('User was not found');
            }

            $user->update([
                'password' => Hash::make($validated['password']),
            ]);

            return $this->successResponse('Password changed successfully');

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }


    public function changeStudentProfile(StudentdChangeProfileRequest $request){

        try {

            $validated = $request->validated() ; 

            $user = User::find($validated['user_id']);

            if(!$user) {
                throw new \Exception('user with that id was not found') ;
            }

            if($request->hasFile('profile')){

                $profile = $request->file('profile'); 
                $profile_name = now()->format('Ymd_His') . '_' . preg_replace('/\s+/', '_', $profile->getClientOriginalName());
                $path = $profile->storeAs('profiles', $profile_name, 'public');

                
                
                $user->update([
                    'profile' => $path
                ]);

                return $this->successResponse('Student profile was updated successfully');
            }

        } catch (\Exception $e) {
            

            return $this->errorResponse($e->getMessage());
        }

    }
}

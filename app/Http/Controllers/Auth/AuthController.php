<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\User_Role;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use App\Models\Student;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $username = $validated['username'];
        $password = $validated['password'];

        // 1. Handle users with roles (admin, leader, etc.)
        if ($request->has('role')) {
            $user = User::where('email', $username)->first();

            if (!$user || !Hash::check($password, $user->password)) {
                return $this->errorResponse('Wrong username or password. Please try again!');
            }

            $userRole = User_Role::where('user_id', $user->id)->first();

            if (!$userRole || !$userRole->role) {
                return $this->errorResponse('User role not found.', 403);
            }

            $user['role'] = $userRole->role->role_name;
            $user['token'] = $user->createToken('voting_auth')->plainTextToken;

            return $this->successResponse('Login successfully', $user, 201);
        }

        // 2. Handle students logging in with registration number
        $student = Student::with('user')->where('registration_number', $username)->first();

        if (!$student || !$student->user || !Hash::check($password, $student->user->password)) {
            return $this->errorResponse('Wrong username or password. Please try again!');
        }

        $studentUser = $student->user;
        $studentUser['role'] = 'voter';
        $studentUser['token'] = $studentUser->createToken('voting_auth')->plainTextToken;

        return $this->successResponse('Login successfully', $studentUser, 201);
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return $this->successResponse('Logged out successfully.');
    }

    public function check_email(Request $request)
    {
        $emailExists = User::where('email', $request->email)->exists();

        if ($emailExists) {
            return response()->json(['exists' => true,], 200);
        } else {
            return response()->json(['exixts' => false,], 404);
        }
    }
}

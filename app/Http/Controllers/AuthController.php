<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function validator(Request $request)
    {
        $token = $request->bearerToken();
        if (empty($token)) {
            return response()->json(['status' => false, 'message' => 'You are not authenticated.'], 401);
        }

        if (!Auth::user()->tokens()) {
            return response()->json(['status' => false, 'message' => 'Your session has ended or expired. Please login again.'], 419);
        }

        return response()->json(['status' => 'success', 'user' => new UserResource(Auth::user())], 200);
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->getCredentials();
            if (!Auth::validate($credentials)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Username & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->username)->first();
            return response()->json([
                'status' => true,
                'message' => 'User logged in successfully',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'status' => $user->status,
                    'roles' => $user->roles()->get()->pluck("name")->first(),
                    'token' => $user->createToken(Hash::make($user->email))->plainTextToken,
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        try {
            Auth::user()->tokens()->delete();
            return response()->json([
                'status' => true,
                'message' => 'User logged out successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => bcrypt($request->password),
                'status' => true,
            ]);
            $user->syncRoles('parent');
            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
            ]);
        } catch (\Throwable $th) {
            if ($th->getCode() == 23000) {
                return response()->json([
                    'success' => false,
                    'message' => 'Registration failed because the email it already exists',
                ], 400);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $th->getMessage(),
                ], 400);
            }
        }
    }
}

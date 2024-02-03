<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        switch (auth()->user()->roles()->get()->pluck('name')->first()) {
            case 'admin':
                $users = User::where('id', '!=', auth()->user()->id)->get();
                break;

            case 'canteen-worker':
                $users = User::role('canteen-worker')->where('id', '!=', auth()->user()->id)->get();
                break;

            default:
                $users = [];
                break;
        }
        return response()->json([
            'success' => true,
            'data' => UserResource::collection($users),
        ], 200);
    }

    public function create(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => bcrypt($request->password),
                'status' => $request->status,
            ]);
            $user->assignRole($request->role);
            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    public function edit(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            return response()->json([
                'success' => true,
                'data' => new UserResource($user),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    public function update(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $user->update([
                'name' => $request->name,
                'status' => $request->status,
            ]);
            if (!empty($request->password)) {
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
            }
            $user->syncRoles([$request->role]);
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $user->delete();
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }
}

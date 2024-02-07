<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => StudentResource::collection(auth()->user()->students),
        ], 200);
    }

    public function create(Request $request)
    {
        try {
            $student = Student::create([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'year_level' => $request->year_level,
                'class_name' => $request->class_name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Child created successfully',
            ], 200);
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
            $data = auth()->user()->students()->where('id', $request->id)->firstOrFail();
            return response()->json([
                'success' => true,
                'data' => StudentResource::make($data),
            ], 200);
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
            $student = auth()->user()->students()->where('id', $request->id)->firstOrFail();
            $student->update([
                'name' => $request->name,
                'year_level' => $request->year_level,
                'class_name' => $request->class_name,
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
            $student = auth()->user()->students()->where('id', $request->id)->firstOrFail()->delete();
            return response()->json([
                'success' => true,
                'message' => 'Child deleted successfully',
            ], 200);
        } catch (\Throwable $th) {
            if ($th->getCode() == 23000) {
                return response()->json([
                    'success' => false,
                    'message' => 'Child cannot be deleted because it has related reservation data',
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

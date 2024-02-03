<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => auth()->user()->students,
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
                'message' => 'Student created successfully',
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
            return response()->json([
                'success' => true,
                'data' => auth()->user()->students()->where('id', $request->id)->firstOrFail(),
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
            $student = auth()->user()->students()->where('id', $request->id)->firstOrFail();
            $student->delete();
            return response()->json([
                'success' => true,
                'message' => 'Student deleted successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }
}

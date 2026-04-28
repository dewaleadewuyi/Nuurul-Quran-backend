<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student; // <--- Make sure this is here!

class StudentController extends Controller
{
    // 1. GET STUDENTS (Simplified)
  // 1. GET ALL STUDENTS (Debug Version)
    public function index()
    {
        try {
            // Try to get students
            return \App\Models\Student::all();
        } catch (\Exception $e) {
            // If it crashes, tell us WHY
            return response()->json([
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    // 2. REGISTER STUDENT
    public function store(Request $request)
    {
        // Simple validation
        $fields = $request->validate([
            'student_name' => 'required|string',
            'parent_name' => 'nullable|string',
            'age' => 'required|integer',
            'program' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
        ]);

        // Create
        $student = Student::create($fields);

        // Return
        return response()->json([
            'message' => 'Success',
            'student' => $student
        ], 201);
    }


    // 3. DELETE STUDENT
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();

        return response()->json(['message' => 'Student deleted successfully'], 200);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index', ['students' => Student::with('department')->get()]);
    }

    public function create()
    {
        return view('students.create', ['departments' => Department::all()]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'dob' => 'required|date',
                'address' => 'required',
                'department_id' => 'required|exists:departments,id'
            ]);

            Student::create($request->all());
            return response()->json([
                'status' => '1',
                'message' => 'Student Data Saved Successfully...',
                'data' => [],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Student Data Saved Failed...',
                'data' => [],
            ]);
        }
    }

    public function edit(Student $student)
    {
        return view('students.edit', [
            'student' => $student,
            'departments' => Department::all()
        ]);
    }

    public function update(Request $request, Student $student)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'dob' => 'required|date',
                'address' => 'required',
                'department_id' => 'required|exists:departments,id'
            ]);

            $student->update($request->all());
            return response()->json([
                'status' => '1',
                'message' => 'Student Data Updated Successfully...',
                'data' => [],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Student Data Updated Failed...',
                'data' => [],
            ]);
        }
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index');
    }

}

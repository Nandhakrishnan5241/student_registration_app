<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('departments.index', ['departments' => Department::all()]);
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:departments',
                'course' => 'required'
            ]);

            Department::create($request->all());
            return response()->json([
                'status' => '1',
                'message' => 'Department Data Saved Successfully...',
                'data' => [],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Departement Data Saved Failed...',
                'data' => [],
            ]);
        }
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        try {
            $request->validate([
                'name' => 'required|unique:departments,name,' . $department->id,
                'course' => 'required'
            ]);

            $department->update($request->all());
            return response()->json([
                'status' => '1',
                'message' => 'Department Data Updated Successfully...',
                'data' => [],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Department Data Updated Failed...',
                'data' => [],
            ]);
        }
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index() {
        return view('departments.index', ['departments' => Department::all()]);
    }

    public function create() {
        return view('departments.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:departments',
            'course' => 'required'
        ]);

        Department::create($request->all());
        return redirect()->route('departments.index');
    }

    public function edit(Department $department) {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department) {
        $request->validate([
            'name' => 'required|unique:departments,name,' . $department->id,
            'course' => 'required'
        ]);

        $department->update($request->all());
        return redirect()->route('departments.index');
    }

    public function destroy(Department $department) {
        $department->delete();
        return redirect()->route('departments.index');
    }
}

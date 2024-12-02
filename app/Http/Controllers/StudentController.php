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
                'message' => 'Students Data Saved Successfully...',
                'data' => [],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Studa Data Saved Failed...',
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
                'message' => 'Students Data Updated Successfully...',
                'data' => [],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Students Data Updated Failed...',
                'data' => [],
            ]);
        }
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index');
    }

    public function getDetails(Request $request)
    {
        $columns = ['id', 'first_name','last_name','dob','address','department'];
        $limit   = $request->input('length', 10);
        $start   = $request->input('start', 0);
        $search  = $request->input('search')['value'];

        $query = Student::query();
        dd($query);

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%');
            });
        }

        $orderColumnIndex = $request->input('order.0.column');
        $orderDirection = $request->input('order.0.dir');

        if ($orderColumnIndex !== null) {
            $orderColumn = $columns[$orderColumnIndex];
            $query->orderBy($orderColumn, $orderDirection);
        }

        $datas = $query->skip($start)->take($limit)->get();

        $data = $datas->map(function ($data) {
            $editAction = '<a href="#" class="btn text-dark" data-id="' . $data->id . '" onclick="editData(' . $data->id . ')"><i class="fa-solid fa-pen-to-square"></i></a>';

            $deleteAction = '<a href="#" class="btn text-dark" data-id="' . $data->id . '" onclick="deleteData(' . $data->id . ')"><i class="fa-solid fa-trash"></i></a>';

            return [
                'id' => $data->id,
                'first_name' => $data->first_name,
                'last_name' => $data->name,
                'dob' => $data->dob,
                'address' => $data->address,
                'department' => $data->department,
                'action' => $editAction . $deleteAction,
            ];
        });

        $totalRecords = Student::count();
        $filteredRecords = $query->count();

        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ]);
    }
}

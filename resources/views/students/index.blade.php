
@extends('layouts.app')

@section('title', 'Students')

@vite(['resources/js/students.js'])

@section('content')
<a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Add Student</a>

<table class="table table-striped table-responsive" id="studentsTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>DOB</th>
            <th>Address</th>
            <th>Department</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->first_name }}</td>
            <td>{{ $student->last_name }}</td>
            <td>{{ $student->dob }}</td>
            <td>{{ $student->address }}</td>
            <td>{{ $student->department->name }}</td>
            <td>
                <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection


@extends('layouts.app')

@section('title', 'Departments')

@vite(['resources/js/departments.js'])

@section('content')
<a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Add Department</a>

<table class="table table-striped table-responsive" id="departmentTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Course</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departments as $department)
        <tr>
            <td>{{ $department->id }}</td>
            <td>{{ $department->name }}</td>
            <td>{{ $department->course }}</td>
            <td>
                <a href="{{ route('departments.edit', $department) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('departments.destroy', $department) }}" method="POST" class="d-inline">
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

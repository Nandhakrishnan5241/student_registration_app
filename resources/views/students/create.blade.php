
@extends('layouts.app')

@section('title', 'Add Student')

@vite(['resources/js/students.js'])

@section('content')
<form action="{{ route('students.store') }}" method="POST" class="card p-4" id="addStudentForm">
    @csrf
    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter first name" required>
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter last name" required>
    </div>
    <div class="mb-3">
        <label for="dob" class="form-label">Date of Birth</label>
        <input type="date" name="dob" class="form-control" id="dob" required>
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea name="address" class="form-control" id="address" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="department_id" class="form-label">Department</label>
        <select name="department_id" class="form-select" id="department_id" required>
            <option value="" disabled selected>Select a role</option>
            @foreach ($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" style="float:right;" class="btn btn-primary">Save</button>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection

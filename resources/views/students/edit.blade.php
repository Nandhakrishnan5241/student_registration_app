
@extends('layouts.app')

@section('title', 'Edit Student')

@vite(['resources/js/students.js'])

@section('content')
<form action="{{ route('students.update', $student) }}" method="POST" class="card p-4" id="editStudentForm">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" name="first_name" class="form-control" id="first_name" value="{{ $student->first_name }}" required>
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" name="last_name" class="form-control" id="last_name" value="{{ $student->last_name }}" required>
    </div>
    <div class="mb-3">
        <label for="dob" class="form-label">Date of Birth</label>
        <input type="date" name="dob" class="form-control" id="dob" value="{{ $student->dob }}" required>
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea name="address" class="form-control" id="address" rows="3" required>{{ $student->address }}</textarea>
    </div>
    <div class="mb-3">
        <label for="department_id" class="form-label">Department</label>
        <select name="department_id" class="form-select" id="department_id" required>
            @foreach ($departments as $department)
            <option value="{{ $department->id }}" @if($department->id == $student->department_id) selected @endif>
                {{ $department->name }}
            </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection

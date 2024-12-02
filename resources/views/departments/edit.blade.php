
@extends('layouts.app')

@section('title', 'Edit Department')

@vite(['resources/js/departments.js'])

@section('content')
<form action="{{ route('departments.update', $department) }}" method="POST" class="card p-4" id="editDepartmentForm">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Department Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ $department->name }}" required>
    </div>
    <div class="mb-3">
        <label for="course" class="form-label">Course</label>
        <input type="text" name="course" class="form-control" id="course" value="{{ $department->course }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('departments.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection


@extends('layouts.app')

@section('title', 'Add Department')

@vite(['resources/js/departments.js'])

@section('content')
<form action="{{ route('departments.store') }}" method="POST" class="card p-4" id="addDepartmentForm">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Department Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Enter department name" >
    </div>
    <div class="mb-3">
        <label for="course" class="form-label">Course</label>
        <input type="text" name="course" class="form-control" id="course" placeholder="Enter course" >
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('departments.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection

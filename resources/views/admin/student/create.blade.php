@extends('layouts.master')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h1 mb-0 text-gray-800">STUDENT</h1>
</div>
<div class="card" style="margin: 0px auto; width: 30rem; padding: 40px;">
    <h3 style="text-align:center; font-weight: bold;">Add New Student</h3>
    <form method="post" action="{{url('/students/store')}}">
        @csrf
        <div class="form-group">
            <label for="inputName">Student Name</label>
            <input type="string" class="form-control @error('student_name') is-invalid @enderror" id="student_name" name="student_name" placeholder="Student Name">
            @error('student_name')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputStatus">Gender</label>
            <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                <option>Select gender</option>
                <option>Male</option>
                <option>Female</option>
            </select>
            @error('gender')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputName">Phone Number</label>
            <input type="string" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" placeholder="Phone number">
            @error('phone_number')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputName">Address</label>
            <input type="string" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Address">
            @error('address')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputStatus">Class</label>
            <select name="class_id" class="form-control @error('class_id') is-invalid @enderror">
                @foreach($data as $field)
                    <option value="{{ $field->id }}">{{ $field->class_name }}</option>
                @endforeach
            </select>
            @error('class_id')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
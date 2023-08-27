@extends('layouts.master')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h1 mb-0 text-gray-800">ATTENDANT</h1>
</div>
<div class="card" style="margin: 0px auto; width: 30rem; padding: 40px;">
    <h3 style="text-align:center; font-weight: bold;">Add New Attendant</h3>
    <form method="post" action="{{url('/attendants/store')}}">
        @csrf
        
        <div class="form-group">
            <label for="inputStudentName">Select, student Name</label>
            <select name="student_name" class="form-control @error('student_name') is-invalid @enderror">
                @foreach($students as $student)
                    <option value="{{$student->id}}">{{ $student->student_name }}</option>
                @endforeach
            </select>
            @error('student_name')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="attendant">Attendant</label>
            <div class=" col-md-12">
                
                <span class="col-md-4">
                    <label class="radio-inline"><input type="radio" name="attendant" value="Yes">Yes</label>
                </span>
                <span class="col-md-4">
                    <label class="radio-inline"><input type="radio" name="attendant" value="No">No</label>
                </span>
            </div>
            @error('attendant')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
           
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection

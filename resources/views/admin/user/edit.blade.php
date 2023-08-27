@extends('layouts.master')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h1 mb-0 text-gray-800">USER</h1>
</div>
<div class="card" style="margin: 0px auto; width: 30rem; padding: 40px;">
    <h3 style="text-align:center; font-weight: bold;">Edit New User</h3>
    <form method="post" action="{{url('/users/update')}}/{{$user->id}})}}">
        @csrf
        <div class="form-group">
            <label for="inputName">First Name</label>
            <input type="string" value="{{ $user->first_name }}" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" placeholder="First Name">
            @error('first_name')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputName">Last Name</label>
            <input type="string" value="{{ $user->last_name }}" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" placeholder="Student Name">
            @error('last_name')
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
            <label for="inputName">Email</label>
            <input type="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="E-mail" readonly>
            @error('email')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputName">Phone Number</label>
            <input type="string" value="{{ $user->phone_number }}" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" placeholder="Phone number">
            @error('phone_number')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputName">Address</label>
            <input type="string" value="{{ $user->address }}" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Address">
            @error('address')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputRole">Role</label>
            <select name="role" class="form-control @error('role') is-invalid @enderror">
                <option>Select user role</option>
                <option>Admin</option>
                <option>Teacher</option>
                <option>Student</option>
            </select>
            @error('role')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
@section('script')
    <script>
        document.getElementsByName('gender')[0].value = "{{ $user->gender}}";
        document.getElementsByName('role')[0].value = "{{ $user->role}}";
    </script>
@endsection
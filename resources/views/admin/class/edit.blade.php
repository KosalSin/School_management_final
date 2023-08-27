@extends('layouts.master')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h1 mb-0 text-gray-800">CLASS</h1>
</div>
<div class="card" style="margin: 0px auto; width: 30rem; padding: 40px;">
    <h3 style="text-align:center; font-weight: bold;">Edit Class</h3>
    <!-- @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif -->
    <form method="post" action="{{url('/classes/update')}}/{{$clas->id}}}}">
        @csrf
        <div class="form-group">
            <label for="inputName">Class Name</label>
            <input type="string" class="form-control @error('class_name') is-invalid @enderror" id="class_name" name="class_name" value="{{ $clas->class_name }}" placeholder="Class Name">
            @error('class_name')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputStatus">Status</label>
            <select name="status" class="form-control @error('status') is-invalid @enderror">
                
                    <!-- <option value="{{ $clas->status }} selected">{{$clas->status}}</option> -->
                    <option>Select Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                
            </select>
            @error('status')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    document.getElementsByName('status')[0].value = "{{ $clas->status}}";
</script>
@endsection
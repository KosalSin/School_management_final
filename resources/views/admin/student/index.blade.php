@extends('layouts.master')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">STUDENT</h1>
    <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">New Class</button> -->
    <a href="{{route('create-student')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Create New Student</a>
    <!-- <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i>Add Category</button> -->
</div>
<form action="{{url('/students')}}">
    <div class="input-group">
        <input name="queryString" class="form-control " value="{{$queryString}}" required/>
        <div class="input-group-append">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
        </div>
    </div>
</form>
@if($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            <th scope="col">Class</th>
            <th scope="col">Created By</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($students) > 0)
            @foreach ($students as $student)
            <tr>
                <td>{{$student->id}}</td>
                <td>{{$student->student_name}}</td>
                <td>{{$student->gender}}</td>
                <td>{{$student->phone_number}}</td>
                <td>{{$student->address}}</td>
                <td>{{$student->class->class_name}}</td>
                <td>{{$student->created_by}}</td>
                <td colspan="2">
                    <a href="/students/edit/{{$student->id}}" class="btn btn-primary btn-sm">Edit</a>
                   
                    <button type="button" name="delete" id="delete" value="{{$student->id}}" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmModal">Delete</button>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
				<td colspan="5" class="text-center">No Data Found</td>
			</tr>
        @endif
    </tbody>
</table>
 {{ $students->links() }}
@endsection
@section('script')
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup
            ({
   			 headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   			 }
			});
            // Delete button
            var student_id;

			$(document).on('click', '.delete', function(){
				student_id = $(this).val();
				$('.modal-title').text('Delete Record');
			});
            $('#ok_button').click(function(){
				$.ajax({
					url:"students/destroy/"+student_id,
					beforeSend:function(){
						$('#ok_button').text('Deleting...');
					},
					success:function(data)
					{
                        alert('Data Deleted');
                        window.location.reload();
                        
					}
				})
			});

        });
    </script>
@endsection
<!-- Logout Modal-->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Data?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to remove this data?</div>
                <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@extends('layouts.master')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">CLASS</h1>
    <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">New Class</button> -->
    <a href="{{route('create-class')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Create New Class</a>
    <!-- <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i>Add Category</button> -->
</div>
<form action="{{url('/classes')}}">
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
            <th scope="col">ClassName</th>
            <th scope="col">Status</th>
            <th scope="col">Created By</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($classes) > 0)
            @foreach ($classes as $clas)
            <tr>
                <td>{{$clas->id}}</td>
                <td>{{$clas->class_name}}</td>
                <td>{{$clas->status}}</td>
                <td>{{$clas->created_by}}</td>
                <td colspan="2">
                    <a href="/classes/edit/{{$clas->id}}" class="btn btn-primary btn-sm">Edit</a>
                    <!-- <a href="/classes/delete/{{$clas->id}}" class="btn btn-danger">Delete</a> -->
                    <!-- <a class="delete btn btn-danger" href="#" data-toggle="modal" data-target="#confirmModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Delete
                    </a> -->
                    <button type="button" name="delete" id="'+data.id+'" value="{{$clas->id}}" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmModal">Delete</button>
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
 {{ $classes->links() }}
@endsection
@section('script')
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup
            ({
   			 headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   			 }
			});
            // Delete button
            var class_id;

			$(document).on('click', '.delete', function(){
				class_id = $(this).val();
				$('.modal-title').text('Delete Record');
				//$('#confirmModal').modal('show');
                //alert(class_id);
			});
            $('#ok_button').click(function(){
				$.ajax({
					url:"classes/destroy/"+class_id,
					beforeSend:function(){
						$('#ok_button').text('Deleting...');
					},
					success:function(data)
					{
                        window.location.reload();
                        //$(location).attr('href','http://127.0.0.1:8000/classes')
						// setTimeout(function(){
						// 	$('#confirmModal').modal('hide');
						// 	alert('Data Deleted');
						// }, 2000);
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
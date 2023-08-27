@extends('layouts.master')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">ATTENDANT</h1>
    <a href="{{route('attendant.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Create New Attendant</a>
</div>
<form action="{{url('/attendants')}}">
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
            <th scope="col">Student Name</th>
            <th scope="col">Attendant</th>
            <th scope="col">Attendant Date</th>
            <th scope="col">Created By</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($attendants) > 0)
            @foreach ($attendants as $attendant)
            <tr>
                <td>{{$attendant->id}}</td>
                <td>{{$attendant->student->student_name}}</td>
                <td>{{$attendant->attendant}}</td>
                <td>{{$attendant->tran_date}}</td>
                <td>{{$attendant->created_by}}</td>
                <td colspan="2">
                    <a href="/attendants/edit/{{$attendant->id}}" class="btn btn-primary btn-sm">Edit</a>
                    
                    <button type="button" name="delete" id="'+data.id+'" value="{{$attendant->id}}" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmModal">Delete</button>
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
 {{ $attendants->links() }}
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
            var attendant_id;

			$(document).on('click', '.delete', function(){
				attendant_id = $(this).val();
				$('.modal-title').text('Delete Record');
				
			});
            $('#ok_button').click(function(){
				$.ajax({
					url:"attendants/destroy/"+attendant_id,
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
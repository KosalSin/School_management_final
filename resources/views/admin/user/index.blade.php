@extends('layouts.master')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">USER</h1>
    
    <a href="{{route('user.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Create New User</a>
    
</div>
<form action="{{url('/users')}}">
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
            <th scope="col">FirstName</th>
            <th scope="col">LastName</th>
            <th scope="col">Email</th>
            <th scope="col">Gender</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            <th scope="col">Role</th>
            <th scope="col">CreatedBy</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($users) > 0)
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->first_name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->gender}}</td>
                <td>{{$user->phone_number}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->created_by}}</td>
                <td colspan="2">
                    <a href="/users/edit/{{$user->id}}" class="btn btn-primary btn-sm">Edit</a>
                    <button type="button" name="delete" id="delete" value="{{$user->id}}" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmModal">Delete</button>
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
 {{ $users->links() }}
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
            var user_id;

			$(document).on('click', '.delete', function(){
				user_id = $(this).val();
				$('.modal-title').text('Delete Record');
			});
            $('#ok_button').click(function(){
				$.ajax({
					url:"users/destroy/"+user_id,
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
@extends('layouts.admin_layout')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.admin_side_navbar')
       </div>
       <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <div class="panel-body">
                	@if(count($users) != 0)
                	<table class="table">
                		<tr>
                			<td>SL</td>
                			<td>User Name</td>
                			<td>User Email</td>
                			<td>Action</td>
                		</tr>
            
                	 @php $i=1; @endphp
                	@foreach($users as $user)
                	<tr>
                			<td>{{$i}}</td>
                			<td>{{$user->name}}</td>
                			<td>{{$user->email}}</td>
                			<td><a href="{{route('view_user_info',['id'=>$user->id])}}" class="btn btn-primary">View</a>|<a href="{{route('edit_user_info',['id'=>$user->id])}}" class="btn btn-success">Edit</a>|<a href="{{route('delete_user_info',['id'=>$user->id])}}" class="btn btn-danger">Delete</a></td>
                		</tr>
                		@php $i++; @endphp
                	@endforeach
                	@endif
                	    	</table>
                        {{ $users->links() }}
                </div>
            </div>

          </div>
    </div>
  </div>
@endsection
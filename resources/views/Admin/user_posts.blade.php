@extends('layouts.admin_layout')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.admin_side_navbar')
       </div>
       <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Posts</div>
                <div class="panel-body">
                	@if(count($posts) != 0)
                	<table class="table">
                		<tr>
                			<td>Image/Name</td>
                			<td>Title</td>
                      <td style="width: 50%;">Details</td>
                			<td>Rent</td>
                			<td>Action</td>
                		</tr>
            
                	 @php $i=1; @endphp
                	@foreach($posts as $post)
                	<tr>
                			<td><img style="height: 50px;width: 50px;border-radius: 50%;" src="{{url('storage/app/public/user_image/'.$post->user->id.'.jpg')}}"> {{$post->user->name}}</td>
                			<td>{{$post->title}}</td>
                      <td>{{$post->details}}</td>
                			<td>{{$post->rent}}</td>
                			<td><a href="{{route('view_user_post',['id'=>$post->id])}}" class="btn btn-primary">View</a>|<a href="{{route('delete_user_post',['id'=>$post->id])}}" class="btn btn-danger">Delete</a></td>
                		</tr>
                		@php $i++; @endphp
                	@endforeach
                	@endif
                	    	</table>
                     
                </div>
            </div>

          </div>
    </div>
  </div>
@endsection
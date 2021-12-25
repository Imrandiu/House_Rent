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
                	@if(count($posts) > 0)
                	<table class="table">
                		<tr>
                		      <td >User</td>
                			<td>Image/Name</td>
                			
                			<td>Title</td>
                      <td style="width: 40%;">Details</td>
                			<td>Approved</td>
                			<td>Action</td>
                		</tr>
            
                	 @php $i=1; @endphp
                	@foreach($posts as $post)
                	<tr>
                	    	 <td>{{$post->user_id}}</td>
                			<td>
                			    @if($post->user->photo)
                			    <img style="height: 50px;width: 50px;border-radius: 50%;" src="{{url('storage/app/public/user_image/'.$post->user->photo)}}">
                			    @else
                			     <img style="height: 50px;width: 50px;border-radius: 50%;" src="{{url('public/unknown.png')}}">
                			    @endif
                			    {{$post->user->name}}</td>
                		
                			<td>{{$post->title}}</td>
                      <td>{{$post->details}}</td>
                       
                      
                			<td>
                			    @if($post->approve == 'true')
                			    <a href="{{route('deactive_post',['id'=>$post->id])}}" class="btn btn-primary">{{$post->approve}}</a>
                			    @else
                			    <a href="{{route('approve_post',['id'=>$post->id])}}" class="btn btn-danger">{{$post->approve}}</a>
                			    @endif
                			    </td>
                			
                			
                			<td><a href="{{route('view_user_post',['id'=>$post->id])}}" class="btn btn-primary">View</a>|<a href="{{route('delete_user_post',['id'=>$post->id])}}" class="btn btn-danger">Delete</a></td>
                		</tr>
                		@php $i++; @endphp
                	@endforeach
                	@endif
                	    	</table>
                        {{ $posts->links() }}
                </div>
            </div>

          </div>
    </div>
  </div>
@endsection
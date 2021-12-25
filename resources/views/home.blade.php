@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-2" style="margin-top: 12%;">
           @include('layouts.side_navbar')
       </div>
       <div class="col-md-10">
        <div class="row">

        @if($posts->count()>0)
          @foreach($posts as $post)
            <div class="col-md-6">
              <div class="panel panel-default">
                  <a href="{{route('view_details',['id'=>$post->id])}}" style="color: black;">
              <div class="row" style="margin-left: -5px;margin-top: 12px;" >
                <div class="col-md-4" >
                  <img style="width: 100%;" src="{{url('storage/app/public/post_image/a'.$post->id.'.jpg')}}">
                </div>
                <div class="col-md-8">
                  <h1>{{$post->title}}</h1>
                  <p>{{$post->address}}</p>
                  <p>Tk : {{$post->rent}}</p>
                  <a href="{{route('edit_post',['id'=>$post->id])}}" style="color: green"><i class="fa fa-edit"></i></a> <a href="{{route('delete_post',['id'=>$post->id])}}" style="color: red;margin-left: 30%;"><i class="fa fa-trash"></i></a>
                </div>
              </div>
              </a>
           </div>
            </div>
         @endforeach
         @endif

        </div>           
       </div>
   </div>
</div>
@endsection



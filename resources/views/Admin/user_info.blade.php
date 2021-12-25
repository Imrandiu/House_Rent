@extends('layouts.admin_layout')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.admin_side_navbar')
       </div>
       <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{$user_info->name}} Information</div>
                <div class="panel-body">
                   <h1 style="text-align: center;">
                     <img style="height: 150px;width: 150px;border-radius: 50%;" src="{{url('storage/app/public/user_image/'.$user_info->id.'.jpg')}}">
                   </h1>
                	<table class="table">
                		<tr>
                			<td>Name : </td>
                			<td>{{$user_info->name}}</td>
                		</tr>
                    <tr>
                      <td>Email : </td>
                      <td>{{$user_info->email}}</td>
                    </tr>
                    <tr>
                      <td>Phone No : </td>
                      <td>{{$user_info->phone_no}}</td>
                    </tr>
                    <tr>
                      <td>Address : </td>
                      <td>{{$user_info->address}}</td>
                    </tr>
                    <tr>
                      <td>Optional Phone : </td>
                      <td>{{$user_info->optional_phone}}</td>
                    </tr>
                    <tr>
                      <td>Optional Email : </td>
                      <td>{{$user_info->optional_email}}</td>
                    </tr>
                    <tr>
                      <td>Account Open DateTime : </td>
                      <td>{{$user_info->created_at}}</td>
                    </tr>
                	    	</table>
                </div>
            </div>

          </div>
    </div>
  </div>
@endsection
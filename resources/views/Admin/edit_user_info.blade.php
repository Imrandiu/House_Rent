@extends('layouts.admin_layout')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.admin_side_navbar')
       </div>
       <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{$user_info->name}} Information Edit</div>
                <div class="panel-body">
                  <form action="{{route('edit_user_info',['id'=>$user_info->id])}}" method="post">
                    {{csrf_field()}}
                	<table class="table">
                		<tr>
                			<td>Name : </td>
                			<td><input type="text" class="form-control" name="name" value="{{$user_info->name}}" required="true"></td>
                		</tr>
                    <tr>
                      <td>Email : </td>
                      <td><input type="email" class="form-control" name="email" value="{{$user_info->email}}" required="true"></td>
                    </tr>
                    <tr>
                      <td>Phone No : </td>
                      <td><input type="text" class="form-control" name="phone_no" value="{{$user_info->phone_no}}" required="true"></td>
                    </tr>
                    <tr>
                      <td>Address : </td>
                      <td><input type="text" class="form-control" name="address" value="{{$user_info->address}}"></td>
                    </tr>
                    <tr>
                      <td>Optional Phone : </td>
                      <td><input type="text" class="form-control" name="optional_phone" value="{{$user_info->optional_phone}}"></td>
                    </tr>
                    <tr>
                      <td>Optional Email : </td>
                      <td><input type="text" name="optional_email" value="{{$user_info->optional_email}}" class="form-control"></td>
                    </tr>
                    <tr>
                      <td> </td>
                      <td><input type="submit" class="btn btn-primary" value="Update"></td>
                    </tr>
                	    	</table>
                        </form>
                </div>
            </div>

          </div>
    </div>
  </div>
@endsection
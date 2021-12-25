
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Payment</div>

                <div class="panel-body">
                     
                    	<form action="{{url('/save_payment')}}" method="post" enctype='multipart/form-data'>
				{{ csrf_field() }}
				<input type="hidden" name="post_id" value="{{$post->id}}">
				<table style="width: 100%;" id="input_table">
				    
				    <tr>
						<td><label>Name :</label></td>
						<td><input type="text" class="form-control" name="name" required="true" value=""><br></td>
					</tr>
				    
					<tr>
						<td><label>Select Title : </label></td>
						<td><select class="form-control" id="title" name="title" onchange="insert_row()" required="true">
						<option value="Bkash">Bkash</option>
						<option value="Dutch Bangla" >Dutch Bangla</option>
						<option value="Mobi Cash" >Mobi Cash</option>
						<option value="Others">Others</option>
					</select><br></td>
					</tr>
					<tr>
						<td><label>Mobile :</label></td>
						<td><input type="mobile" class="form-control" name="phone" required="true"  value=""></textarea><br></td>
					</tr>
					<tr>
						<td><label>Transaction No :</label></td>
						<td><input type="text" class="form-control" name="transaction" required="true"></textarea><br></td>
					</tr>
					
					<tr>
						<td><label>Taka :</label></td>
						<td><input type="number" class="form-control" name="taka" required="true"></textarea><br></td>
					</tr>
					<tr>
						<td><label>Email :</label></td>
						<td><input type="email" class="form-control" name="email" required="true"  value="" required></textarea><br></td>
						  @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
					
					</tr>
					<tr>
					    	<td><label>Present Address :</label></td>
						<td><input type="text" class="form-control" name="present_address"  required><br></td>
					</tr>
					
						<tr>
					    	<td><label>Upload NID copy :</label></td>
						<td><input type="file" class="form-control" name="nid"  required><br></td>
					</tr>
					
				
					
				</table>
				<div class="col-md-12"><br>
					<input type="submit" class="btn btn-lg btn-primary" style="float: right;margin-bottom: 15px;margin-left: -50px;" name="submit">
				</div>
			
			</form>
                </div>
            </div>
        </div>
    </div>
    
   
</div>
@endsection
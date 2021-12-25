@extends('layouts.app')

@section('content')
<style type="text/css">
	.image_up:hover {
  -ms-transform: scale(1.1); /* IE 9 */
  -webkit-transform: scale(1.1); /* Safari 3-8 */
  transform: scale(1.1); 
}
</style>
 <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgCefzWt_NswmzoByfs8vgvL3BPikDDD8&callback=initMap"
  type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>
<script>var la={{$data->lat}}; var lo={{$data->longi}};</script>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1" style="background-color: white">
			<div class="row">
				<div class="col-md-12">
			<h2>Post Your Recurement for Rent </h2>
			<form action="{{route('submit_update_post')}}" method="post" enctype='multipart/form-data'>
				{{ csrf_field() }}
				<input type="hidden" name="post_id" value="{{$data->id}}">
				<table style="width: 100%;" id="input_table">
					<tr>
						<td><label>Select Title : </label></td>
						<td><select class="form-control" id="title" name="title" onchange="insert_row()" required="true">
						<option value="{{$data->title}}">{{$data->title}}</option>
						<option value="Flat Rant">Flat Rent</option>
						<option value="Mes Rant" >Mes Rent</option>
						<option value="Roommat Need" >Roommate Need</option>
						<option value="Others">Others</option>
					</select><br></td>
					</tr>
					<tr>
						<td><label>Details :</label></td>
						<td><textarea cols="50" rows="10" class="form-control" name="details" required="true">{{$data->details}}</textarea><br></td>
					</tr>
					<tr style="display:none">
						<td><label>Address : </label></td>
						<td><input type="text" name="address" id="address" class="form-control" required="true" value="{{$data->address}}"><br></td>
					</tr>
					<tr style="display:none">
						<td><label>latitude : </label></td>
						<td><input type="text" name="lat" id="latitude" class="form-control" required="true" value="{{$data->lat}}"><br></td>
					</tr>
					<tr style="display:none">
						<td><label>Longititude : </label></td>
						<td><input type="text" name="longi" id="longitude" class="form-control" required="true" value="{{$data->longi}}"><br></td>
					</tr>
					<tr>
						<td><label>Conditions :</label></td>
						<td><textarea class="form-control" rows="10" name="conditions">{{$data->conditions}}</textarea><br></td>
					</tr>
					<tr>
						<td><label>Varatia Type : </label></td>
						<td><input type="radio"  name="family_bachelor" {{$data->family_bachelor=='Family' ? 'checked':''}} value="Family">&nbsp;Family &nbsp;&nbsp;<input type="radio" name="family_bachelor" value="Bachelor" {{$data->family_bachelor=='Bachelor' ?'checked':''}}>&nbsp;Bachelor <br><br><br></td>
					</tr>
                 @if($data->title == 'Flat Rant')
					<tr>
						<td><label>Number Of Room:</label></td>
						<td><input type="number" name="number_of_room" class="form-control" required="true" value="{{$data->number_of_room}}"><br></td>
					</tr>
					<tr>
						<td><label>Number Of Bath:</label></td>
						<td><input type="number" name="number_of_bath" class="form-control" required="true" value="{{$data->number_of_bath}}"><br></td>
					</tr>
					@elseif($data->title == 'Mes Rant'||$data->title == 'Others')
					<tr>
						<td><label>Number Of Room:</label></td>
						<td><input type="number" name="number_of_room" class="form-control" required="true" value="{{$data->number_of_room}}"><br></td>
					</tr>
					<tr>
						<td><label></label></td>
						<td></td>
					</tr>
					@else
                     <tr>
						<td><label>Number Of Roommat:</label></td>
						<td><input type="number" name="roommat_number" class="form-control" required="true"><br></td>
					</tr>
					<tr>
						<td><label></label></td>
						<td></td>
					</tr>
					@endif

					<tr>
						<td><label>Rent : </label></td>
						<td><input type="number" name="rent" class="form-control" required="" value="{{$data->rent}}"><br></td>
					</tr>
					
				</table>
				</div>
				<div class="col-md-12" style="margin-left: 56px;">
					@php $i=0; @endphp
					@foreach($images as $image)
					<div style="width:190px;height: 190px; background-color: #95959a;float: left;margin-left: 10px;position: relative; overflow: hidden;" class="image_up">
						<img src="{{url('storage/app/public/post_image/'.$image->image_name)}}" id="image{{$i}}" style="width: 100%;height: 100%">
					<input type="file" name="image{{$i}}"  style="font-size: 162px;opacity: 0;margin-top: -219px;" onchange="setImage(this,{{$i}})">
					</div>@php $i++; @endphp
					@endforeach
				</div>
				<script src="{{url('js/my_create_gmap.js')}}"></script>
					<div class="col-md-10"><br>
				<div id="myMap" style="width:100%;height:500px;"></div>
				</div>
				<div class="col-md-2"><br>
					<input type="submit" class="btn btn-lg btn-primary" style="float: right;margin-bottom: 15px;margin-left: -50px;">
				</div>
			</div>
				

				
			</form>
		</div>
	</div>
</div>
@endsection


<script type="text/javascript">
	function insert_row() {
		var title=document.getElementById("title").value;
		var x1 = document.getElementById("input_table").rows[5].cells;
		var x2 = document.getElementById("input_table").rows[6].cells;
		  if (title == 'Flat Rant') {
		  	x1[0].innerHTML ='<label>Number Of Room:</label>';
		    x1[1].innerHTML = '<input type="number" name="number_of_room" class="form-control" required="true"><br>';
		    x2[0].innerHTML ='<label>Number Of Bath:</label>';
		    x2[1].innerHTML = '<input type="number" name="number_of_bath" class="form-control" required="true"><br>';
		  }
		  if (title=='Mes Rant') {
		  	x1[0].innerHTML ='<label>Number Of Room:</label>';
		    x1[1].innerHTML = '<input type="number" name="number_of_room" class="form-control" required="true"><br>';
		    x2[0].innerHTML ='<input type="hidden">';
		    x2[1].innerHTML = '<input type="hidden">';
		  }
		  if (title=='Roommat Need') {
		  	x1[0].innerHTML ='<label>Number Of Roommat:</label>';
		    x1[1].innerHTML = '<input type="number" name="roommat_number" class="form-control" required="true"><br>';
		    x2[0].innerHTML ='<input type="hidden">';
		    x2[1].innerHTML = '<input type="hidden">';
		  }
		    if (title=='Sublet') {
		  	x1[0].innerHTML ='<input type="hidden">';
		    x1[1].innerHTML = '<input type="hidden">';
		    x2[0].innerHTML ='<input type="hidden">';
		    x2[1].innerHTML = '<input type="hidden">';
		  }
		  if (title=='Others') {
		  	x1[0].innerHTML ='<label>Number Of Room:</label>';
		    x1[1].innerHTML = '<input type="number" name="number_of_room" class="form-control" required="true"><br>';
		    x2[0].innerHTML ='<input type="hidden">';
		    x2[1].innerHTML = '<input type="hidden">';
		  }
		  
	}

	function setImage(input,div_id){
		 if (input.files && input.files[0]) {
           var reader = new FileReader();
           reader.onload = function(e) {
          $('#image'+div_id).attr('src', e.target.result);
          }
         reader.readAsDataURL(input.files[0]);
        }
       }
	
</script>
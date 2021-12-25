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

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1" style="background-color: white">
			<div class="row">
				<div class="col-md-12">
			<h2>Post Your Recurement for Rent </h2>
			<form action="{{route('submit_post')}}" method="post" enctype='multipart/form-data'>
				{{ csrf_field() }}
				<table style="width: 100%;" id="input_table">
					<tr>
						<td><label>Select Title : </label></td>
						<td><select class="form-control" id="title" name="title" onchange="insert_row()" required="true">
						<option value="Flat Rent">Flat Rent</option>
						<option value="Mess Rent" >Mess Rent</option>
						<option value="Roommate Need" >Roommate Need</option>
						<option value="Sublet" >Sublet</option>
						<option value="Others">Others</option>
					</select><br></td>
					</tr>
					<tr>
						<td><label>Details :</label></td>
						<td><textarea cols="50" rows="10" class="form-control" name="details" required="true"></textarea><br></td>
					</tr>
					<tr style="display:none">
						<td><label>Address : </label></td>
						<td><input type="text" id="address" name="address" class="form-control" required="true"><br></td>
					</tr>
					<tr style="display:none">
						<td><label>Latitude : </label></td>
						<td><input type="text" name="lat" id="latitude" class="form-control" required="true" value=""><br></td>
					</tr>
					<tr style="display:none">
						<td><label>Longititude : </label></td>
						<td><input type="text" name="longi" id="longitude" class="form-control" required="true" value=""><br></td>
					</tr>
					<tr>
						<td><label>Conditions :</label></td>
						<td><textarea class="form-control" rows="10" name="conditions"></textarea><br></td>
					</tr>
					<tr>
						<td><label>Varatia Type : </label></td>
						<td><input type="radio"  name="family_bachelor" checked="true" value="Family">&nbsp;Family &nbsp;&nbsp;<input type="radio" name="family_bachelor" value="Bachelor">&nbsp;Bachelor&nbsp;&nbsp; <input type="radio" name="family_bachelor" value="Female">&nbsp;Female&nbsp;&nbsp; <br><br><br></td>
					</tr>

					<tr>
						<td><label>Number Of Room:</label></td>
						<td><input type="number" name="number_of_room" class="form-control" required="true"><br></td>
					</tr>
					<tr>
						<td><label>Number Of Bath:</label></td>
						<td><input type="number" name="number_of_bath" class="form-control" required="true"><br></td>
					</tr>

					<tr>
						<td><label>Rent : </label></td>
						<td><input type="number" name="rent" class="form-control" required="" ><br></td>
					</tr>
					
				</table>
				</div>
				<div class="col-md-12" style="margin-left: 56px;">
					@for($i=0;$i<4;$i++)
					<div style="width:190px;height: 190px; background-color: #95959a;float: left;margin-left: 10px;position: relative; overflow: hidden;" class="image_up">
						<img src="{{url('img/image-upload.jpg')}}" id="image{{$i}}" style="width: 100%;height: 100%">
					<input type="file" name="image[]"  style="font-size: 162px;opacity: 0;margin-top: -219px;" required="true" onchange="setImage(this,{{$i}})">
					</div>
					@endfor
				</div>
				<script>var la=23.6850; var lo=90.3563;</script>
				<script src="{{url('js/my_create_gmap.js')}}"></script>
				<div class="col-md-10"><br>
				<h4>Please Select Your Location Before submit <br></h4>
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
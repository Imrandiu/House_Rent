@extends('layouts.app')

@section('content')
		<script
  src="http://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
	<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgCefzWt_NswmzoByfs8vgvL3BPikDDD8&callback=initMap&sensor=false">
</script>
    <script type="text/javascript">
        window.onload = function () {
            var mapOptions = {
                center: new google.maps.LatLng(23.8103, 90.4125),
                zoom: 14,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var infoWindow = new google.maps.InfoWindow();
            var latlngbounds = new google.maps.LatLngBounds();
            var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
            google.maps.event.addListener(map, 'click', function (e) {
                document.getElementById("lat_loc").value=e.latLng.lat();
                document.getElementById("longi_loc").value=e.latLng.lng();
          // setMap(map);
           var goldenGatePosition = {lat: e.latLng.lat(),lng: e.latLng.lng()};
	       var marker = new google.maps.Marker({
			position: goldenGatePosition,
			map: map,
			title: ''
			});
               // alert("Latitude: " + e.latLng.lat() + "\r\nLongitude: " + e.latLng.lng());
            });
        }
    </script>
    
<div class="container-fluid">
   <div class="row">
       <div class="col-md-2" style="margin-top: 12%;">
           @include('layouts.side_navbar')
       </div>
        <div class="col-md-10 panel panel-default" >
          <h3 style="color: red;">{{ $error_msg or '' }}</h3> 
                <div class="col-md-12"><h3>Personal Information <span style="font-size:15px;"><a style="cursor: pointer;" onclick="event.preventDefault(); document.getElementById('main_part').style.display='none';document.getElementById('edit_part').style.display='block';"><i style="padding: 15px;" class="fa fa-edit"></i></a></span></h3><hr></div>
                
                <style type="text/css">
                 td{padding: 6px;font-size: 14px;color: black;}
                 .align_left{text-align: left;color: #4c5db9;}
                </style>
                {{--Main part--}}
                <div id="main_part">
                <div class="col-md-9">
               <table style="width: 50%;">
                    <tr>
                        <td>Name :</td>
                        <td class="align_left">{{$data->name}}</td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td class="align_left">{{$data->email}}</td>
                    </tr> <tr>
                        <td>Primary Phone No :</td>
                        <td class="align_left">{{$data->phone_no}}</td>
                    </tr><tr>
                        <td>Address :</td>
                        <td class="align_left">{{$data->address}}</td>
                    </tr><tr>
                        <td>Optional Phone :</td>
                        <td class="align_left">{{$data->optional_phone}}</td>
                    </tr><tr>
                        <td>Optional Email :</td>
                        <td class="align_left">{{$data->optional_email}}</td>
                    </tr><tr>
                        <td style="padding-bottom: 30px;">Account Open Date :</td>
                        <td class="align_left" style="padding-bottom: 30px;">{{$data->created_at}}</td>
                    </tr>
                </table>
                </div>
                <div class="col-md-3">
                	@if($data->photo)
                	<img src="{{url('storage/app/public/user_image/'.$data->photo)}}"  style="width: 100%;height: 100%">
                	@else
                	<img src="{{url('img/Unknown.png')}}" style="width: 100%;height: 100%">
                	@endif
                </div>
            </div>
            {{--Edit part--}}
            <div id="edit_part" style="display: none;">
                <form class="form-horizontal" method="POST" action="{{ route('edit_profile') }}" id="edit_form" enctype='multipart/form-data'>
                  {{ csrf_field() }}
                <div class="col-md-9">
                <table style="width: 100%;margin-top:6%">
                    <tr>
                       <td>Name :</td>
                        <td><input type="text" class="form-control" style="text-transform:capitalize;"  name="name" placeholder="Enter Your name" value="{{$data->name}}"></td>
                    </tr> 
                    <tr style="display:none">
                        <td>Address :</td>
                        <td><input type="text" class="form-control" name="address" placeholder="Enter Your Address" value="{{$data->address}}"></td>
                    </tr>
                    <tr style="display:none">
                        <td>Latitude :</td>
                        <td><input type="text" class="form-control" name="lat" id="lat_loc" placeholder="Enter Your Address Latitude" value="{{$data->lat}}"></td>
                    </tr>
                    <tr style="display:none">
                        <td>Longitude :</td>
                        <td><input type="text" class="form-control" name="longi" id="longi_loc" placeholder="Enter Your Address longitude" value="{{$data->longi}}"></td>
                    </tr>
                    
                    <tr>
                           <td>Optional Phone :</td>
                        <td><input type="text" class="form-control" name="optional_phone" placeholder="Enter Optional Phone No" value="{{$data->optional_phone}}"></td>
                    </tr><tr>
                        <td>Optional Email :</td>
                        <td><input type="text" class="form-control" name="optional_email" placeholder="Enter Optional Email " value="{{$data->optional_email}}"></td>
                    </tr>
                </table> </div>

        	<div class="col-md-3">
			<div style="width:190px;height: 190px; background-color: #95959a;float: left;margin-left: 10px;position: relative; overflow: hidden;" class="image_up">
				@if($data->photo)
                	<img src="{{url('storage/app/public/user_image/'.$data->photo)}}" id="image" style="width: 100%;height: 100%">
                	@else
                	<img src="{{url('img/Unknown.png')}}" id="image" style="width: 100%;height: 100%">
                	@endif
			 <input type="file" name="image"  style="font-size: 162px;opacity: 0;margin-top: -219px;"  onchange="setImage(this)">
			</div>
		</div>

               <div class="col-md-10" style="display:none">
                   <div id="dvMap" style="width: 100%; height: 600px"></div>
               </div>
               <div class="col-md-1">
                   <input type="submit" style="margin-bottom: 15px;margin-top:22%"  value="Update" class="btn btn-lg btn-primary">
               </div>              
           </form>
            </div>
        </div>
   </div>
</div>

<script type="text/javascript">
function setImage(input){
 if (input.files && input.files[0]) {
   var reader = new FileReader();
   reader.onload = function(e) {
  $('#image').attr('src', e.target.result);
  }
 reader.readAsDataURL(input.files[0]);
}
}
	
</script>
@endsection



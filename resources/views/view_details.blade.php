@extends('layouts.app')

@section('content')
<style type="text/css">#view{padding: 10px;}
</style>
<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
 {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjDeGQKQA2yMsXkj1dJ_8kiBcaJOQgFPs&sensor=false">
</script>--}}
 <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgCefzWt_NswmzoByfs8vgvL3BPikDDD8&callback=initMap"
  type="text/javascript"></script>

  <script src="{{url('js/gmaps.min.js')}}"></script>
   <style type="text/css">
    #map {
    	margin-top: 50px;
    	margin-bottom: 50px;
    	padding: 10px;
      width: 100%;
      height: 500px;
    }
  </style>
  
 <div class="container-fluid" >
 	<div class="row">
 		<div class="col-md-10 col-md-offset-1">
 			<div class="row"><div class="col-md-12">Home->{{$data->title}}</div></div>
 			<div class="row" id="view" style="background-color: white;margin-top: 10px;">
 				<div class="col-md-12"><h1>{{$data->title}}</h1><p>{{$data->address}}</p></div>
 				<div class="col-md-9">
 					<div class="row">
 			{{--slider start......--}}
 			 		<div class="col-md-12" style="height: 470px;">
 				         <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >
						  <!-- Indicators -->
						  <ol class="carousel-indicators">
						    <li data-target="#carousel-example-generic" data-slide-to="0" class="active">
						    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
						    <li data-target="#carousel-example-generic" data-slide-to="2"></li> 
						    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
						  </ol>

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" role="listbox" style="height: 450px; width: 100%;">
						    <div class="item active" style="height: 65%; ">
						      <img src="{{url('storage/app/public/post_image/a'.$data->id.'.jpg')}}" alt="..." >
						      
						    </div>
						    <div class="item" style="height: 65%; ">
						      <img src="{{url('storage/app/public/post_image/b'.$data->id.'.jpg')}}" alt="..." >
						      
						    </div>
						    <div class="item" style="height: 65%; ">
						      <img src="{{url('storage/app/public/post_image/c'.$data->id.'.jpg')}}" alt="..." >	
						  </div>
						  <div class="item" style="height: 65%; ">
						      <img src="{{url('storage/app/public/post_image/d'.$data->id.'.jpg')}}" alt="..." >	
						  </div>
						  </div>

						  <!-- Controls -->
						  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
						    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						    <span class="sr-only">Previous</span>
						  </a>
						  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
						    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						    <span class="sr-only">Next</span>
						  </a>
						</div>
							</div>
                  {{--slider end......--}}
                  	
                  		<div class="col-md-10" style="margin-top: 20px;">
                  			 <img src="{{url('storage/app/public/post_image/a'.$data->id.'.jpg')}}" alt="..." style="width: 80px;height: 80px;">
                  			  <img src="{{url('storage/app/public/post_image/b'.$data->id.'.jpg')}}" alt="..." style="width: 50px;height: 50px;">
                              <img src="{{url('storage/app/public/post_image/c'.$data->id.'.jpg')}}" alt="..." style="width: 50px;height: 50px;">
                  			   <img src="{{url('storage/app/public/post_image/d'.$data->id.'.jpg')}}" alt="..." style="width: 50px;height: 50px;">
                  		</div>
                  		<div class="col-md-2" style="margin-top: 20px;">
                  		    <a class="btn btn-primary" href="{{route('booking',$data->id)}}">Click For Booking</a>
                  		</div>

                  		<div class="col-md-12">
                  			<div class="row">
                  				 <div class="col-md-12">
                  				 	<img src="{{url('img/tk.png')}}" style="margin-top: 15px;position: relative;"><span style="position: absolute;margin-left: -105px;margin-top: 22px;color: black">TK {{$data->rent}}</span>
                  				 </div>	
                  				<div class="col-md-12">
                  					<h2>Details</h2><hr>
                  					{{$data->details}}

                  					<hr>
                  				</div>

                  				<div class="col-md-12">
                  					<h2>Conditions</h2><hr>
                                                {{$data->conditions}}<hr>
                  				</div>

                  				<div class="col-md-3">
                  					<h5>Varatia Type : {{$data->family_bachelor}}</h5>
                  				</div>
                  				<div class="col-md-3">
                  					<h5>Number of Room : {{$data->number_of_room}}</h5>
                  				</div>
                  				<div class="col-md-3">
                  					<h5>Number of Bath : {{$data->number_of_bath}}</h5>
                  				</div>
                  				<div class="col-md-3">
                  					<h5>Roommat Need : {{$data->roommat_number}}</h5>
                  				</div>

                  				<div class="col-md-12">
                  					<h3>Contact</h3><hr>
                                     <i class="fa fa-phone" aria-hidden="true" style="font-size: 22px;"></i><span style="margin-left: 10px;">{{$data->phone}}</span>
                  				</div>
                  				@if($data->lat !=NULL && $data->longi !=NULL)
                  					<div class="col-md-12">
                  		             <div id="map"></div>

  
    <script>
 $(function () {

   var map = new GMaps({
        div: '#map',
        lat: 23.6850,
        lng: 90.3563,
        zoom:9,
      });

      map.addMarker({
        lat: {{$data->lat}},
        lng: {{$data->longi}},
        title: '{{$data->address}}',
        
      });


});
    </script>
                  				</div>
                  				@endif
                  			</div>	
                  		</div>


 					</div>
 				</div>
 				<div class="col-md-3">
 				    <div style="position:fixed" id="block-menu">
 					<hr>
 					<h4 style="margin-left: 10px;">Contact</h4>
 					<div class="card" style="width: 26rem;border:2px solid #2BAF6C;padding:10px;">
  <div class="card-body">
    <p class="card-text">
        <div class="row">
            <div class="col-md-4">
                  @if($data->photo !=Null)
        <img src="{{url('storage/app/public/user_image/'.$data->photo)}}" style="width:60px;height:60px;border-radius:50%">
        @else
        <img src="{{url('img/Unknown.png')}}" style="width:100px;height:100px;border-radius:50%">
        @endif
            </div>
            <div class="col-md-8">
                  <p>{{$data->name}}</p> <p style="word-break: break-all;">{{$data->email}}</p> <p style="word-break: break-all;">{{$data->optional_email}}</p>
        <i class="fa fa-phone" aria-hidden="true" style="font-size: 22px;"></i><span style="margin-left: 10px;">{{$data->phone}}</span></p>
            </div>
        </div>
      
      
  </div>
</div>
 			</div>	</div>
 			</div>
 		</div>
 	</div>
 </div>
 <script>
     $(document).scroll(function() {
    var y = $(document).scrollTop(),
        header = $("#block-menu");
    if(y >= 1600)  {
        header.css("position", "relative");
        
    } else {
        header.css({position: "fixed"});
    }
});
 </script>
@endsection

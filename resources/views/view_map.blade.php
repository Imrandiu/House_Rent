@extends('layouts.app')

@section('content')
<style type="text/css">#view{padding: 10px;}
</style>
<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
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
  
  
  <div class="container">
      <div class="row">

  				<div class="col-md-12">
  	             <div id="map"></div>

            @php $a =0; @endphp
               @if(count($p_locs)>0)
              @foreach($p_locs as $location)
              @if($a == 0)
               <script>
                   var map = new GMaps({
                        div: '#map',
                        lat: {{$location->lat}},
                        lng: {{$location->longi}},
                        zoom:13,
                      });
                    </script>
             @endif
              @php $a++; @endphp
                <script>
                     var p= map.addMarker({
                        lat: {{$location->lat}},
                        lng: {{$location->longi}},
                        title: '{{$location->address}}',
                        
                      });
                      
                       p.addListener('click', function(e) {
                       location.replace("{{url('view_details/'.$location->id)}}")
                      });
  
                </script>
              @endforeach
            @endif
                    
                    
  				</div>

      </div>
  </div>
                  				
 
@endsection


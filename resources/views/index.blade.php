@extends('layouts.app')

@section('content')
 
    <link rel="stylesheet" href="{{url('css/nice-select.css')}}">
	<link rel="stylesheet" href="{{url('css/ion.rangeSlider.css')}}" />
	<link rel="stylesheet" href="{{url('css/ion.rangeSlider.skinFlat.css')}}" />
	<link rel="stylesheet" href="{{url('css/main.css')}}">
  
     <!--Plugin CSS file with desired skin-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    
    <!--jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!--Plugin JavaScript file-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    
    
	<!-- start banner Area -->
	<section class="home-banner-area relative" id="home">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row fullscreen align-items-end justify-content-center">
				<div class="banner-content col-lg-12 col-md-12">
					<div class="search-field">
						<form class="search-form" method="get" action="{{route('search')}}">
							<div class="row">
								<div class="col-lg-12 d-flex align-items-center justify-content-center toggle-wrap">
									<div class="row">
										<div class="col">
											<h2 class="search-title" style="color:#E67300;">Search Properties For</h2>
										</div>
										<div class="col">
								
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-lg-offset-1 col-md-6 col-xs-6">
									<select name="title" class="app-select form-control" >
										<option  value="">Choose Title</option>
										<option value="Flat Rent">Flat Rent</option>
										<option value="Mess Rent">Mess Rent</option>
										<option value="Roommate Need">Roommate Need</option>
										<option value="Sublet">Sublet</option>
										<option value="Others">Others</option>
									</select>
								</div>
								<div class="col-lg-3 col-md-6 col-xs-6">
									<select name="family_bachelor" class="app-select form-control" >
										<option value="">Renter Type</option>
										<option value="Family">Family</option>
										<option value="Bachelor">Bachelor</option>
										<option value="Female">Female</option>
									</select>
								</div>
								<div class="col-lg-3 col-md-6 col-xs-6">
									<input type="text" class="form-control" name="address" placeholder="Enter Address">
								
								
													</div>
							
								<div class="col-lg-4 col-lg-offset-1 range-wrap">
									<h4><b style="color:#E67300;">Price Range(TK):</b></h4>
									<input type="text" id="range" class="js-range-slider" name="range" />
								</div>
							
								<div class="col-lg-4 d-flex justify-content-end">
									<button class="primary-btn">Search Properties<span class="lnr lnr-arrow-right"></span></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->
	<section class="container">
	    	<div class="row">
	    	    
	    	      @if($posts->count()>0)
              @if($search_map != false)  @php $address=['dhaka','natore']; @endphp
              <div class="col-md-1 col-md-offset-11"><a href="{{route('view_map',['address'=>$search_map])}}" class="btn btn-primary">Map</a></div>
              @endif
          @foreach($posts as $post)
          
           
				<div class="col-lg-4" style="margin-top:30px;height:350px;">
				    <a href="{{route('view_details',['id'=>$post->id])}}" style="color: black;">
					<div class="single-property" style="border-radius: 15%">
						<div class="images" style="height:200px;border-radius: 7%">
							<img class="img-fluid mx-auto d-block" src="{{url('storage/app/public/post_image/a'.$post->id.'.jpg')}}" alt="">
						</div>

						<div class="desc">
							<div class="top d-flex justify-content-between">
							   <div class="row">
							       <div class="col-lg-8">
							           <h4><a href="#">{{$post->title}}</a></h4>
							       </div>
							       <div class="col-lg-4">
							           <h5>Tk : {{$post->rent}}</h5>
							       </div>
							   </div>
								
								
							</div>
					
							<div class="bottom d-flex justify-content-start">
								{{$post->address}} 
							</div>
						</div>
					</div>
					</a>
				</div>
				
         @endforeach
         {{ $posts->links() }}
         @endif
         
         
         
				</div>
	</section>
	
	 <script>

	      $(".js-range-slider").ionRangeSlider({
	          type: "double",
        min: 0,
        max: 100000,
        from: 2000,
        to: 20000,
        grid: true
    });

	 </script>
 
@endsection


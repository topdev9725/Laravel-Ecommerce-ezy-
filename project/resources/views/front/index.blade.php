@extends('layouts.front')
@section('styles')
<style>
.waze {
	margin-top: 10px;
}

.waze-btn {
	margin-bottom: 0px !important;
}

.waze-img {
	width: 15% !important;
}
@media only screen and (max-width: 767px) {  
	.category-img {
		border-radius: 50%!important;
		height: 100%;
	}

	.ezy-category-name {
		font-size: 16px !important;
	}

	.hover {
		height: 69px;
	}

	.waze-img {
		width: 10% !important;
	}
}

@media only screen and (max-width: 420px) {
	.hover {
		height: 80px;
	}
}
@media only screen and (max-width: 390px) {
	.hover {
		height: 70px;
	}
}
@media only screen and (max-width: 350px) {
	.hover {
		height: 56px;
	}

	.ezy-category-name {
		font-size: 14px !important;
	}
}
</style>
@endsection
@section('content')

	@if($ps->slider == 1)

		@if(count($sliders))

			@include('includes.slider-style')
		@endif
	@endif

	@if($ps->slider == 1)
		<!-- Hero Area Start -->
		<section class="hero-area">
			<div class="container-fluid">
				<!-- ----------------------------------------- Me (changed col-lg-9 to col-lg-12)----------------------- -->
				<div class="row">
					<div class="col-lg-3 decrease-padding" style="display: none">
						<div class="featured-link-box">
							<h4 class="title">
									{{ $langg->lang831 }}
							</h4>
							<ul class="link-list">
								@foreach(DB::table('featured_links')->get() as $data)
								<li>
									<a href="{{ $data->link }}" target="_blank"><img src="{{ $data->photo ? asset('assets/images/featuredlink/'.$data->photo) :  asset('assets/images/noimage.png') }}" alt="">{{ $data->name }}</a>
								</li>
								@endforeach
							</ul>
						</div>
					</div>
					<!-- <div class="col-lg-9 decrease-padding"> -->
					<div class="col-lg-12 decrease-padding">
							@if($ps->slider == 1)
							@if(count($sliders))
								<div class="hero-area-slider">
									<div class="slide-progress"></div>
									<div class="intro-carousel">
										@foreach($sliders as $data)
											<div class="intro-content {{$data->position}}" style="background-image: url({{asset('assets/images/sliders/'.$data->photo)}})">
												<div class="slider-content">
													<div class="layer-1">
														<h4 style="font-size: {{$data->subtitle_size}}px; color: white" class="subtitle subtitle{{$data->id}}" data-animation="animated {{$data->subtitle_anime}}">{{$data->subtitle_text}}</h4>
														<h2 style="font-size: {{$data->title_size}}px; color: white" class="title title{{$data->id}}" data-animation="animated {{$data->title_anime}}">{{$data->title_text}}</h2>
													</div>
													<div class="layer-2">
														<p style="font-size: {{$data->details_size}}px; color: white"  class="text text{{$data->id}}" data-animation="animated {{$data->details_anime}}">{{$data->details_text}}</p>
													</div>
													<!-- <div class="layer-3">
														<a href="{{$data->link}}" target="_blank" class="mybtn1"><span>{{ $langg->lang25 }} <i class="fas fa-chevron-right"></i></span></a>
													</div> -->
												</div>
											</div>
										@endforeach
									</div>
								</div>
							@endif
						@endif
					</div>
				</div>	
			</div>
		</section>
		<!-- Hero Area End -->
	@endif

	@if($ps->service == 1)

		{{-- Info Area Start --}}
			<section class="info-area" style="margin-top: 70px">
				<div class="container">
			
					@foreach($services->chunk(4) as $chunk)
			
					<div class="row">
			
						<div class="col-lg-12 col-md-12 col-12 p-0">
							<div class="info-big-box">
								<div class="row">
									@foreach($chunk as $service)
									<div class="col-6 col-xl-3 p-0">
										<div class="info-box">
											<div class="icon">
												<img src="{{ asset('assets/images/services/'.$service->photo) }}">
											</div>
											<div class="info">
												<div class="details">
													<h4 class="title">{{ $service->title }}</h4>
													<p class="text">
														{!! $service->details !!}
													</p>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
			
					</div>
			
					@endforeach
			
				</div>
			</section>
		{{-- Info Area End  --}}												

	@endif

	<!-- ****************************************** Online store block start ****************************************** -->
	<!-- Category list Start -->
	<div style="text-align: center">
		<label for="" class="ezy-lg-title">Online Stores</label>
	</div>
	<section class="hero-area ezy-hero-area">
			<div class="container">
				<!-- -------------------- online store category list start -------------------- -->
				<div class="d-flex align-items-center">
					<div class="flex-shrink-0">
						<a href="#" class="btn-left btn-link p-2 toggleLeft category-slider-arrow"><i class="fa fa-angle-left ezy-fa-angle-left"></i></a> 
					</div>
					<div class="flex-grow-1 position-relative overflow-hidden" id="outer">
						<ul class="nav nav-fill text-uppercase position-relative flex-nowrap" id="bar">
						<?php $slider_time = 0; ?>
						@foreach(DB::table('categories')->where('store_type', '=', 0)->get() as $data)
							<?php $slider_time += 0.2; ?>
							<div class="col-lg-2 col-md-4 col-3 wow fadeInRight category-slider" data-wow-delay="<?php echo $slider_time.'s'; ?>">   <!-- ----- removed ezy-col-md-3 -------- -->
								<div class="hover hover-5 text-white rounded">
									<img class="category-img" src="{{ asset('assets/images/categories/'.$data->image) }}" alt="">
									<a href="{{ route('front.category.store.show').'?category_id='.$data->id }}">
										<div class="hover-overlay"></div>
										<div class="hover-5-content">
											<h3 class="hover-5-title text-uppercase font-weight-light mb-0"> <strong class="font-weight-bold text-white ezy-category-name" style="color:white !important;text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;"></strong></h3>
										</div>
									</a>
								</div>
								<p class="ezy-category-name"><a href="{{ route('front.category.store.show').'?category_id='.$data->id }}" class="ezy-category-name">{{ $data->name }}</a></p>
							</div>						
						@endforeach
						</ul>
					</div>
					<div class="flex-shrink-0">
						<a href="#" class="btn-right btn-link toggleRight p-2 category-slider-arrow"><i class="fa fa-angle-right ezy-fa-angle-right"></i></a>
					</div>
				</div>
				<!-- ------------------ online store category list end -------------- -->
			</div>
		</section>
	<!-- Category list End -->	

	<!-- Nearby Merchant Area Start -->
	<section class="slider_bottom_banner">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top" style="border-bottom: 0px solid rgba(0, 0, 0, 0.10) !important;">
							<h2 class="section-title">
							</h2>
						</div>
					</div>
				</div>
				<div class="row ezy-row-nopadding">
				@foreach(DB::table('users')->whereIn('is_vendor', array(1,2))->where('online', '=', 1)->get() as $online_vendor)
						<div class="col-lg-3 col-md-6 col-12 ezy-custom-responsive ezy-col-xl-5">
							<div class="card ezy-custom-card">
								<div class="row">
									<div class="col-lg-12 col-md-5 col-5 ezy-responsive-store">
										<a href="{{ route('front.vendor', [str_replace(' ', '-', $online_vendor->shop_name), $online_vendor->id, 0]) }}" class="banner-effect">
											<img class="ezy-store-img" src="{{ empty($online_vendor->shop_logo)?asset('assets/images/vendorlogo/default_logo.jpg'):asset('assets/images/vendorlogo/'.$online_vendor->shop_logo) }}" alt="">
										</a>
									</div>
									
									<div class="col-lg-12 col-md-7 col-7">
										<p class="ezy-store-name">{{ $online_vendor->shop_name }}</p>
										<!-- @php
											$products = DB::table('products')->where('user_id', '=', $online_vendor->id)->take(4)->get();
											$product_names = '';
											if(count($products) != 0) {
												foreach($products as $product) {
													$product_names .= $product->name.', ';
												}
												$product_names = substr($product_names, 0, -2);
											}
										@endphp
										<p class="ezy-store-product"><b>Products</b> : {{$product_names}}</p> -->
										<p class="ezy-store-product">{{ $online_vendor->shop_address }}</p>
									</div>
									<div class="col-lg-5 col-md-5 col-5 text-center ezy-review-distance">
										<i class='fas fa-star ezy-review'>&nbsp; {{isset(Session::get('every_shop_ratings')[$online_vendor->id])?number_format(Session::get('every_shop_ratings')[$online_vendor->id],2):'5.00'}}</i>
									</div>
									<div class="col-lg-7 col-md-7 col-7 text-center ezy-review-distance">
										<i class="far fa-clock ezy-distance-time">&nbsp; {{ $online_vendor->opening_hours }}</i>
									</div>
									@php
										$waze = 'll='.$online_vendor->shop_latitude.','.$online_vendor->shop_longitude;
									@endphp
									<div class="col-lg-12 text-right waze">
										<a href="{{ 'waze://?'.$waze.'&navigate=yes'}}" class="waze-btn" target="_blank"><img class="waze-img" src="{{asset('assets/images/waze.png')}}" alt=""></a>
									</div>
								</div>
							</div>
						</div>
				@endforeach	
				</div>
				<div class="row">
					<div class="col-lg-10"></div>
					<div class="col-lg-2 col-12 col-md-12 float-right">
						<a href="{{ route('front.category.store.show').'?category_id=0' }}" class="btn btn-primary btn-lg" id="online_show_all">Show All</a>
					</div>
				</div>
				<!-- <div class="row"> -->
					
				<!-- </div> -->
			</div>

		</section>
	<!-- Nearby Merchant Area End -->
	<div class="divider"></div>
	<!-- ****************************************** Online store block end ****************************************** -->

	<!-- ****************************************** Nearby store block start ****************************************** -->
	<!-- Category list Start -->
	<div style="text-align: center">
		<label for="" class="ezy-lg-title">Nearby Merchant Stores</label>
	</div>
	<section class="hero-area ezy-hero-area">
			<div class="container">
				<div class="d-flex align-items-center" style="margin-bottom: 50px">
					<div class="flex-shrink-0">
						<a href="#" class="btn-left btn-link p-2 toggleLeft1 category-slider-arrow"><i class="fa fa-angle-left ezy-fa-angle-left"></i></a>
					</div>
					<div class="flex-grow-1 position-relative overflow-hidden" id="outer1">
						<ul class="nav nav-fill text-uppercase position-relative flex-nowrap" id="bar1">
						<?php $slider_time1 = 0;; ?>
						@foreach(DB::table('categories')->where('store_type', '=', 1)->get() as $data)
							<!-- DEMO 5 Item-->
							<?php $slider_time1 += 0.2; ?>
							<div class="col-lg-3 col-md-4 col-3 wow fadeInRight category-slider" data-wow-delay="<?php echo $slider_time1.'s'; ?>">
								<!-- DEMO 5 Item-->
								<div class="hover hover-5 text-white rounded">
									<img class="category-img" src="{{ asset('assets/images/categories/'.$data->image) }}" alt="">
									<a href="{{ route('front.nearbymerchant').'?category_id='.$data->id }}">
										<div class="hover-overlay"></div>
										<div class="hover-5-content">
											<h3 class="hover-5-title text-uppercase font-weight-light mb-0"> <strong class="font-weight-bold text-white ezy-category-name" style="color: white !important;text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;"></strong></h3>
										</div>
									</a>
								</div>
								<p class="ezy-category-name"><a href="{{ route('front.nearbymerchant').'?category_id='.$data->id }}" class="ezy-category-name">{{ $data->name }}</a></p>
							</div>						
						@endforeach
						</ul>
					</div>
					<div class="flex-shrink-0">
						<a href="#" class="btn-right btn-link toggleRight1 p-2 category-slider-arrow"><i class="fa fa-angle-right ezy-fa-angle-right"></i></a>
					</div>
				</div>
			</div>
		</section>
	<!-- Category list End -->	

	<!-- Nearby Merchant Area Start -->
	<section class="slider_bottom_banner">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<p class="section-title">
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-12" style="text-align: end;margin:40px 0px">
					<div class="price-range-block">
						<input type="range" id="range-value" min="1" max="50" value="25" class="slider" style="width: 200px;margin-bottom: 15px">
						<p id="range-result">Current range : <b></b> km</p>
					</div>
				</div>	
				<div id="nearby-store" class="">
					<div class="col-lg-12 text-center">
						<div class="spinner-border text-secondary" style="margin: 50px;color: red !important"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-10"></div>
					<div class="col-lg-2 col-12 col-md-12 float-right">
						<a href="{{ route('front.nearbymerchant') }}" class="btn btn-primary btn-lg" id="nearby_show_all">Show All</a>
					</div>
				</div>
			</div>

		</section>
	<!-- Nearby Merchant Area End -->

	<!-- ****************************************** Nearby store block end ****************************************** -->

	<section id="extraData">
		<div class="text-center">
		<!-- <img class="{{ $gs->is_loader == 1 ? '' : 'd-none' }}" src="{{asset('assets/images/'.$gs->loader)}}"> -->
		</div>
	</section>


@endsection

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
	<script>
		//--------------------------- category animation start -------------------------------//
		new WOW().init();	

		// var PrevState = false;
		// $(document).scroll(function(){
		// 	let currState = false;
		// 	if ($(document).scrollTop() > $('#category_position').height() && $(document).scrollTop() < $('#category_position').height() + $('#category_position').first().position().top) {
		// 		currState = true;
		// 	} else {
		// 		currState = false;
		// 	}

		// 	if(!PrevState && currState) {
		// 		new WOW().init();
		// 		console.log(111);
		// 	}			
		// 	PrevState = currState;	
		// })

		// var PrevState1 = false;
		// $(document).scroll(function(){
		// 	let currState1 = false;
		// 	if ($(document).scrollTop() > $('#category_position1').first().position().top && $(document).scrollTop() < $('#category_position1').height() + $('#category_position1').first().position().top) {
		// 		currState1 = true;
		// 	} else {
		// 		currState1 = false;
		// 	}

		// 	if(!PrevState1 && currState1) {
		// 		new WOW().init();
		// 		console.log(111);
		// 	}			
		// 	PrevState1 = currState1;	
		// })
		// ----------------------------- category animation end -------------------------------//

		// Read value on page load
        $("#range-result b").html($("#range-value").val());

        // Read value on change
        $("#range-value").change(function(){
            $("#range-result b").html($(this).val());
		});
		
		$(document).on('mouseup touchstart', '#range-value', function(e) {   
			$('#nearby-store').html("<div class='col-lg-12 text-center'><div class='spinner-border text-secondary' style='margin: 50px;color: red !important'></div></div>");
			var latitude = $('#latitude').val();
			var longitude = $('#longitude').val();			
			if(latitude=='' || longitude=='' || latitude=='0' || longitude=='0') {
				showError("Please enter address correctly to get getlocation.\n You might not be supported Nearby Service.");					
				return false;
			}
			setGeolocation($('#range-value').val());		
		});

		// var slider = document.getElementsById('outer');
		// slider.addEventListener('touchstart', handleTouchStart, false);        
		// slider.addEventListener('touchmove', handleTouchMove, false);

	</script>
<!-- ---------------------- responsive store category list js start ------------- -->
<script type="text/javascript">
  var metrics = {};
  var scrollOffset = 0;

  var container = document.getElementById("outer");
  var bar = document.getElementById("bar");

  function setMetrics() {
      metrics = {
          bar: bar.scrollWidth||0,
          container: container.clientWidth||0,
          left: parseInt(bar.offsetLeft),
          getHidden() {
              return (this.bar+this.left)-this.container
          }
      }
      
      updateArrows();
  }

  function doSlide(direction){
      setMetrics();
      var pos = metrics.left;
      if (direction==="right") {
          amountToScroll = -(Math.abs(pos) + Math.min(metrics.getHidden(), metrics.container));
      }
      else {
          amountToScroll = Math.min(0, (metrics.container + pos));
      }
      bar.style.left = amountToScroll + "px";
      setTimeout(function(){
          setMetrics();
      },400)
  }

  function updateArrows() {
      if (metrics.getHidden() === 0) {
          document.getElementsByClassName("toggleRight")[0].classList.add("text-light");
      }
      else {
          document.getElementsByClassName("toggleRight")[0].classList.remove("text-light");
      }
      
      if (metrics.left === 0) {
          document.getElementsByClassName("toggleLeft")[0].classList.add("text-light");
      }
      else {
          document.getElementsByClassName("toggleLeft")[0].classList.remove("text-light");
      }
  }

  function adjust(){
      bar.style.left = 0;
      setMetrics();
  }

  document.getElementsByClassName("toggleRight")[0].addEventListener("click", function(e){
      e.preventDefault()
      doSlide("right")
  });

  document.getElementsByClassName("toggleLeft")[0].addEventListener("click", function(e){
      e.preventDefault()
      doSlide("left")
  });

  window.addEventListener("resize",function(){
      // reset to left pos 0 on window resize
      adjust();
  });

  setMetrics();

</script>
<script type="text/javascript">
  var metrics1 = {};
  var scrollOffset = 0;

  var container1 = document.getElementById("outer1");
  var bar1 = document.getElementById("bar1");

  function setMetrics1() {
      metrics1 = {
          bar1: bar1.scrollWidth||0,
          container1: container1.clientWidth||0,
          left1: parseInt(bar1.offsetLeft),
          getHidden1() {
              return (this.bar1+this.left1)-this.container1
          }
      }
      
      updateArrows1();
  }

  function doSlide1(direction){
      setMetrics1();
      var pos = metrics1.left1;
      if (direction==="right") {
          amountToScroll = -(Math.abs(pos) + Math.min(metrics1.getHidden1(), metrics1.container1));
      }
      else {
          amountToScroll = Math.min(0, (metrics1.container1 + pos));
      }
      bar1.style.left = amountToScroll + "px";
      setTimeout(function(){
          setMetrics1();
      },400)
  }

  function updateArrows1() {
      if (metrics1.getHidden1() === 0) {
          document.getElementsByClassName("toggleRight1")[0].classList.add("text-light");
      }
      else {
          document.getElementsByClassName("toggleRight1")[0].classList.remove("text-light");
      }
      
      if (metrics1.left1 === 0) {
          document.getElementsByClassName("toggleLeft1")[0].classList.add("text-light");
      }
      else {
          document.getElementsByClassName("toggleLeft1")[0].classList.remove("text-light");
      }
  }

  function adjust1(){
      bar1.style.left = 0;
      setMetrics1();
  }

  document.getElementsByClassName("toggleRight1")[0].addEventListener("click", function(e){
      e.preventDefault()
      doSlide1("right")
  });

  document.getElementsByClassName("toggleLeft1")[0].addEventListener("click", function(e){
      e.preventDefault()
      doSlide1("left")
  });

  window.addEventListener("resize",function(){
      // reset to left pos 0 on window resize
      adjust1();
  });

  setMetrics1();

</script>
<!-- ---------------------- responsive stote category list js end ------------- -->
@endsection
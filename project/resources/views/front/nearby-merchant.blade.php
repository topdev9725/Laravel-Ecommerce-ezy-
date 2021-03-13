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
	.ezy-nearby-title {
		padding-bottom: 0px !important;
	}

	.fadeInUp {
		padding-left: 8px;
    	padding-right: 8px;
	}

	.sub-categori {
		padding-top: 0px;
	}
	.hover-5:hover .hover-overlay {
		background: rgba(0, 0, 0, 0.2);
	}
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
	<div class="breadcrumb-area" style="background: url({{  asset('assets/images/online_banner.png') }}) !important;background-repeat: no-repeat; background-size: cover !important;background-position: center;padding: 0px 0px!important;">
		<div class="row" style="background-color: rgba(0,0,0,0.3)">
		<div class="col-lg-12">
			<label for="" class="text-white text-center ezy-img-letter">Nearby Merchant Stores</label>
			<p class="text-uppercase text-white text-center ezy-sm-img-letter">Welcome to our Nearby Merchant Stores</p>
		</div>
		<div class="col-lg-12 ezy-breadcrumb">
				<ul class="pages">
					<li>
						<a href="{{ route('front.index') }}" class="ezy-breadcrumb-text">
							{{ $langg->lang17 }}
						</a>
					</li>
					<li>
						<a href="{{ route('front.nearbymerchant') }}" class="ezy-breadcrumb-text">
							Nearby Merchant
						</a>
					</li>
				</ul>
		</div>
		</div>
	</div>

	<!-- Nearby Merchant Area Start -->
	<section class="slider_bottom_banner">
			<div class="container">
				<div class="row ezy-row ezy-nearby-title">
					<div class="col-lg-12 col-md-12 col-12">
						<p class="ezy-merchant">Nearby Merchant Stores</p>
					</div>
				</div>	
				<div class="row ezy-row"  id="category_position">
					<div class="col-lg-3 col-md-12 col-12 ezy-vertical-category">
						<div class="row">
							<?php $slider_time = 0; ?>
							@foreach(DB::table('categories')->where('store_type', '=', 1)->get() as $data)
								<!-- DEMO 5 Item-->
								<?php $slider_time += 0.2; ?>
								<div class="col-lg-12 col-md-4 col-3 wow fadeInUp" data-wow-delay="<?php echo $slider_time.'s'; ?>">
									<!-- DEMO 5 Item-->
									<div class="hover hover-5 text-white rounded">
										<img class="category-img" src="{{ asset('assets/images/categories/'.$data->image) }}" alt="">
										<a href="javascript:nearby('{{ $data->id }}')">
											<div class="hover-overlay"></div>
											<div class="hover-5-content">
												<h3 class="hover-5-title text-uppercase font-weight-light mb-0"> <strong class="font-weight-bold text-white ezy-category-name" style="color: white !important"></strong></h3>
											</div>
										</a>
									</div>
									<p class="ezy-category-name"><a href="javascript:nearby('{{ $data->id }}')" id="{{ $data->id }}" class="ezy-category-name">{{ $data->name }}</a></p>
								</div>						
							@endforeach
							<input type="hidden" id="cat_id" value="">
						</div>
					</div>
					<div class="col-lg-9 col-md-12 col-12">
						<div class="row">
							<div class="col-lg-6 col-md-12 col-12">
								<!-- <p class="ezy-category-result-title">{{ empty($category_info)?"All":$category_info->name }} Stores</p> -->
								<!-- <p class="ezy-online-category-note">{{ empty($category_info)?"All":$category_info->name }} Stores</p> -->
							</div>
							<div class="col-lg-6 col-md-12 col-12">
								<div class="row">
									<div class="col-lg-12" style="text-align: end;margin:40px 0px">
										<div class="price-range-block">
											<input type="range" id="range-value" min="1" max="50" value="38" class="slider" style="width: 200px;margin-bottom: 15px">
											<p id="range-result">Current range : <b></b> km</p>
										</div>
									</div>	
								</div>
							</div>
						</div>
						<div id="nearby-store" class="row">
							<div class="row ezy-row-nopadding">
								@foreach($nearby_stores as $nearby_store)
								<div class="col-lg-3 col-md-6 col-12 ezy-custom-responsive">
									<div class="card ezy-custom-card1">
										<div class="row">
											<div class="col-lg-12 col-md-5 col-5 ezy-responsive-store">
												<a href="{{ route('front.vendor', [str_replace(' ', '-', $nearby_store->shop_name), $nearby_store->id, 1, $category_info->id]) }}" class="banner-effect text-center">
													<img class="ezy-store-img" src="{{ empty($nearby_store->shop_logo)?asset('assets/images/store_logo/default_logo.jpg'):asset('assets/images/store_logo/'.$nearby_store->shop_logo) }}" alt="">
												</a>
											</div>
											<div class="col-lg-12 col-md-7 col-7">
												<p class="ezy-store-name1">{{ $nearby_store->shop_name }}</p>
												<p class="ezy-store-product1">{{ $nearby_store->shop_address }}</p>
											</div>
											<div class="col-lg-4 col-md-4 col-4 text-center p-0">
												<i class='fas fa-star ezy-review1'>&nbsp; {{isset(Session::get('every_shop_ratings')[$nearby_store->id])?number_format(Session::get('every_shop_ratings')[$nearby_store->id],2):'0.00'}}</i>
											</div>
											<div class="col-lg-8 col-md-8 col-8 text-center p-0">
												<i class="far fa-clock ezy-distance-time1">&nbsp; {{ $nearby_store->opening_hours }} : {{ $nearby_store->distance }}km</i>
											</div>
											@php
												$waze = 'll='.$nearby_store->shop_latitude.','.$nearby_store->shop_longitude;
											@endphp
											<div class="col-lg-12 text-right waze">
												<a href="{{ 'waze://?'.$waze.'&navigate=yes'}}" class="waze-btn" target="_blank"><img class="waze-img" src="{{asset('assets/images/waze.png')}}" alt=""></a>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<!-- Nearby Merchant Area End -->
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
	<script>
		// $(document).ready(function(){
			new WOW().init();
		// })
		
		var PrevState = false;
		$(document).scroll(function(){
			let currState = false;
			if ($(document).scrollTop() < $('#category_position').height() + $('#category_position').first().position().top) {
				currState = true;
			} else {
				currState = false;
			}

			if(!PrevState && currState) {
				// new WOW().init();
				console.log(111);
			}			
			PrevState = currState;	
		})

		// Read value on page load
        $("#range-result b").html($("#range-value").val());

        // Read value on change
        $("#range-value").change(function(){
            $("#range-result b").html($(this).val());
		});

		function nearby(category_id) {
			$('#cat_id').val(category_id);
			$('#nearby-store').html("<div class='spinner-border text-secondary' style='margin: auto;color: red !important'></div>");
			var latitude = $('#latitude').val();
			var longitude = $('#longitude').val();			
			if(latitude=='' || longitude=='' || latitude=='0' || longitude=='0') {
				showError("Please enter address correctly to get getlocation.\n You might not be supported Nearby Service.");					
				return false;
			}
			setGeolocation($('#range-value').val(), category_id, 1);	
		}

		$(document).on('mouseup touchstart', '#range-value', function(e) { 
			var cat_id = $('#cat_id').val();
			$('#nearby-store').html("<div class='spinner-border text-secondary' style='margin: auto;color: red !important'></div>");
			var latitude = $('#latitude').val();
			var longitude = $('#longitude').val();			
			if(latitude=='' || longitude=='' || latitude=='0' || longitude=='0') {
				showError("Please enter address correctly to get getlocation.\n You might not be supported Nearby Service.");					
				return false;
			}
			setGeolocation($('#range-value').val(), cat_id, 1);		
		});
	</script>
@endsection

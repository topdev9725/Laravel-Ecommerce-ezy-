
		@if(count($vendors) != 0)
		<div class="row ezy-row-nopadding" style="padding-left: 20px;padding-right: 20px">
			@foreach($vendors as $vendor)
				<div class="col-lg-3 col-md-6 col-12 ezy-custom-responsive ezy-col-xl-5">
					<div class="card ezy-custom-card">
						<div class="row">
							<div class="col-lg-12 col-md-5 col-5 ezy-responsive-store">
								<a href="{{ route('front.vendor', [str_replace(' ', '-', $vendor['shop_name']), $vendor['id'], 1]) }}" target="_blank" class="banner-effect text-center">
									<img class="ezy-store-img" src="{{ !empty($vendor['shop_logo'])?asset('assets/images/vendorlogo/'.$vendor['shop_logo']):asset('assets/images/vendorlogo/default_logo.jpg') }}" alt="">
								</a>
							</div>
							<div class="col-lg-12 col-md-7 col-7">
								<p class="ezy-store-name">{{ $vendor['shop_name'] }}</p>
								<!-- @php
									$products = DB::table('products')->where('user_id', '=', $vendor['id'])->take(4)->get();
									$product_names = '';
									if(count($products) != 0) {
										foreach($products as $product) {
											$product_names .= $product->name.', ';
										}
										$product_names = substr($product_names, 0, -2);
									}
								@endphp
								<p class="ezy-store-product"><b>Products</b> : {{$product_names}}</p> -->
								<p class="ezy-store-product">{{ $vendor['shop_address'] }}</p>
							</div>
							<div class="col-lg-4 col-md-5 col-5 text-center">
								<i class='fas fa-star ezy-review' style="font-size: 16px!important">&nbsp; {{isset(Session::get('every_shop_ratings')[$vendor['id']])?number_format(Session::get('every_shop_ratings')[$vendor['id']],2):'0.00'}}</i>
							</div>
							<div class="col-lg-8 col-md-7 col-7 text-center">
								<i class="far fa-clock ezy-distance-time1" style="color: #797981;font-size: 16px!important">&nbsp; {{ $vendor['opening_hours'] }} : {{ number_format($vendor['distance'], 1) }} km</i>
							</div>
							@php
								$waze = 'll='.$vendor['shop_latitude'].','.$vendor['shop_longitude'];
							@endphp
							<div class="col-lg-12 text-right waze">
								<a href="{{ 'waze://?'.$waze.'&navigate=yes'}}" class="waze-btn" target="_blank"><img class="waze-img" src="{{asset('assets/images/waze.png')}}" alt=""></a>
							</div>
						</div>
					</div>
				</div>
			@endforeach	
		</div>
		@else
		<div class="col-lg-12 text-center">
			<p style="font-size: 22px;margin-bottom: 50px;font-family: SanomatGrabApp">No stores near the area</p>
		</div>
		@endif


<div class="row ezy-row-nopadding" style="padding-left: 20px;padding-right: 20px">
	@foreach($nearby_stores as $nearby_store)
	<div class="col-lg-3 col-md-6 col-12 ezy-custom-responsive">
		<div class="card ezy-custom-card1">
			<div class="row">
				<div class="col-lg-12 col-md-5 col-5 ezy-responsive-store">
					<a href="{{ route('front.vendor',str_replace(' ', '-', $nearby_store->shop_name)).'?vendor_id='.$nearby_store->id.'&&store_type=1' }}" class="banner-effect text-center">
						<img class="ezy-store-img" src="{{ empty($nearby_store->shop_logo)?asset('assets/images/vendorlogo/default_logo.jpg'):asset('assets/images/vendorlogo/'.$nearby_store->shop_logo) }}" alt="">
					</a>
				</div>
				<div class="col-lg-12 col-md-7 col-7">
					<p class="ezy-store-name1">{{ $nearby_store->shop_name }}</p>
					<p class="ezy-store-product1">Products : Orange, Banana, Apple, Mango</p>
				</div>
				<div class="col-lg-4 col-md-4 col-4 text-center p-0">
					<i class='fas fa-star ezy-review1'>&nbsp; 4.5</i>
				</div>
				<div class="col-lg-8 col-md-8 col-8 text-center p-0">
					<i class="far fa-clock ezy-distance-time1">&nbsp; {{ $nearby_store->opening_hours }} : {{ number_format($nearby_store->distance, 1) }}km</i>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>
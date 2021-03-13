
		@if(count($vendors) != 0)
		<div class="row ezy-row-nopadding nearby-autodebit-block">
			@foreach($vendors as $vendor)
				<div class="col-lg-3 col-md-6 col-12 ezy-custom-responsive ezy-col-xl-5">
					<div class="card ezy-custom-card nearby-autodebit-store" style="border: 5px solid #1c9dec !important;">
						<div class="row">
							<div class="col-lg-12 col-md-5 col-5 ezy-responsive-store">
								<a href="javascript:nearby_autodebit('{{ $vendor->shop_name }}')" class="banner-effect text-center">
									<img class="ezy-store-img" src="{{ !empty($vendor->shop_logo)?asset('assets/images/vendorlogo/'.$vendor->shop_logo):asset('assets/images/vendorlogo/default_autodebit_logo.jpg') }}" alt="">
								</a>
							</div>
							<div class="col-lg-12 col-md-7 col-7 text-center">
								<p class="ezy-store-name text-uppercase" style="color:#0075ff!important;font-style: initial;">{{ $vendor->shop_name }}</p>
								<p class="ezy-store-product" style="color:#0148bc !important;letter-spacing:0px !important">{{ $vendor->shop_address }}</p>
							</div>
							<!-- <div class="col-lg-4 col-md-5 col-5 text-center">
								<i class='fas fa-star ezy-review' style="font-size: 16px!important">&nbsp; 4.5</i>
							</div> -->
							<div class="col-lg-12 col-md-12 col-12 text-center">
								<i class="far fa-clock ezy-distance-time1" style="color: #797981;font-size: 16px!important">&nbsp; {{ $vendor->opening_hours }}</i>
							</div>
						</div>
					</div>
				</div>
			@endforeach	
		</div>
		@else
		<div class="col-lg-12 text-center">
			<p style="font-size: 22px;margin: 200px 0px;font-family: SanomatGrabApp">No stores near the area</p>
		</div>
		@endif


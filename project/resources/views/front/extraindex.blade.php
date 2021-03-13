@if($ps->hot_sale == 1)

<!-- Clothing and Apparel Area Start -->
<section class="product-tab">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 remove-padding">
				<div class="section-top">
					<h2 class="section-title">
						{{ $langg->lang832 }}
					</h2>
					<ul class="nav">
						<li class="nav-item">
							<a class="nav-link active" id="pills-tab1-tab" data-toggle="pill" href="#pills-tab1" role="tab" aria-controls="pills-tab1" aria-selected="false">{{ $langg->lang30 }}</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="pills-tab2-tab" data-toggle="pill" href="#pills-tab2" role="tab" aria-controls="pills-tab2" aria-selected="true">{{ $langg->lang31 }}</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="pills-tab3-tab" data-toggle="pill" href="#pills-tab3" role="tab" aria-controls="pills-tab3" aria-selected="false">{{ $langg->lang32 }}</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="pills-tab4-tab" data-toggle="pill" href="#pills-tab4" role="tab" aria-controls="pills-tab4" aria-selected="false">{{ $langg->lang33 }}</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="tab-content">
					<div class="tab-pane fade active show" id="pills-tab1" role="tabpanel" aria-labelledby="pills-tab1-tab">
						<div class="row">
								@foreach($hot_products as $prod)
									@include('includes.product.list-product')
								@endforeach
						</div>
					</div>
					<div class="tab-pane fade" id="pills-tab2" role="tabpanel" aria-labelledby="pills-tab2-tab">
						<div class="row">
								@foreach($latest_products as $prod)
									@include('includes.product.list-product')
								@endforeach
						</div>
					</div>
					<div class="tab-pane fade" id="pills-tab3" role="tabpanel" aria-labelledby="pills-tab3-tab">
						<div class="row">
								@foreach($trending_products as $prod)
									@include('includes.product.list-product')
								@endforeach
						</div>
					</div>
					<div class="tab-pane fade" id="pills-tab4" role="tabpanel" aria-labelledby="pills-tab4-tab">
							<div class="row">
									@foreach($sale_products as $prod)
									@include('includes.product.list-product')
								@endforeach
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Clothing and Apparel Area start -->

@endif

@if($ps->best == 1)
<!-- Phone and Accessories Area Start -->
<section class="phone-and-accessories categori-item">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 remove-padding">
				<div class="section-top">
					<h2 class="section-title">
						{{ $langg->lang27 }}
					</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="row">
					@foreach($best_products as $prod)
					@include('includes.product.home-product')
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Phone and Accessories Area start-->
@endif

	@if($ps->flash_deal == 1)
		<!-- Electronics Area Start -->
		<section class="categori-item electronics-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								{{ $langg->lang244 }}
							</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="flash-deals">
							<div class="flas-deal-slider">

								@foreach($discount_products as $prod)
									@include('includes.product.flash-product')
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Electronics Area start-->
	@endif

	@if($ps->large_banner == 1)
		<!-- Banner Area One Start -->
		<section class="banner-section">
			<div class="container">
				@foreach($large_banners->chunk(1) as $chunk)
					<div class="row">
						@foreach($chunk as $img)
							<div class="col-lg-12 remove-padding">
								<div class="img">
									<a class="banner-effect" href="{{ $img->link }}">
										<img src="{{asset('assets/images/banners/'.$img->photo)}}" alt="">
									</a>
								</div>
							</div>
						@endforeach
					</div>
				@endforeach
			</div>
		</section>
		<!-- Banner Area One Start -->
	@endif

	@if($ps->top_rated == 1)
		<!-- Electronics Area Start -->
		<section class="categori-item electronics-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								{{ $langg->lang28 }}
							</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="row">

							@foreach($top_products as $prod)
								@include('includes.product.top-product')
							@endforeach

						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Electronics Area start-->
	@endif

	@if($ps->bottom_small == 1)
		<!-- Banner Area One Start -->
		<section class="banner-section">
			<div class="container">
				@foreach($bottom_small_banners->chunk(3) as $chunk)
					<div class="row">
						@foreach($chunk as $img)
							<div class="col-lg-4 col-md-6 remove-padding">
								<div class="left">
									<a class="banner-effect" href="{{ $img->link }}" target="_blank">
										<img src="{{asset('assets/images/banners/'.$img->photo)}}" alt="">
									</a>
								</div>
							</div>
						@endforeach
					</div>
				@endforeach
			</div>
		</section>
		<!-- Banner Area One Start -->
	@endif

	@if($ps->big == 1)
	<!-- Clothing and Apparel Area Start -->
	<section class="categori-item clothing-and-Apparel-Area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 remove-padding">
					<div class="section-top">
						<h2 class="section-title">
							{{ $langg->lang29 }}
						</h2>

					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						@foreach($big_products as $prod)
						@include('includes.product.home-product')
						@endforeach
					</div>
				</div>
			</div>
		</div>
		</div>
	</section>
	<!-- Clothing and Apparel Area start-->
@endif

@if($ps->partners == 1)
<!-- Partners Area Start -->
<section class="brand-section partners">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-top">
						<h2 class="section-title">
							{{ $langg->lang236 }}
						</h2>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12 padding-decrease">
					<div class="brand-slider">
						@foreach($partners->chunk(2) as $partner)
							<div class="slide-item">
								@foreach($partner as $data)
									<a href="{{ $data->link }}" target="_blank" class="brand">
										<img src="{{ asset('assets/images/partner/'.$data->photo) }}" alt="">
									</a>
								@endforeach		
							</div>						
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Partners Area End -->
@endif



	<!-- main -->
	<script src="{{asset('assets/front/js/mainextra.js')}}"></script>
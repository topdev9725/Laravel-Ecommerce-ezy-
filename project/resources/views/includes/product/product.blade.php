@foreach($vprods as $prod)
	<div class="col-lg-3 col-md-6 col-12 remove-padding ezy-product-content">
		<!-- <a href="{{ route('front.product1', $prod->slug).'?store_type='.$store_type }}" class="item card"> -->
		<div class="item card">
			<div class="row">
				<div class="col-lg-12 col-md-5 col-5 item-img">
					@if(!empty($prod->features))
					<div class="sell-area">
						@foreach($prod->features as $key => $data1)
						<span class="sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
						@endforeach
					</div>
					@endif
					<a href="{{ route('front.product1', $prod->slug).'?store_type='.$store_type }}">
					<img class="img-fluid"
						src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"
						alt="">
					</a>
				</div>
				<div class="col-lg-12 col-md-7 col-7 info ezy-vendor-product">
					<h5 class="name">{{ $prod->showName() }}</h5>
					<h4 class="price">{{ $prod->setCurrency() }} <del><small>{{ $prod->showPreviousPrice() }}</small></del></h4>
					<div class="stars">
						<div class="ratings">
							<div class="empty-stars"></div>
							<div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
						</div>
					</div>
					<div class="item-cart-area">
						<ul class="item-cart-options">
							<li>
								<span href="javascript:;" class="add-to-cart1"  id="addcrt1" data-toggle="tooltip"
									data-placement="top" data-value="{{ $prod->id }}" title="Add To Cart" >
									<i class="icofont-cart"></i>
								</span>
								<input type="hidden" name="price" value="{{ $prod->price }}">
							</li>
							<li>
								<span  class="quick-view" rel-toggle="tooltip" title="{{ $langg->lang55 }}" href="javascript:;" data-href="{{ route('product.quick',$prod->id) }}" data-toggle="modal" data-target="#quickview" data-placement="top">
										<i class="fas fa-shopping-basket"></i>
								</span>
							</li>
							<li>
									@if(Auth::guard('web')->check())
		
									<span href="javascript:;" class="add-to-wish"
										data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"
										data-placement="top" title="{{ $langg->lang54 }}"><i
											class="icofont-heart-alt"></i>
									</span>
		
									@else
		
									<span href="javascript:;" rel-toggle="tooltip" title="{{ $langg->lang54 }}"
										data-toggle="" id="wish-btn" data-target="#comment-log-reg"
										data-placement="top">
										<i class="icofont-heart-alt"></i>
									</span>
		
									@endif
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- </a> -->
	
	</div>
@endforeach

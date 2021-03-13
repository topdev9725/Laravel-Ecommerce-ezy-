<div class="col-lg-3 col-md-4 col-6 remove-padding">
		<a class="item" href="{{ route('front.product', $prod->slug) }}">
			<div class="item-img">
				@if(!empty($prod->features))
				<div class="sell-area">
					@foreach($prod->features as $key => $data1)
					<span class="sale"
						style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
					@endforeach
				</div>
				@endif
				<img class="img-fluid"
					src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}"
					alt="">
			</div>
			<div class="info">
				<h5 class="name">{{ $prod->showName() }}</h5>
				<h4 class="price">{{ $prod->showPrice() }}
					<del><small>{{ $prod->showPreviousPrice() }}</small></del></h4>
				<div class="stars">
					<div class="ratings">
						<div class="empty-stars"></div>
						<div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
					</div>
				</div>
				<div class="item-cart-area">

					<ul class="item-cart-options">
						<li>
								@if(Auth::guard('web')->check())

								<span href="javascript:;" class="add-to-wish"
									data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip"
									data-placement="top" title="{{ $langg->lang54 }}"><i
										class="icofont-heart-alt"></i>
								</span>

								@else

								<span href="javascript:;" rel-toggle="tooltip" title="{{ $langg->lang54 }}"
									data-toggle="modal" id="wish-btn" data-target="#comment-log-reg"
									data-placement="top">
									<i class="icofont-heart-alt"></i>
								</span>

								@endif
						</li>
						<li>
							<span  class="quick-view" rel-toggle="tooltip" title="{{ $langg->lang55 }}" href="javascript:;" data-href="{{ route('product.quick',$prod->id) }}" data-toggle="modal" data-target="#quickview" data-placement="top">
									<i class="fas fa-shopping-basket"></i>
							</span>
						</li>
						<li>
								<span href="javascript:;" class="add-to-compare"
								data-href="{{ route('product.compare.add',$prod->id) }}" data-toggle="tooltip"
								data-placement="top" title="{{ $langg->lang57 }}" >
								<i class="icofont-exchange"></i>
							</span>
						</li>
					</ul>
				</div>
			</div>
		</a>
	</div>
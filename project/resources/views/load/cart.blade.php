									@if(Session::has('cart'))
										<div class="dropdownmenu-wrapper">
												<div class="dropdown-cart-header">
													<span class="item-no">
														<span class="cart-quantity" style="background: white !important">
									{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}
														</span> {{ $langg->lang4 }}
													</span>

													<a class="view-cart" href="{{ route('front.cart') }}">
													{{ $langg->lang5 }}
													</a>
												</div><!-- End .dropdown-cart-header -->
												<ul class="dropdown-cart-products">
													@foreach(Session::get('cart')->items as $product)
														@php
															$category_id = DB::table('products')->where('id', $product['item']['id'])->first()->category_id;
															$product_store_type = DB::table('categories')->where('id', $category_id)->first()->store_type;
														@endphp
														<li class="product cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}">
															<div class="product-details">
																<div class="content">
																	<a href="{{ route('front.product1',$product['item']['slug']).'?store_type='.$product_store_type }}"><h4 class="product-title">{{mb_strlen($product['item']['name'],'utf-8') > 45 ? mb_substr($product['item']['name'],0,45,'utf-8').'...' : $product['item']['name']}}</h4></a>

																	<span class="cart-product-info">
																		<span class="cart-product-qty" id="cqt{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{$product['qty']}}</span><span>{{ $product['item']['measure'] }}</span>
																		x <span id="">{{ App\Models\Product::convertPrice($product['item']['price']) }}</span>
																	</span>
																</div>
															</div><!-- End .product-details -->

															<figure class="product-image-container">
																<a href="{{ route('front.product1', $product['item']['slug']).'?store_type='.$product_store_type }}" class="product-image">
																	<img src="{{ $product['item']['photo'] ? filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ?$product['item']['photo']:asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" alt="product">
																</a>
																<div class="cart-remove" data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}" title="Remove Product">
																	<i class="icofont-close"></i>
																</div>
															</figure>
														</li><!-- End .product -->
													@endforeach
												</ul><!-- End .cart-product -->

												<div class="dropdown-cart-total">
														<span>{{ $langg->lang6 }}</span>

														<span class="cart-total-price">
															<span class="cart-total">{{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}
															</span>
														</span>
												</div><!-- End .dropdown-cart-total -->

												<div class="dropdown-cart-action">
														<a href="{{ route('front.cart') }}" class="mybtn1">{{ $langg->lang7 }}</a>
												</div><!-- End .dropdown-cart-total -->
										</div>
									@else 
									<p class="mt-1 pl-3 text-left">{{ $langg->lang8 }}</p>
									@endif
@extends('layouts.front')

@section('styles')

<style type="text/css">
	.root.root--in-iframe {
		background: #4682b447 !important;
	}

	@media only screen and (max-width: 767px) {  
		.checkout-area .content-box .content .title {
			font-size: 16px !important;
		}

		.checkout-area .content-box .content .form-control {
			height: 32px !important;
			font-size: 12px !important;
		}

		.ezy-order-btn {
			width: 100% !important;
			padding: 4px !important;
			margin: 5px 0px;
			font-size: 14px !important;
		}

		h3 {
			font-size: 18px !important;
		}

		.checkout-area .content-box .content .order-area .order-item .product-content .name a {
			font-size: 16px !important; 
		}

		.checkout-area .content-box .content .order-area .order-item .product-img img {
			margin-right: 10px !important;
		}

		.checkout-area .content-box .content .order-area .order-item .product-content .unit-price p,
		.checkout-area .content-box .content .order-area .order-item .product-content .unit-price .label,
		.checkout-area .content-box .content .order-area .order-item .product-content .quantity .label,
		.checkout-area .content-box .content .order-area .order-item .product-content .total-price .label,
		.checkout-area .content-box .content .order-area .order-item .product-content .total-price p {
			font-size: 12px !important;
		}
	}
</style>

@endsection



@section('content')

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="pages">
					<li>
						<a href="{{ route('front.index') }}">
							{{ $langg->lang17 }}
						</a>
					</li>
					<li>
						<a href="{{ route('front.checkout') }}">
							{{ $langg->lang136 }}
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- Breadcrumb Area End -->

	<!-- Check Out Area Start -->
	<section class="checkout">
		<div class="container">
			<div class="row">

				<div class="col-lg-12">
					<div class="checkout-area mb-0 pb-0">
						<div class="checkout-process">
							<ul class="nav"  role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-step1-tab" data-toggle="pill" href="#pills-step1" role="tab" aria-controls="pills-step1" aria-selected="true">
									<span>1</span> {{ $langg->lang743 }}
									<i class="far fa-address-card"></i>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link disabled" id="pills-step2-tab" data-toggle="pill" href="#pills-step2" role="tab" aria-controls="pills-step2" aria-selected="false" >
										<span>2</span> {{ $langg->lang744 }} 
										<i class="fas fa-dolly"></i>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link disabled" id="pills-step3-tab" data-toggle="pill" href="#pills-step3" role="tab" aria-controls="pills-step3" aria-selected="false">
											<span>3</span> {{ $langg->lang745 }}
											<i class="far fa-credit-card"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>


			</div>
			<div class="row">

				<div class="col-lg-8 order-last order-lg-first">

		<form id="twocheckout" action="" method="GET" class="checkoutform">

			@include('includes.form-success')
			@include('includes.form-error')

			{{ csrf_field() }}

					<div class="checkout-area">
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-step1" role="tabpanel" aria-labelledby="pills-step1-tab">
								<div class="content-box">
								
									<div class="content">
										<div class="personal-info">
											<h5 class="title">
												{{ $langg->lang746 }} :
											</h5>
											<div class="row">
												<div class="col-lg-6">
													<input type="text" id="personal-name" class="form-control" name="personal_name" placeholder="{{ $langg->lang747 }}" value="{{ Auth::check() ? Auth::user()->name : '' }}" {!! Auth::check() ? 'readonly' : '' !!}>
												</div>
												<div class="col-lg-6">
													<input type="email" id="personal-email" class="form-control" name="personal_email" placeholder="{{ $langg->lang748 }}" value="{{ Auth::check() ? Auth::user()->email : '' }}"  {!! Auth::check() ? 'readonly' : '' !!}>
												</div>
											</div>
											@if(!Auth::check())
											<div class="row">
												<div class="col-lg-12 mt-3">
														<input class="styled-checkbox" id="open-pass" type="checkbox" value="1" name="pass_check">
														<label for="open-pass">{{ $langg->lang749 }}</label>
												</div>
											</div>
											<div class="row set-account-pass d-none">
												<div class="col-lg-6">
													<input type="password" name="personal_pass" id="personal-pass" class="form-control" placeholder="{{ $langg->lang750 }}">
												</div>
												<div class="col-lg-6">
													<input type="password" name="personal_confirm" id="personal-pass-confirm" class="form-control" placeholder="{{ $langg->lang751 }}">
												</div>
											</div>
											@endif
										</div>
										@if(Auth::check())
										<div class="billing-address">
											<h5 class="title">
												{{ $langg->lang834 }}
											</h5>
											<div class="row">
												<div class="col-lg-3 col-md-6 col-12">
													<p id="wallet-ballance" style="margin:0px 15px;color: green">{{ App\Models\Product::vendorConvertPrice(Auth::user()->balance) }}</p>
												</div>
												<div class="col-lg-9 col-md-6 col-12">
													<a href="{{ route('user-deposit-index') }}" class="btn btn-primary ezy-order-btn">Deposit</a>
												</div>
											</div>
										</div>
										<div class="ship-diff-addres-area">
												<h5 class="title">
														{{ $langg->lang752 }}
												</h5>
											<div class="row">
												<div class="col-lg-6">
													<input class="form-control ship_input" type="text" name="shipping_name"
														id="shippingFull_name" placeholder="{{ $langg->lang152 }}" value="{{ Session::has('shipping_name') ? Session::get('shipping_name') : Auth::guard('web')->user()->name }}" required="">
														<input type="hidden" name="shipping_email" value="">
												</div>
												<div class="col-lg-6">
													<input class="form-control ship_input" type="text" name="shipping_phone"
														id="shipingPhone_number" placeholder="{{ $langg->lang153 }}" value="{{ Session::has('shipping_phone') ? Session::get('shipping_phone') : Auth::guard('web')->user()->phone }}" required="">
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<input class="form-control ship_input" type="text" name="shipping_address"
														id="shipingAddress" placeholder="{{ $langg->lang155 }}" value="{{ Session::has('shipping_address') ? Session::get('shipping_address') : Auth::guard('web')->user()->address }}" required="">
												</div>

												<div class="col-lg-6">
													<!-- <select class="form-control ship_input" name="shipping_country">
														@include('includes.countries')
													</select> -->
													<input class="form-control ship_input" type="text" name="country" readonly value="Malaysia">
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<input class="form-control ship_input" type="text" name="shipping_city"
														id="shipping_city" placeholder="{{ $langg->lang158 }}" value="{{ Session::has('shipping_city') ? Session::get('shipping_city') : Auth::guard('web')->user()->city }}" required="">
												</div>
												<div class="col-lg-6">
													<!-- <input class="form-control ship_input" type="text" name="shipping_state"
														id="shipping_state" placeholder="{{ $langg->lang830 }}"> -->
													<select class="form-control ship_input" name="shipping_state" id="shipping_state" required>
														@include('includes.states')
													</select>
												</div>
											</div>

											<div class="row">
												<div class="col-lg-6">
													<input class="form-control ship_input" type="text" name="shipping_zip"
														id="shippingPostal_code" placeholder="{{ $langg->lang159 }}" value="{{ Session::has('shipping_zip') ?  Session::get('shipping_zip') : Auth::guard('web')->user()->zip }}" required="">
												</div>
											</div>
										</div>
										@endif

										<!-- <div class="order-note mt-3">
											<div class="row">
												<div class="col-lg-12">
												<input type="text" id="Order_Note" class="form-control" name="order_notes" placeholder="{{ $langg->lang217 }} ({{ $langg->lang218 }})" required="">
												</div>
											</div>
										</div> -->
										<div class="row">
											<div class="col-lg-12  mt-3">
												<div class="bottom-area paystack-area-btn">
													<button type="submit"  class="btn btn-primary ezy-order-btn" id="first-step-btn">{{ $langg->lang753 }}</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="pills-step2" role="tabpanel" aria-labelledby="pills-step2-tab">
								<div class="content-box">
									<div class="content">
										
										<div class="order-area">
										    <!-- @php
										        $updated_shop_price = 0;
										    @endphp -->
											@foreach(Session::get('final_results') as $vendor_id => $products)
											<h3 style="margin:20px 0px !important;">{{ DB::table('users')->where('id', $vendor_id)->first()->shop_name }}</h3>
												@foreach($products as $product)
													<!-- @php
													    $updated_shop_price += $product['price'];
													@endphp -->
													<div class="order-item">
														<div class="product-img">
															<div class="d-flex">
																<img src=" {{ asset('assets/images/products/'.$product['item']['photo']) }}"
																	height="80" width="80" class="p-1">

															</div>
														</div>
														<div class="product-content">
															<p class="name"><a
																	href="{{ route('front.product', $product['item']['slug']) }}"
																	target="_blank">{{ $product['item']['name'] }}</a></p>
															<div class="unit-price">
																<h5 class="label">{{ $langg->lang754 }} : </h5>
																<p>{{ App\Models\Product::convertPrice($product['item']['price']) }}</p>
															</div>
															@if(!empty($product['size']))
															<div class="unit-price">
																<h5 class="label">{{ $langg->lang312 }} : </h5>
																<p>{{str_replace('-',' ',$product['size'])}}</p>
															</div>
															@endif
															@if(!empty($product['color']))
															<div class="unit-price">
																<h5 class="label">{{ $langg->lang313 }} : </h5>
																<span id="color-bar" style="border: 10px solid {{$product['color'] == "" ? "white" : '#'.$product['color']}};"></span>
															</div>
															@endif
															@if(!empty($product['keys']))

															@foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values']))  as $key => $value)

																<div class="quantity">
																	<h5 class="label">{{ ucwords(str_replace('_', ' ', $key))  }} : </h5>
																	<span class="qttotal">{{ $value }} </span>
																</div>
															@endforeach

															@endif
															<div class="quantity">
																<h5 class="label">{{ $langg->lang755 }} : </h5>
																<span class="qttotal">{{ $product['qty'] }} </span>
															</div>
															<div class="total-price">
																<h5 class="label">{{ $langg->lang756 }} : </h5>
																<p>{{ App\Models\Product::convertPrice($product['price']) }}
																</p>
															</div>
														</div>
													</div>
												@endforeach
											@endforeach
										</div>



										<div class="row">
											<div class="col-lg-12 mt-3">
												<div class="bottom-area">
													<a href="javascript:;" id="step1-btn"  class="btn btn-primary ezy-order-btn mr-3" style="width: 96px">{{ $langg->lang757 }}</a>
													<a href="javascript:;" id="step3-btn"  class="btn btn-primary ezy-order-btn">{{ $langg->lang753 }}</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="pills-step3" role="tabpanel" aria-labelledby="pills-step3-tab">
								<div class="content-box">
									<div class="content">

											<div class="billing-info-area {{ $digital == 1 ? 'd-none' : '' }}">
															<h4 class="title">
																	{{ $langg->lang758 }}
															</h4>
													<ul class="info-list">
														<li>
															<p id="shipping_user"></p>
														</li>
														<li>
															<p id="shipping_location"></p>
														</li>
														<li>
															<p id="shipping_phone"></p>
														</li>
														<!-- <li>
															<p id="shipping_email"></p>
														</li> -->
													</ul>
											</div>
											<div class="payment-information">
													<h4 class="title">
														{{ $langg->lang759 }}
													</h4>
												<div class="row">
													<div class="col-lg-12">
													
														<div class="nav flex-column"  role="tablist" aria-orientation="vertical">
															<a class="nav-link payment" data-val="0" data-show="no" data-form="{{ route('wallet.submit') }}" id="v-pills-tab1-tab" data-toggle="pill" href="#v-pills-tab1" role="tab" aria-controls="v-pills-tab1" aria-selected="true">
																	<div class="icon">
																			<span class="radio"></span>
																	</div>
																<p>
																		Wallet

																	<small>
																			Pay via your wallet
																	</small>

																</p>
															</a>
															<a class="nav-link payment" data-val="1" data-show="yes" data-form="https://devmember.pamm.network/api/v1/integration/merchant/init" data-href="" id="v-pills-tab2-tab" data-toggle="pill" href="#v-pills-tab2" role="tab" aria-controls="v-pills-tab2" aria-selected="false">
																	<div class="icon">
																			<span class="radio"></span>
																	</div>
																<p>
																		Prime

																	<small>
																		Pay via your prime account
																	</small>

																</p>
															</a>
															<input type="hidden" id="status" value="0" >
														</div>
													</div>
												</div>
											    
											</div>
											
										<div class="row">
											<div class="col-lg-12 mt-3">
												<div class="bottom-area">
													<a href="javascript:;" id="step2-btn" class="btn btn-primary ezy-order-btn mr-3" style="width: 115px">{{ $langg->lang757 }}</a>
													<button type="submit" id="final-btn" class="btn btn-primary ezy-order-btn">
														Place Order
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


                            <input type="hidden" id="shipping-cost" name="shipping_cost" value="0">
							<input type="hidden" id="packing-cost" name="packing_cost" value="0">
							@foreach($shipping_data as $data)
								<input type="hidden" id="shipping-title" name="shipping_title" value="{{ $data->title }}">
							@break
							@endforeach
							@foreach($package_data  as $data)
								<input type="hidden" id="packing-title" name="packing_title" value="{{ $data->title }}">
							@break
							@endforeach
                            <input type="hidden" name="dp" value="{{$digital}}">
                            <input type="hidden" name="tax" value="{{$gs->tax}}">
                            <input type="hidden" name="totalQty" value="{{$totalQty}}">
                            <input type="hidden" name="vendor_shipping_id" value="{{ $vendor_shipping_id }}">
                            <input type="hidden" name="vendor_packing_id" value="{{ $vendor_packing_id }}">


							@if(Session::has('coupon_total'))
                            	<input type="hidden" name="total" id="grandtotal" value="{{ $totalPrice }}">
                            	<input type="hidden" id="tgrandtotal" value="{{ $totalPrice }}">
							@elseif(Session::has('coupon_total1'))
								<input type="hidden" name="total" id="grandtotal" value="{{ preg_replace("/[^0-9,.]/", "", Session::get('coupon_total1') ) }}">
								<input type="hidden" id="tgrandtotal" value="{{ preg_replace("/[^0-9,.]/", "", Session::get('coupon_total1') ) }}">
							@else
                            	<input type="hidden" name="total" id="grandtotal" value="{{round($totalPrice * $curr->value,2)}}">
                            	<input type="hidden" id="tgrandtotal" value="{{round($totalPrice * $curr->value,2)}}">
							@endif
                            <input type="hidden" id="wallet-price" name="wallet_price" value="0">

                            <input type="hidden" name="coupon_code" id="coupon_code" value="{{ Session::has('coupon_code') ? Session::get('coupon_code') : '' }}">
                            <input type="hidden" name="coupon_discount" id="coupon_discount" value="{{ Session::has('coupon') ? Session::get('coupon') : '' }}">
                            <input type="hidden" name="coupon_id" id="coupon_id" value="{{ Session::has('coupon') ? Session::get('coupon_id') : '' }}">
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->id : '' }}">
							
                            <input type="hidden" id="final_price" name="amount" value="">

</form>

				</div>

				@if(Session::has('cart'))
				<div class="col-lg-4">
					<div class="right-area" style="display: none" id="total_description">
						<div class="order-box">
						<h4 class="title">
							<!-- {{ $langg->lang127 }} -->
							Total Description
						</h4>
						<ul class="order-list">
							<li>
								<p>
									<!--{{ $langg->lang128 }}-->
									Total
								</p>
								<P>
									<b class="cart-total" id="total-price">{{ App\Models\Product::convertPrice($totalPrice) }}</b>
									<input type="hidden" value="{{ $totalPrice }}" id="total_price">
								</P>
							</li>
							<li>
								<p>
									Delivery Fee
								</p>
								<P>
									<b
									class="cart-total" id="delivery_fee"></b>
								</P>
							</li>
							<div id="store_delvery_fee">
							</div>
							<li>
								<P style="font-size:12px !important;color:#b1a9a9!important" id="delivery_fee_description">
								</P>
							</li>
							<li>
								<p>
									Delivery Coupon
								</p>
								<P>
									<b class="cart-total" id="delivery_coupon"></b>
								</P>
							</li>
							<div id="store_delivery_coupon">
							</div>

							@if($gs->tax != 0)

							<li>
							<p>
								{{ $langg->lang144 }}
							</p>
							<P>
								<b> {{$gs->tax}}% </b>
								
							</P>
							</li>

							@endif




						@if(Session::has('coupon'))


							<li class="discount-bar">
							<p>
								{{ $langg->lang145 }} <span class="dpercent">{{ Session::get('coupon_percentage') == 0 ? '' : '('.Session::get('coupon_percentage').')' }}</span>
							</p>
							<P>
								@if($gs->currency_format == 0)
									<b id="discount">{{ $curr->sign }}{{ Session::get('coupon') }}</b>
								@else 
									<b id="discount">{{ Session::get('coupon') }}{{ $curr->sign }}</b>
								@endif
							</P>
							</li>


						@else 


							<li class="discount-bar d-none">
							<p>
								{{ $langg->lang145 }} <span class="dpercent"></span>
							</p>
							<P>
								<b id="discount">{{ $curr->sign }}{{ Session::get('coupon') }}</b>
							</P>
							</li>


						@endif




						</ul>

		            <!-- <div class="total-price">
		              <p>
		                {{ $langg->lang131 }}
		              </p>
		              <p>

						@if(Session::has('coupon_total'))
							@if($gs->currency_format == 0)
								<span id="total-cost">{{ $curr->sign }}{{ $totalPrice }}</span>
							@else 
								<span id="total-cost">{{ $totalPrice }}{{ $curr->sign }}</span>
							@endif

						@elseif(Session::has('coupon_total1'))
							<span id="total-cost"> {{ Session::get('coupon_total1') }}</span>
							@else
							<span id="total-cost">{{ App\Models\Product::convertPrice($totalPrice) }}</span>
						@endif

		              </p>
		            </div> -->


						<!-- <div class="cupon-box">

							<div id="coupon-link">
							<img src="{{ asset('assets/front/images/tag.png') }}">
							{{ $langg->lang132 }}
							</div>

						    <form id="check-coupon-form" class="coupon">
						        <input type="text" placeholder="{{ $langg->lang133 }}" id="code" required="" autocomplete="off">
						        <button type="submit">{{ $langg->lang134 }}</button>
						    </form>


						</div> -->

						@if($digital == 0)

						<!-- {{-- Shipping Method Area Start --}}
						<div class="packeging-area">
								<h4 class="title">{{ $langg->lang765 }}</h4>

							@foreach($shipping_data as $data)
						
								<div class="radio-design">
										<input type="radio" class="shipping" id="free-shepping{{ $data->id }}" name="shipping" value="{{ round($data->price * $curr->value,2) }}" {{ ($loop->first) ? 'checked' : '' }}> 
										<span class="checkmark"></span>
										<label for="free-shepping{{ $data->id }}"> 
												{{ $data->title }}
												@if($data->price != 0)
												+ {{ $curr->sign }}{{ round($data->price * $curr->value,2) }}
												@endif
												<small>{{ $data->subtitle }}</small>
										</label>
								</div>

							@endforeach		

						</div>
						{{-- Shipping Method Area End --}}

						{{-- Packeging Area Start --}}
						<div class="packeging-area">
								<h4 class="title">{{ $langg->lang766 }}</h4>

							@foreach($package_data as $data)	

								<div class="radio-design">
										<input type="radio" class="packing" id="free-package{{ $data->id }}" name="packeging" value="{{ round($data->price * $curr->value,2) }}" {{ ($loop->first) ? 'checked' : '' }}> 
										<span class="checkmark"></span>
										<label for="free-package{{ $data->id }}"> 
												{{ $data->title }}
												@if($data->price != 0)
												+ {{ $curr->sign }}{{ round($data->price * $curr->value,2) }}
												@endif
												<small>{{ $data->subtitle }}</small>
										</label>
								</div>

							@endforeach	

						</div>
						{{-- Packeging Area End Start--}} -->

						{{-- Final Price Area Start--}}
						<div class="final-price">
								<span>{{ $langg->lang767 }} :</span>
							<!-- @if(Session::has('coupon_total'))
								@if($gs->currency_format == 0)
									<span id="final-cost">{{ $curr->sign }}{{ $totalPrice }}</span>
								@else 
									<span id="final-cost">{{ $totalPrice }}{{ $curr->sign }}</span>
								@endif

							@elseif(Session::has('coupon_total1'))
								<span id="final-cost"> {{ Session::get('coupon_total1') }}</span>
								@else
								<span id="final-cost">{{ App\Models\Product::convertPrice($totalPrice) }}</span>
							@endif -->
							@if(Session::has('cart'))
								<span id="final-price"></span>
								<input type="hidden" id="final_price" value="">
							@endif
						</div>
						{{-- Final Price Area End --}}

						@endif

				{{-- Wallet Area Start--}}

					<div class="wallet-price" style="display:none">
							<span>{{ $langg->lang815 }}</span>

							@if($gs->currency_format == 0)
								<span id="wallet-cost"></span>
							@else 
								<span id="wallet-cost"></span>
							@endif
					</div>

					@if(Auth::check())

						@if(Auth::user()->balance > 0)

						<div class="mt-3" style="display: none">
							<input class="styled-checkbox" id="wallet" type="checkbox" value="value1">
							<label for="wallet">{{ $langg->lang816 }}</label>
						</div>
						<div class="wallet-box mt-3" style="display:none">

							<form id="wallet-form">

								@if(Session::has('coupon_total'))

								<input type="number" placeholder="{{ $langg->lang817 }}" step="0.01" id="wallet-amount" min="1" required="" value="">

								@elseif(Session::has('coupon_total1'))

								<input type="number" placeholder="{{ $langg->lang817 }}" step="0.01" id="wallet-amount" min="1" required="" value="">

								@else

								<input type="number" placeholder="{{ $langg->lang817 }}t" step="0.01" id="wallet-amount" min="1" required="" value="">

								@endif



								<button type="submit">{{ $langg->lang818 }}</button>
							</form>
	
						</div>



						@endif

					@endif


				{{-- Wallet Area End --}}

						</div>
					</div>
				</div>
				@endif
			</div>
		</div>
	</section>
		<!-- Check Out Area End-->

@if(isset($checked))

@endif

@endsection

@section('scripts')

<script src="https://js.paystack.co/v1/inline.js"></script>

<script src="//voguepay.com/js/voguepay.js"></script>

<script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>

<script type="text/javascript">
	$('a.payment:first').addClass('active');
	$('.checkoutform').prop('action',"{{ route('wallet.submit') }}");
	$($('a.payment:first').attr('href')).load($('a.payment:first').data('href'));
	var show = $('a.payment:first').data('show');
	if(show != 'no') {
		$('.pay-area').removeClass('d-none');
	}
	else {
		$('.pay-area').addClass('d-none');
	}
	$($('a.payment:first').attr('href')).addClass('active').addClass('show');
</script>


<script type="text/javascript">

var coup = 0;
var pos = {{ $gs->currency_format }};

@if(isset($checked))

	$('#myModal').modal('show');

@endif

var mship = $('.shipping').length > 0 ? $('.shipping').first().val() : 0;
var mpack = $('.packing').length > 0 ? $('.packing').first().val() : 0;
mship = parseFloat(mship);
mpack = parseFloat(mpack);

$('#shipping-cost').val(mship);
$('#packing-cost').val(mpack);
var ftotal = parseFloat($('#grandtotal').val()) + mship + mpack;
ftotal = parseFloat(ftotal);
      if(ftotal % 1 != 0)
      {
        ftotal = ftotal.toFixed(2);
      }
		if(pos == 0){
			$('#final-cost').html('{{ $curr->sign }}'+ftotal)
		}
		else{
			$('#final-cost').html(ftotal+'{{ $curr->sign }}')
		}

$('#grandtotal').val(ftotal);

$('#shipop').on('change',function(){

	var val = $(this).val();
	if(val == 'pickup'){
		$('#shipshow').removeClass('d-none');
		$("#ship-diff-address").parent().addClass('d-none');
        $('.ship-diff-addres-area').addClass('d-none');  
        $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required',false);  
	}
	else{
		$('#shipshow').addClass('d-none');
		$("#ship-diff-address").parent().removeClass('d-none');
        $('.ship-diff-addres-area').removeClass('d-none');  
        $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required',true); 
	}

});


$('.shipping').on('click',function(){
	mship = $(this).val();

$('#shipping-cost').val(mship);
var ttotal = parseFloat($('#tgrandtotal').val()) + parseFloat(mship) + parseFloat(mpack);
ttotal = parseFloat(ttotal);
      if(ttotal % 1 != 0)
      {
        ttotal = ttotal.toFixed(2);
      }
		if(pos == 0){
			$('#final-cost').html('{{ $curr->sign }}'+ttotal);
		}
		else{
			$('#final-cost').html(ttotal+'{{ $curr->sign }}');
		}
	
$('#grandtotal').val(ttotal);

})

$('.packing').on('click',function(){
	mpack = $(this).val();
$('#packing-cost').val(mpack);
var ttotal = parseFloat($('#tgrandtotal').val()) + parseFloat(mship) + parseFloat(mpack);
ttotal = parseFloat(ttotal);
      if(ttotal % 1 != 0)
      {
        ttotal = ttotal.toFixed(2);
      }

		if(pos == 0){
			$('#final-cost').html('{{ $curr->sign }}'+ttotal);
		}
		else{
			$('#final-cost').html(ttotal+'{{ $curr->sign }}');
		}	


$('#grandtotal').val(ttotal);
		
})

    $("#check-coupon-form").on('submit', function () {
		
        var val = $("#code").val();
        var total = $("#grandtotal").val();
        var ship = 0;
            $.ajax({
                    type: "GET",
                    url:mainurl+"/carts/coupon/check",
                    data:{code:val, total:total, shipping_cost:ship},
                    success:function(data){
                        if(data == 0)
                        {
                        	toastr.error(langg.no_coupon);
                            $("#code").val("");
                        }
                        else if(data == 2)
                        {
                        	toastr.error(langg.already_coupon);
                            $("#code").val("");
                        }
                        else
                        {
                            $("#check-coupon-form").toggle();
                            $(".discount-bar").removeClass('d-none');

							if(pos == 0){
								$('#total-cost').html('{{ $curr->sign }}'+data[0]);
								$('#discount').html('{{ $curr->sign }}'+data[2]);
							}
							else{
								$('#total-cost').html(data[0]+'{{ $curr->sign }}');
								$('#discount').html(data[2]+'{{ $curr->sign }}');
							}
								$('#grandtotal').val(data[0]);
								$('#tgrandtotal').val(data[0]);
								$('#coupon_code').val(data[1]);
								$('#coupon_discount').val(data[2]);
								if(data[4] != 0){
								$('.dpercent').html('('+data[4]+')');
								}
								else{
								$('.dpercent').html('');									
								}


var ttotal = parseFloat($('#grandtotal').val()) + parseFloat(mship) + parseFloat(mpack);
ttotal = parseFloat(ttotal);
      if(ttotal % 1 != 0)
      {
        ttotal = ttotal.toFixed(2);
      }

		if(pos == 0){
			$('#final-cost').html('{{ $curr->sign }}'+ttotal)
		}
		else{
			$('#final-cost').html(ttotal+'{{ $curr->sign }}')
		}	

                        	toastr.success(langg.coupon_found);
                            $("#code").val("");
                        }
                      }
              }); 
              return false;
    });

// Password Checking

        $("#open-pass").on( "change", function() {
            if(this.checked){
             $('.set-account-pass').removeClass('d-none');  
             $('.set-account-pass input').prop('required',true); 
             $('#personal-email').prop('required',true);
             $('#personal-name').prop('required',true);
            }
            else{
             $('.set-account-pass').addClass('d-none');   
             $('.set-account-pass input').prop('required',false); 
             $('#personal-email').prop('required',false);
             $('#personal-name').prop('required',false);

            }
        });

// Password Checking Ends


// Shipping Address Checking

		$("#ship-diff-address").on( "change", function() {
            if(this.checked){
             $('.ship-diff-addres-area').removeClass('d-none');  
             $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required',true); 
            }
            else{
             $('.ship-diff-addres-area').addClass('d-none');  
             $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required',false);  
            }
            
        });


// Shipping Address Checking Ends



// Wallet Area Starts

$('#wallet').on('change',function(){
	if(this.checked){
		$('.wallet-box').removeClass('d-none')
	}else{
		$('.wallet-box').addClass('d-none')
	}
});

</script>


<script type="text/javascript">

function currencyFormat(num) {
  return 'RM ' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

var ck = 0;

	$('.checkoutform').on('submit',function(e){
		// -------------------------------------------------------------------------------------------------
		// var state = $( "#shipping_state option:selected" ).text();
		var shipping_name = $( "#shippingFull_name" ).val();
		var shipping_phone = $( "#shipingPhone_number" ).val();
		var shipping_address = $( "#shipingAddress" ).val();
		var shipping_city = $( "#shipping_city" ).val();
		var shipping_state = $( "#shipping_state option:selected" ).val();
		var shipping_zip = $( "#shippingPostal_code" ).val();	
		var total_price = $( "#total_price" ).val();

		if(ck == 0) {
			e.preventDefault();			
			$('#pills-step2-tab').removeClass('disabled');
			$('#pills-step2-tab').click();

		} else {
			$('#preloader').show();
		}
		$('#pills-step1-tab').addClass('active');

		filter_url = '{{route('front.shipping.detail.checkout')}}' + '?state=' + shipping_state;

		$.ajax({
			method: "GET",
			url: filter_url,
			data: {
				shipping_name: shipping_name,
				shipping_phone: shipping_phone,
				shipping_address: shipping_address,
				shipping_city: shipping_city,
				shipping_state: shipping_state,
				shipping_zip: shipping_zip,
				total_price: total_price,
			},
			success:function(data)
			{
				if(data['delivery_fee'] == 'impossible') {
					toastr.error(data['shop_name'] + " can't deliver to " + shipping_state + "!");
				    $('#step3-btn').addClass('disabled');
				} else {
				// 	alert(5);
					$('#step3-btn').removeClass('disabled');
					$("#store_delvery_fee").html(data['store_delivery_fees']);
					$("#store_delivery_coupon").html(data['store_delivery_coupons']);
					$("#final-price").html(data['final_price']); 				// this final price is string
					$("#final_price").val(data['final_price_number']);			//this final price is number
					$("#wallet-amount").val(data['final_price']);
					$('#total_description').css('display', 'initial');
				}
			},
			error:function(){
				toastr.error("Failed!");
			}
		});		
	});

	$('#step1-btn').on('click',function(){
		$('#total_description').css('display', 'none');
		$('#pills-step1-tab').removeClass('active');
		$('#pills-step2-tab').removeClass('active');
		$('#pills-step3-tab').removeClass('active');
		$('#pills-step2-tab').addClass('disabled');
		$('#pills-step3-tab').addClass('disabled');

		$('#pills-step1-tab').click();

	});

// Step 2 btn DONE

	$('#step2-btn').on('click',function(){
		$('#pills-step3-tab').removeClass('active');
		$('#pills-step1-tab').removeClass('active');
		$('#pills-step2-tab').removeClass('active');
		$('#pills-step3-tab').addClass('disabled');
		$('#pills-step2-tab').click();
		$('#pills-step1-tab').addClass('active');

	});

@if(Auth::check())
	$('#step3-btn').on('click',function(){
		var total = $("#final_price").val();
		var wallet = "{{ Auth::user()->balance }}";
// 		if(total - wallet > 0) {
// 			toastr.error('Insufficient Amount!');
// 		} else {
			if($('a.payment:first').data('val') == 'paystack'){
			$('.checkoutform').prop('id','step1-form');
			}
			else if($('a.payment:first').data('val') == 'voguepay'){
				$('.checkoutform').prop('id','voguepay');
			}
			else {
				$('.checkoutform').prop('id','twocheckout');
			}
			$('#pills-step3-tab').removeClass('disabled');
			$('#pills-step3-tab').click();

			var shipping_user  = !$('input[name="shipping_name"]').val() ? $('input[name="name"]').val() : $('input[name="shipping_name"]').val();
			var shipping_location  = !$('input[name="shipping_address"]').val() ? $('input[name="address"]').val() : $('input[name="shipping_address"]').val();
			var shipping_phone = !$('input[name="shipping_phone"]').val() ? $('input[name="phone"]').val() : $('input[name="shipping_phone"]').val();
			var shipping_email= !$('input[name="shipping_email"]').val() ? $('input[name="email"]').val() : $('input[name="shipping_email"]').val();

			$('#shipping_user').html('<i class="fas fa-user"></i>'+shipping_user);
			$('#shipping_location').html('<i class="fas fas fa-map-marker-alt"></i>'+shipping_location);
			$('#shipping_phone').html('<i class="fas fa-phone"></i>'+shipping_phone);
			$('#shipping_email').html('<i class="fas fa-envelope"></i>'+shipping_email);

			$('#pills-step1-tab').addClass('active');
			$('#pills-step2-tab').addClass('active');
// 		}
	});
@endif

	$('#final-btn').on('click',function(e){
	    e.preventDefault();
		ck = 1;
		var total = $("#final_price").val();
        var status = $('#status').val();
        if (status == 1) {              // prime
			$('.checkoutform').submit()
		} else {                        //wallet
    		$.ajax({
    			type: "GET",
    			url:mainurl+"/wallet/check",
    			// data:{code:val, total:val},
    			data:{total:total},
    			success:function(data){
    				console.log(data);
    				if(data == 0)
    				{
    					toastr.error('Insufficient Amount!');
    				}
    				else
    				{
    					$("#wallet-amount").val('');
    					// $('#wallet').click();
    					$("#grandtotal").val(data[0].toFixed(2));
    					$("#tgrandtotal").val(data[0].toFixed(2));
    					$("#wallet-price").val(data[1]);
    					$('.wallet-price').removeClass('d-none');
    					if(pos == 0){
    						$('#wallet-cost').html('{{ $curr->sign }}'+data[1]);
    						$('#final-cost').html('{{ $curr->sign }}'+data[0].toFixed(2));
    					}
    					else{
    						$('#wallet-cost').html(data[1]+'{{ $curr->sign }}');
    					}
    					$('.shipping').prop('disabled',true);
    					$('.packing').prop('disabled',true);
    					$('#check-coupon-form button').prop('disabled',true);
    					$('.checkoutform').prop('action','{{ route('wallet.submit') }}');
    					$('.checkoutform').submit()
    				}
    			}
    		}); 
		}
	})


	$('.payment').on('click',function(){
		var amount = $("#final_price").val();
		$('#status').val($(this).data('val'));
		if ($(this).data('val') == 1) {			//when prime payment
			$('#final-btn').prop('disabled', true);
			$.ajax({
				type: "POST",
				url:"{{ route('front.prime') }}",
				data:$(".checkoutform").serialize(),
				// data: { amount: amount },
				success:function(data) {
					$('.checkoutform').prop('action', data['paymentUrl']);
					$('#final-btn').prop('disabled', false);
				},
				error:function(error) {
					toastr.error(error)
				}
			}); 
		} else {
			var total = $("#final_price").val();
			var wallet = "{{ Auth::check()? Auth::user()->balance : 0 }}";
			if (total - wallet < 0) {
				toastr.error('Insufficient amount')
				// $('#final-btn').addClass('disabled');
			} else {
				$('.checkoutform').prop('action',$(this).data('form'));
				// $('#final-btn').removeClass('disabled');
			}
			
		}
		
		$('input[name=amount]').val($("#final_price").val());
		$('.pay-area #v-pills-tabContent .tab-pane.fade').not($(this).attr('href')).html('');
	})


        $(document).on('submit','#step1-form',function(){
        	$('#preloader').hide();
            var val = $('#sub').val();
            var total = $('#grandtotal').val();
			total = Math.round(total);
                if(val == 0)
                {
                var handler = PaystackPop.setup({
                  key: '{{$gs->paystack_key}}',
                  email: $('input[name=email]').val(),
                  amount: total * 100,
                  currency: "{{$curr->name}}",
                  ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                  callback: function(response){
                    $('#ref_id').val(response.reference);
					$('#sub').val('1');
                    $('#final-btn').click();
                  },
                  onClose: function(){
                  	window.location.reload();
                  }
                });
                handler.openIframe();
                    return false;                    
                }
                else {
                	$('#preloader').show();
                    return true;   
                }
		});
		

		closedFunction=function() {
        alert('window closed');
    	}

     	successFunction=function(transaction_id) {
        alert('Transaction was successful, Ref: '+transaction_id)
    	}

     	failedFunction=function(transaction_id) {
         alert('Transaction was not successful, Ref: '+transaction_id)
    	}


		
        $(document).on('submit','#voguepay',function(e){
        	$('#preloader').hide();
            var val = $('#sub').val();
            var total = $('#grandtotal').val();

               if(val == 0){
					e.preventDefault();
					Voguepay.init({
					v_merchant_id: '{{ $gs->vougepay_merchant_id }}',
					total: total,
					cur: '{{ $curr->name }}',
					merchant_ref: 'ref'+Math.floor((Math.random() * 1000000000) + 1),
					memo:'{{ $gs->title }} Order',
					developer_code: '{{ $gs->vougepay_developer_code }}',
					store_id:'{{ Auth::user() ? Auth::user()->id : 0 }}',
					closed:function(){
						var newval = $('#sub').val();
						if(newval == 0){
						  window.location.reload();
						}
						else {
							$('#final-btn').click();
						}
                  	},
					success:function(transaction_id){
					$('#ref_id').val(transaction_id);
					$('#sub').val('1');
                  	},
					failed:function(){
						alert('failed');
                  		window.location.reload();
                  	}
       				});
               }
                else {
                	$('#preloader').show();
                    return true;   
                }
		});


</script>

<script type="text/javascript">
    
$(document).on('submit','#subscribe-form',function(){
    var latitude = $('#latitude1').val();
    var longitude = $('#longitude1').val();			
    if(latitude=='' || longitude=='' || latitude=='0' || longitude=='0') {
        showError("Please enter address correctly to get getlocation.\n You might not be supported Nearby Service.");					
        return false;
    }
    $('#preloader').show();
});
 var autocomplete1;

 var componentForm1 = {
		// street_number: 'short_name',
		// route: 'long_name',
		locality: 'long_name',
		administrative_area_level_1: 'short_name',
		// country: 'long_name',
		postal_code: 'short_name'
	};
function initAutocomplete1() {
    // Create the autocomplete object, restricting the search predictions to
    // geographical location types.    
    initGeoLocate1();
    if($('#autocomplete').length==0){
        return;
    }
    autocomplete1 = new google.maps.places.Autocomplete(
        document.getElementById('autocomplete1'), {types: ['geocode']});

    // Avoid paying for data that you don't need by restricting the set of
    // place fields that are returned to just the address components.
    autocomplete1.setFields(['address_component']);

    // When the user selects an address from the drop-down, populate the
    // address fields in the form.
    autocomplete1.addListener('place_changed', fillInAddress1);    
}

function fillInAddress1() {
    getGeoLocate($('#autocomplete1').val());
    // Get the place details from the autocomplete object.
	var place = autocomplete1.getPlace();

    for (var component in componentForm1) {
        if($('#'+component).length>0){
			$('#'+component).val('dasd');
            $('#'+component).prop('disabled', false);
        }
    }

    // Get each component of the address from the place details,
    // and then fill-in the corresponding field on the form.  
    var address = '';
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];    
        var val = place.address_components[i][componentForm[addressType]];        
        if(addressType == 'street_number' || addressType == 'route') {
            address += ' ' + val;
        }       
    }
    if(address != '') 
        $('#autocomplete1').val(address);
}

function getGeoLocate1(address) {
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode( 
        { 'address': address},
        function(results, status) {		            
		    if (status === "OK") {
			    if (results[0]) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();	
				    $('#latitude1').val(latitude);
                    $('#longitude1').val(longitude);                    
			    } 
		    } else {
                showError("Geocoder failed due to: " + status);
		    }
		}
    );   
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function initGeoLocate1() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
	        var geocoder = new google.maps.Geocoder();	  
	        geocoder.geocode(
		        {
		            location: geolocation
		        },
		        function(results, status) {	
		            if (status === "OK") {
			            if (results[0]) {	
                            $('#autocomplete1').val(results[0].formatted_address);
                            $('#latitude1').val(geolocation.lat);
                            $('#longitude1').val(geolocation.lng);
			            } 
		            } else {
                        showError("Geocoder failed due to: " + status);			            
		            }
		        }
	        );      
        });
    }
}

function currencyFormat(num) {
  return 'RM ' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

$(document).ready(function() {
})
</script>



@endsection
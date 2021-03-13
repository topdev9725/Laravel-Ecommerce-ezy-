@extends('layouts.front')

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
							<a href="{{ route('product.compare') }}">
								{{ $langg->lang69 }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcrumb Area End -->

	<!-- Compare Area Start -->
	<section class="compare-page">
		<div class="container">

			@if(Session::has('compare'))

			<div class="row">
				<div class="col-lg-12">
					<div class="content">
						<div class="com-heading">
							<h2 class="title">
									{{ $langg->lang70 }}
							</h2>
						</div>
						<div class="compare-page-content-wrap">
							<div class="compare-table table-responsive">
								<table class="table table-bordered mb-0">
									<tbody>
										<tr>

											<td class="first-column top">{{ $langg->lang71 }}</td>
											@foreach($products as $product)
											<td class="product-image-title c{{$product['item']['id']}}">

													<img class="img-fluid" src="{{ $product['item']['thumbnail'] ? asset('assets/images/thumbnails/'.$product['item']['thumbnail']):asset('assets/images/noimage.png') }}" alt="Compare product['item']">

												<a href="{{ route('front.product', $product['item']['slug']) }}">
													<h4 class="title">
															{{ $product['item']['name'] }}
													</h4>
												</a>
											</td>
											@endforeach
										</tr>
										<tr>
											<td class="first-column">{{ $langg->lang72 }}</td>
											@foreach($products as $product)
											<td class="pro-price c{{$product['item']['id']}}">{{ App\Models\Product::find($product['item']['id'])->showPrice() }}</td>
											@endforeach
										</tr>
										<tr>
											<td class="first-column">{{ $langg->lang73 }}</td>
											@foreach($products as $product)
											<td class="pro-ratting c{{$product['item']['id']}}">
                                                <div class="ratings">
                                                    <div class="empty-stars"></div>
                                                    <div class="full-stars" style="width:{{App\Models\Rating::ratings($product['item']['id'])}}%"></div>
                                                </div>
											</td>
											@endforeach
										</tr>

										
										
										
										<tr>
												<td class="first-column">{{ $langg->lang74 }}</td>
												@foreach($products as $product)
												<td class="pro-desc c{{$product['item']['id']}}">
													<p>{{ strip_tags($product['item']['details']) }}</p>
												</td>
												@endforeach
	
											</tr>
											<tr>
													<td class="first-column">{{ $langg->lang75 }}</td>
													@foreach($products as $product)
													<td class="c{{$product['item']['id']}}">
															@if($product['item']['product_type'] == "affiliate")
															<a href="{{ route('affiliate.product', $product['item']['slug']) }}" class="btn__bg">{{ $langg->lang251 }}</a>
															@else														
														
														<a href="javascript:;" data-href="{{ route('product.cart.add',$product['item']['id']) }}" class="btn__bg add-to-cart">{{ $langg->lang75 }}</a>
													<a href="{{ route('product.cart.quickadd',$product['item']['id']) }}" class="btn__bg">{{ $langg->lang251 }}</a>
															@endif
													</td>
													@endforeach
												</tr>
										<tr>
											<td class="first-column">{{ $langg->lang76 }}</td>
											@foreach($products as $product)
											<td class="pro-remove c{{$product['item']['id']}}">
												<i class="far fa-trash-alt compare-remove" data-href="{{ route('product.compare.remove',$product['item']['id']) }}" data-class="c{{$product['item']['id']}}"></i>
											</td>
											@endforeach
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			@else

			<div class="page-center">
				<h4 class="text-center">{{ $langg->lang60 }}</h4>              
			</div>

			@endif


		</div>
	</section>
	<!-- Compare Area End -->

@endsection
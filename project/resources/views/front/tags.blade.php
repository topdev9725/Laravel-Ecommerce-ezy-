@extends('layouts.front')
@section('content')

<!-- Breadcrumb Area Start -->
	<div class="breadcrumb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="pages">
			            <li>
			            	<a href="{{route('front.index')}}">{{ $langg->lang17 }}</a>
			            </li>
			            <li>
			            	<a href="{{route('front.tag',$tags)}}">{{ $langg->lang59 }}: {{$tags}}</a>
			            </li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<!-- Breadcrumb Area End -->

<!-- SubCategori Area Start -->
	<section class="sub-categori">
		<div class="container">
			<div class="row">

				@include('includes.catalog')

				<div class="col-lg-9 order-first order-lg-last">

					<div class="right-area">

						@if(count($products) > 0)

						@include('includes.filter')

						<div class="categori-item-area">
							<div id="ajaxContent">
								<div class="row">
									@foreach($products as $prod)
										@include('includes.product.product')
									@endforeach

								</div>
								
                			@if(isset($min) || isset($max))

						        <div class="page-center category">
						          {!! $products->appends(['min' => $min, 'max' => $max])->links() !!}          
						        </div>

						    @elseif(!empty($sort))

						        <div class="page-center category">
						          {!! $products->appends(['sort' => $sort])->links() !!}          
						        </div>

						    @else 

						        <div class="page-center category">
						          {!! $products->links() !!}                   
						        </div>

						    @endif

							</div>
						</div>
						@else
							<div class="page-center">
								<h4 class="text-center">{{ $langg->lang60 }}</h4>              
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- SubCategori Area End -->
@endsection

@section('scripts')

<script type="text/javascript">
        $("#sortby").on('change',function () {
        var sort = $("#sortby").val();
        window.location = "{{url('/tag')}}/{{$tags}}?sort="+sort;
    	});

	$(function () {
	  $("#slider-range").slider({
		range: true,
		orientation: "horizontal",
		min: 0,
		max: 1000,
		values: [{{ isset($_GET['min']) ? $_GET['min'] : '0' }}, {{ isset($_GET['max']) ? $_GET['max'] : '1000' }}],
		step: 5,
		slide: function (event, ui) {
		  if (ui.values[0] == ui.values[1]) {
			  return false;
		  }
		  
		  $("#min_price").val(ui.values[0]);
		  $("#max_price").val(ui.values[1]);
		}
	  });

	  $("#min_price").val($("#slider-range").slider("values", 0));
	  $("#max_price").val($("#slider-range").slider("values", 1));

	});
    	
</script>

@endsection
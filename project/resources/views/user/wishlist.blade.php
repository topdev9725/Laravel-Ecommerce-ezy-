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
							<a href="{{ route('user-wishlists') }}">
								{{ $langg->lang168 }}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<!-- Breadcrumb Area End -->

<!-- Wish List Area Start -->
	<section class="sub-categori wish-list">
		<div class="container">

			@if(count($wishlists))
			<div class="right-area">
				@include('includes.filter')
			<div id="ajaxContent">
			<div class="row wish-list-area">
				@foreach($wishlists as $wishlist)

				@if(!empty($sort))
					@php
						$product_id = App\Models\Wishlist::where('id', '=', $wishlist->id)->first()->product_id;
						$category_id = App\Models\Product::where('id', '=', $product_id)->first()->category_id;
						$store_stype = App\Models\Category::where('id', '=', 'category_id')->first()->store_type;
					@endphp
				<div class="col-lg-6">
					<div class="single-wish">
						<span class="remove wishlist-remove" data-href="{{ route('user-wishlist-remove', App\Models\Wishlist::where('user_id','=',$user->id)->where('product_id','=',$wishlist->id)->first()->id ) }}"><i class="fas fa-times"></i></span>
						<div class="left">
							<img src="{{ $wishlist->photo ? asset('assets/images/products/'.$wishlist->photo):asset('assets/images/noimage.png') }}" alt="">
						</div>
						<div class="right">
							<h4 class="title">
								<a href="{{ route('front.product1', $wishlist->slug).'?store_type='.$store_type }}">
								{{ $wishlist->name }}
								</a>
							</h4>
							<ul class="stars">
                                <div class="ratings">
                                    <div class="empty-stars"></div>
                                   	<div class="full-stars" style="width:{{App\Models\Rating::ratings($wishlist->id)}}%"></div>
                                </div>
							</ul>
							<div class="price">
								{{ $wishlist->showPrice() }}<small><del>{{ $wishlist->showPreviousPrice() }}</del></small>
							</div>
						</div>
					</div>
				</div>

				@else
					@php
						$product_id = App\Models\Wishlist::where('id', '=', $wishlist->id)->first()->product_id;
						$category_id = App\Models\Product::where('id', '=', $product_id)->first()->category_id;
						$store_type = App\Models\Category::where('id', '=', $category_id)->first()->store_type;
					@endphp
				<div class="col-lg-6">
					<div class="single-wish">
						<span class="remove wishlist-remove" data-href="{{ route('user-wishlist-remove',$wishlist->id) }}"><i class="fas fa-times"></i></span>
						<div class="left">
							<img src="{{ $wishlist->product->photo ? asset('assets/images/products/'.$wishlist->product->photo):asset('assets/images/noimage.png') }}" alt="">
						</div>
						<div class="right">
							<h4 class="title">
						<a href="{{ route('front.product1', $wishlist->product->slug).'?store_type='.$store_type }}">
							{{ $wishlist->product->name }}
						</a>
							</h4>
							<ul class="stars">
                                <div class="ratings">
                                    <div class="empty-stars"></div>
                                   	<div class="full-stars" style="width:{{App\Models\Rating::ratings($wishlist->product->id)}}%"></div>
                                </div>
							</ul>
							<div class="price">
								{{ $wishlist->product->showPrice() }}<small><del>{{ $wishlist->product->showPreviousPrice() }}</del></small>
							</div>
							<div class="seller-info text-left add-to-cart-wish" style="border: 0px dashed rgba(0, 0, 0, 0.3);">
								<a href="javascript:addtocart({{ $product_id }})" class="view-stor text-white wish-add-cart-btn">Add to Cart</a>
							</div>
						</div>
					</div>
				</div>

				@endif
				@endforeach

			</div>

			<div class="page-center category">
				{{ $wishlists->appends(['sort' => $sort])->links() }}
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
<!-- Wish List Area End -->

@endsection

@section('scripts')

<script type="text/javascript">
        $("#sortby").on('change',function () {
        var sort = $("#sortby").val();
        window.location = "{{url('/user/wishlists')}}?sort="+sort;
    	});
</script>

<script type="text/javascript">
function addtocart(product_id) {
    var qty = 1;
    var pid = product_id;
    // var prices = $(this).closest('li').children('input').val();
   
      $.ajax({
        type: "GET",
        url:mainurl+"/addnumcart",
        data:{id:pid,qty:qty,size:'',color:'',size_qty:'',size_price:'',size_key:'',keys:'',values:'',prices:''},
        success:function(data){

          if(data == 'digital') {
              toastr.error(langg.already_cart);
           }
          else if(data == 0) {
              toastr.error(langg.out_stock);
            }
          else {
            $("#cart-count").text(data[0]);
            $("#cart-items").load(mainurl+'/carts/view');
              toastr.success(langg.add_cart);
            }
           }
        });
}

  $(document).ready(function() {
    if ($(window).width() < 800){
      $('#ezy-header').css('display', 'none');
      $('#ezy-footer').css('display', 'none');
	  $('#user-profile-mobile-header').css('display', 'flex');
    }
  });
</script>

@endsection

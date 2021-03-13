@extends('layouts.front')

@section('styles')
<style>
.waze {
	margin-top: 10px;
}

.waze-btn {
	margin-bottom: 0px !important;
}

.waze-img {
	width: 15% !important;
}
@media only screen and (max-width: 767px) { 
  .sub-categori {
    padding-top: 0px;
  }
  .hover-5:hover .hover-overlay {
      background: rgba(0, 0, 0, 0.2);
  } 
	.category-img {
		border-radius: 50%!important;
		height: 100%;
	}

	.ezy-category-name {
		font-size: 16px !important;
	}

	.hover {
		height: 69px;
  }
}

@media only screen and (max-width: 420px) {
	.hover {
		height: 80px;
	}
}
@media only screen and (max-width: 390px) {
	.hover {
		height: 70px;
	}
}
@media only screen and (max-width: 350px) {
	.hover {
		height: 56px;
	}

	.ezy-category-name {
		font-size: 14px !important;
	}
}
</style>
@endsection

@section('content')

  <div class="breadcrumb-area" style="background: url({{  asset('assets/images/online_banner.png') }}) !important;background-repeat: no-repeat; background-size: cover !important;background-position: ;padding: 0px 0px!important;">
      <div class="row" style="background-color: rgba(0,0,0,0.3)">
        <div class="col-lg-12">
            <label for="" class="text-white text-center ezy-img-letter">Online Stores</label>
            <p class="text-uppercase text-white text-center ezy-sm-img-letter">Welcome to our online stores</p>
        </div>
        <div class="col-lg-12 ezy-breadcrumb">
            <ul class="pages">
              <li>
                  <a href="{{route('front.index')}}" class="ezy-breadcrumb-text">{{ $langg->lang17 }}</a>
              </li>
              <li>
                  <a href="{{ route('front.category.store.show') }}" class="text-white">Online Stores</a>
              </li>
            </ul>
        </div>
      </div>
  </div>

<!-- Breadcrumb Area End -->

<!-- Category Area Start -->
<section class="sub-categori">
   <div class="container">
        <!-- -------------------- responsive store category list start -------------------- -->
				<div class="d-flex align-items-center ezy-category-animation">
					<div class="flex-shrink-0">
						<a href="#" class="btn-left btn-link p-2 toggleLeft category-slider-arrow"><i class="fa fa-angle-left ezy-fa-angle-left"></i></a>
					</div>
					<div class="flex-grow-1 position-relative overflow-hidden" id="outer">
						<ul class="nav nav-fill text-uppercase position-relative flex-nowrap" id="bar">
						<?php $slider_time = 0; ?>
						@foreach(DB::table('categories')->where('store_type', '=', '0')->get() as $data)
							<!-- DEMO 5 Item-->
							<?php $slider_time += 0.2; ?>
							<div class="col-lg-2 col-md-4 col-3 wow fadeInRight category-slider" data-wow-delay="<?php echo $slider_time.'s'; ?>">
								<!-- DEMO 5 Item-->
								<div class="hover hover-5 text-white rounded">
									<img class="category-img" src="{{ asset('assets/images/categories/'.$data->image) }}" alt="">
									<a href="javascript:category('{{ $data->id }}')">
										<div class="hover-overlay"></div>
										<div class="hover-5-content">
											<h3 class="hover-5-title text-uppercase font-weight-light mb-0"> <strong class="font-weight-bold text-white ezy-category-name" style="color: white !important"></strong></h3>
										</div>
									</a>
								</div>
								<p class="ezy-category-name"><a href="javascript:category('{{ $data->id }}')" class="ezy-category-name">{{ $data->name }}</a></p>
							</div>						
						@endforeach
						</ul>
					</div>
					<div class="flex-shrink-0">
						<a href="#" class="btn-right btn-link toggleRight p-2 category-slider-arrow"><i class="fa fa-angle-right ezy-fa-angle-right"></i></a>
					</div>
				</div>
				<!-- ------------------ responsive store category list start -------------- -->
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12" id="category_store">
          <div class="row">
            <p class="ezy-online-category-note">{{ empty($category_info)?"All":$category_info->name }} Stores</p>
          </div>
					<div class="row ezy-row-nopadding">
            @foreach($category_stores as $category_store)
            <div class="col-lg-4 col-md-6 col-12 ezy-custom-responsive">
              <div class="card ezy-custom-card1">
                <div class="row">
                  <div class="col-lg-5 col-md-5 col-5 ezy-responsive-store">
                  @if(empty($category_info))
                    <a href="{{ route('front.vendor', [str_replace(' ', '-', $category_store->shop_name), $category_store->id, 0]) }}" class="banner-effect text-center">
                      <img class="ezy-store-img1" src="{{ empty($category_store->shop_logo)?asset('assets/images/vendorlogo/default_logo.jpg'):asset('assets/images/vendorlogo/'.$category_store->shop_logo) }}" alt="">
                    </a>
                  @else
                    <a href="{{ route('front.vendor', [str_replace(' ', '-', $category_store->shop_name), $category_store->id, 0, $category_info->id]) }}" class="banner-effect text-center">
                      <img class="ezy-store-img1" src="{{ empty($category_store->shop_logo)?asset('assets/images/vendorlogo/default_logo.jpg'):asset('assets/images/vendorlogo/'.$category_store->shop_logo) }}" alt="">
                    </a>
                  @endif
                  </div>
                  <div class="col-lg-7 col-md-7 col-7">
                    <p class="ezy-store-name1">{{ $category_store->shop_name }}</p>
                    <!-- @php
											$products = DB::table('products')->where('user_id', '=', $category_store->id)->take(4)->get();
											$product_names = '';
											if(count($products) != 0) {
												foreach($products as $product) {
													$product_names .= $product->name.', ';
												}
												$product_names = substr($product_names, 0, -2);
											}
										@endphp
                    <p class="ezy-store-product1"><b>Products</b> : {{$product_names}}</p> -->
                    <p class="ezy-store-product1">{{ $category_store->shop_address }}</p>
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-4 text-center p-0">
                        <i class='fas fa-star ezy-review1'>&nbsp; {{isset(Session::get('every_shop_ratings')[$category_store->id])?number_format(Session::get('every_shop_ratings')[$category_store->id],2):'0.00'}}</i>
                      </div>
                      <div class="col-lg-8 col-md-8 col-8 text-center p-0">
                        <i class="far fa-clock ezy-distance-time1">&nbsp; {{ $category_store->opening_hours }}</i>
                      </div>
                      @php
                        $waze = 'll='.$category_store->shop_latitude.','.$category_store->shop_longitude;
                      @endphp
                      <div class="col-lg-12 text-right waze">
                        <a href="{{ 'waze://?'.$waze.'&navigate=yes'}}" class="waze-btn" target="_blank"><img class="waze-img" src="{{asset('assets/images/waze.png')}}" alt=""></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
						@endforeach
          </div>
        </div>
      </div>
   </div>
</section>
<!-- Category Area End -->
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    new WOW().init();

    function category(category_id) {
      filter_url = '{{route('front.category.store.show')}}' + '?category_id=' + category_id;
      $("#category_store").html("<div class='text-center'><div class='spinner-border text-secondary' style='color: red!important;margin: 100px'></div></div>");

      $.ajax({
        method: "GET",
        url: filter_url,
        contentType : false,
        cache: false,
        processData: false,
        success:function(data)
        {   
          setTimeout(function() {
            $("#category_store").html(data);
          }, 1000);
        }
      });
    }
  $(document).ready(function() {

    // when dynamic attribute changes
    $(".attribute-input, #sortby").on('change', function() {
      $("#ajaxLoader").show();
      filter();
    });

    // when price changed & clicked in search button
    $(".filter-btn").on('click', function(e) {
      e.preventDefault();
      $("#ajaxLoader").show();
      filter();
    });
  });

  function filter() {
    let filterlink = '';

    if ($("#prod_name").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?search='+$("#prod_name").val();
      } else {
        filterlink += '&search='+$("#prod_name").val();
      }
    }

    $(".attribute-input").each(function() {
      if ($(this).is(':checked')) {
        if (filterlink == '') {
          filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$(this).attr('name')+'='+$(this).val();
        } else {
          filterlink += '&'+$(this).attr('name')+'='+$(this).val();
        }
      }
    });

    if ($("#sortby").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#sortby").attr('name')+'='+$("#sortby").val();
      } else {
        filterlink += '&'+$("#sortby").attr('name')+'='+$("#sortby").val();
      }
    }

    if ($("#min_price").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#min_price").attr('name')+'='+$("#min_price").val();
      } else {
        filterlink += '&'+$("#min_price").attr('name')+'='+$("#min_price").val();
      }
    }

    if ($("#max_price").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#max_price").attr('name')+'='+$("#max_price").val();
      } else {
        filterlink += '&'+$("#max_price").attr('name')+'='+$("#max_price").val();
      }
    }

    // console.log(filterlink);
    // console.log(encodeURI(filterlink));
    $("#ajaxContent").load(encodeURI(filterlink), function(data) {
      // add query string to pagination
      addToPagination();
      $("#ajaxLoader").fadeOut(1000);
    });
  }

  // append parameters to pagination links
  function addToPagination() {
    // add to attributes in pagination links
    $('ul.pagination li a').each(function() {
      let url = $(this).attr('href');
      let queryString = '?' + url.split('?')[1]; // "?page=1234...."

      let urlParams = new URLSearchParams(queryString);
      let page = urlParams.get('page'); // value of 'page' parameter

      let fullUrl = '{{route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')])}}?page='+page+'&search='+'{{request()->input('search')}}';

      $(".attribute-input").each(function() {
        if ($(this).is(':checked')) {
          fullUrl += '&'+encodeURI($(this).attr('name'))+'='+encodeURI($(this).val());
        }
      });

      if ($("#sortby").val() != '') {
        fullUrl += '&sort='+encodeURI($("#sortby").val());
      }

      if ($("#min_price").val() != '') {
        fullUrl += '&min='+encodeURI($("#min_price").val());
      }

      if ($("#max_price").val() != '') {
        fullUrl += '&max='+encodeURI($("#max_price").val());
      }

      $(this).attr('href', fullUrl);
    });
  }

  $(document).on('click', '.categori-item-area .pagination li a', function (event) {
    event.preventDefault();
    if ($(this).attr('href') != '#' && $(this).attr('href')) {
      $('#preloader').show();
      $('#ajaxContent').load($(this).attr('href'), function (response, status, xhr) {
        if (status == "success") {
          $('#preloader').fadeOut();
          $("html,body").animate({
            scrollTop: 0
          }, 1);

          addToPagination();
        }
      });
    }
  });

</script>

<script type="text/javascript">

  $(function () {

    $("#slider-range").slider({
      range: true,
      orientation: "horizontal",
      min: 25,
      max: 50,
      values: [{{ isset($_GET['min']) ? $_GET['min'] : '0' }}, {{ isset($_GET['max']) ? $_GET['max'] : '10000000' }}],
      step: 1,

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
<!-- ---------------------- responsive store category list js start ------------- -->
<script type="text/javascript">
  var metrics = {};
  var scrollOffset = 0;

  var container = document.getElementById("outer");
  var bar = document.getElementById("bar");

  function setMetrics() {
      metrics = {
          bar: bar.scrollWidth||0,
          container: container.clientWidth||0,
          left: parseInt(bar.offsetLeft),
          getHidden() {
              return (this.bar+this.left)-this.container
          }
      }
      
      updateArrows();
  }

  function doSlide(direction){
      setMetrics();
      var pos = metrics.left;
      if (direction==="right") {
          amountToScroll = -(Math.abs(pos) + Math.min(metrics.getHidden(), metrics.container));
      }
      else {
          amountToScroll = Math.min(0, (metrics.container + pos));
      }
      bar.style.left = amountToScroll + "px";
      setTimeout(function(){
          setMetrics();
      },400)
  }

  function updateArrows() {
      if (metrics.getHidden() === 0) {
          document.getElementsByClassName("toggleRight")[0].classList.add("text-light");
      }
      else {
          document.getElementsByClassName("toggleRight")[0].classList.remove("text-light");
      }
      
      if (metrics.left === 0) {
          document.getElementsByClassName("toggleLeft")[0].classList.add("text-light");
      }
      else {
          document.getElementsByClassName("toggleLeft")[0].classList.remove("text-light");
      }
  }

  function adjust(){
      bar.style.left = 0;
      setMetrics();
  }

  document.getElementsByClassName("toggleRight")[0].addEventListener("click", function(e){
      e.preventDefault()
      doSlide("right")
  });

  document.getElementsByClassName("toggleLeft")[0].addEventListener("click", function(e){
      e.preventDefault()
      doSlide("left")
  });

  window.addEventListener("resize",function(){
      // reset to left pos 0 on window resize
      adjust();
  });

  setMetrics();

</script>
<!-- ---------------------- responsive stote category list js end ------------- -->


@endsection
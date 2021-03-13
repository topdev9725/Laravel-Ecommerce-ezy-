@extends('layouts.front')
@section('styles')
<style>
    select {
        width: 100%;
        padding: 0 0px 10px;
        border-radius: 0px;
        color: #5a6f84;
        font-size: 14px;
        margin-bottom: 15px;
        background: #fff;
        border: 0px;
        border-bottom: 1px solid rgba(45, 50, 116, 0.3);
    }
    @media only screen and (max-width: 767px) {  
        .ezy-nearby-title {
            padding-bottom: 0px !important;
        }

        .fadeInUp {
            padding-left: 8px;
            padding-right: 8px;
        }

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

<!-- Breadcrumb Area Start -->
  <div class="breadcrumb-area" style="background: url({{  asset('assets/images/autodebit_banner.jpg') }}) !important;background-repeat: no-repeat; background-size: cover !important;background-position:center ;padding: 0px 0px!important;">
      <div class="row" style="background-color: rgba(0,0,0,0.3)">
        <div class="col-lg-12">
            <label for="" class="text-white text-center ezy-img-letter autodebit-img-text">Auto Debit</label>
            <p class="text-uppercase text-white text-center ezy-sm-img-letter" style="color:white!important">Welcome To Our Auto Debit</p>
        </div>

        <div class="col-lg-12 ezy-breadcrumb">
            <ul class="pages">
              <li>
                  <a href="{{route('front.index')}}" class="ezy-breadcrumb-text">{{ $langg->lang17 }}</a>
              </li>
              <li>
                  <a href="{{ route('front.autodebit') }}" class="text-white">AutoDebit</a>
              </li>
            </ul>
        </div>
      </div>
  </div>

<!-- Breadcrumb Area End -->

<!-- AutoDebit Area Start -->
<section>
   <div class="container">
        <div class="row">
          <div class="col-lg-12">
                <div class="autodebit-search">
                    <div class="form-group-lg has-search input-group-lg">
                        <span class="fa fa-search form-control-feedback" style="margin:5px 0px"></span>
                        <input type="text" class="form-control text-capitalize autodebit-search-box" placeholder="Search Autodebit Stores Here" value="{{ Session::has('shop_name')?Session::get('shop_name'):'' }}" id="autodebit_search">
                    </div>
                </div>
          </div>
          @if(Auth::check())
          <div class="text-right">
            <!-- <a href="javascript:show_ordered_autodebit()"><i class='far fa-arrow-alt-circle-left' style='font-size:48px;position: absolute;right: 12px;margin-top: 12px;color:#c5c5c5'></i></a> -->
            <a data-toggle="modal" data-target="#orderModal"><i class='far fa-arrow-alt-circle-left autodebit-order-arrow'></i></a>
          </div>
          @endif
        </div>

        <!-- autodebit category section start -->
        <div class="d-flex align-items-center ezy-category-animation">
            <div class="flex-shrink-0">
                <a href="#" class="btn-left btn-link p-2 toggleLeft category-slider-arrow"><i class="fa fa-angle-left ezy-fa-angle-left"></i></a>
            </div>
            <div class="flex-grow-1 position-relative overflow-hidden" id="outer">
                <ul class="nav nav-fill text-uppercase position-relative flex-nowrap" id="bar">
                <?php $slider_time = 0; ?>
                @foreach(DB::table('autodebit_categories')->where('status', 1)->get() as $data)
                    <!-- DEMO 5 Item-->
                    <?php $slider_time += 0.2; ?>
                    <div class="col-lg-3 col-md-4 col-3 wow fadeInRight category-slider" data-wow-delay="<?php echo $slider_time.'s'; ?>">
                        <!-- DEMO 5 Item-->
                        <div class="hover hover-5 text-white rounded">
                            <img class="category-img" src="{{ asset('assets/images/categories/'.$data->photo) }}" alt="">
                            <a href="javascript:autodebit('{{ $data->id }}')">
                                <div class="hover-overlay"></div>
                                <div class="hover-5-content">
                                    <h3 class="hover-5-title text-uppercase font-weight-light mb-0"> <strong class="font-weight-bold text-white ezy-category-name" style="color: white !important"></strong></h3>
                                </div>
                            </a>
                        </div>
                        <p class="ezy-category-name"><a href="javascript:autodebit('{{ $data->id }}')" class="ezy-category-name">{{ $data->name }}</a></p>
                    </div>						
                @endforeach
                <input type="hidden" id="cat_id" value="">
                </ul>
            </div>
            <div class="flex-shrink-0">
                <a href="#" class="btn-right btn-link toggleRight p-2 category-slider-arrow"><i class="fa fa-angle-right ezy-fa-angle-right"></i></a>
            </div>
        </div>
        <!-- autodebit category section end -->

      <div class="col-lg-12 nearby-header" style="text-align: end;margin:40px 0px">
            <h2 class="text-capitalize autodebit-shopname text-center" id="nearby_autodebit">Nearby Autodebit</h2>
            <!-- <div class="price-range-block text-right" id="nearby_autodebit_range">
                <input type="range" id="range-value" min="1" max="50" value="25" class="slider" style="width: 200px;margin-bottom: 15px">
                <p id="range-result">Current range : <b></b> km</p>
            </div> -->
      </div>	
      <div id="subscription">
      @php
        $vendors = App\Models\User::where('is_vendor', 2)->where('category_id', '<>', null)->where('autodebit', '=', 1)->get();
      @endphp
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
      </div>
   </div>
</section>
<!-- AutoDebit Area End -->

@if(Auth::check())
<div class="modal right fade" id="orderModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width: 700px !important;">
        <div class="modal-content">

            <div class="modal-header" style="padding-top:35px !important">
                <button type="button" id="order-modal-close" class="close" data-dismiss="modal" aria-label="Close" style="margin:0rem 0rem -1rem auto"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title" id="myModalLabel2">My Subscription Plans</h4> 
            </div>

            <div class="modal-body" style="padding:20px 25px!important">
                @if(count($ordered_autodebits) != 0 || count($ordered_insurrances) != 0)
        
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Shop Name</td>
                                <th>Title</td>
                                <th>Method</td>
                                <th>Cost</td>
                                <th>Term</td>
                                <th>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ordered_autodebits as $ordered_autodebit)
                            <tr>
                                <td><a href="#" class="order-modal text-capitalize">{{ App\Models\User::where('id', $ordered_autodebit->vendor_id)->first()->shop_name }}</a></td>
                                <td>{{ App\Models\AutodebitSubscription::where('id', $ordered_autodebit->subscription_id)->first()->title }}</td>
                                <td class="text-capitalize">{{ App\Models\AutodebitSubscription::where('id', $ordered_autodebit->subscription_id)->first()->method }}</td>
                                <td>{{ App\Classes\Common::formatPrice(App\Models\AutodebitSubscription::where('id', $ordered_autodebit->subscription_id)->first()->cost) }}</td>
                                <td>{{ $ordered_autodebit->terms.' years' }}</td>
                                <td>
                                @switch($ordered_autodebit->status)
                                    @case(0)
                                        <div class="autodebit-status" style="background: orange">Pending</div>
                                        @break
                                    @case(1)
                                        <div class="autodebit-status" style="background: #02abff">Approve</div>
                                        @break
                                    @case(2)
                                        <div class="autodebit-status" style="background: #ff0000">Decline</div>
                                        @break
                                    @case(3)
                                        <div class="autodebit-status" style="background: #02abff">Canceled</div>
                                        @break
                                    @case(4)
                                        <div class="autodebit-status" style="background: green">Expired</div>
                                        @break
                                @endswitch
                                </td>
                            </tr>
                            @endforeach
                            @foreach($ordered_insurrances as $ordered_insurrance)
                            <tr>
                                <td><a href="#" class="order-modal text-capitalize">{{ App\Models\User::where('id', $ordered_insurrance->vendor_id)->first()->shop_name }}</a></td>
                                <td>{{ $ordered_insurrance->title }}</td>
                                <td class="text-capitalize">{{ $ordered_insurrance->method == 'half_year'?'Half Year':$ordered_insurrance->method}}</td>
                                <td>{{ App\Classes\Common::formatPrice($ordered_insurrance->amount) }}</td>
                                <td>{{ $ordered_insurrance->terms.' years' }}</td>
                                <td>
                                @switch($ordered_insurrance->status)
                                    @case(0)
                                        <div class="autodebit-status" style="background: orange">Pending</div>
                                        @break
                                    @case(1)
                                        <div class="autodebit-status" style="background: #02abff">Approve</div>
                                        @break
                                    @case(2)
                                        <div class="autodebit-status" style="background: #ff0000">Decline</div>
                                        @break
                                    @case(3)
                                        <div class="autodebit-status" style="background: #02abff">Canceled</div>
                                        @break
                                    @case(4)
                                        <div class="autodebit-status" style="background: green">Expired</div>
                                        @break
                                @endswitch
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                @else
                    <h4>No ordered subscriptions</h4>
                @endif
            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
@endif

<!-- Checkout Modal start-->
<div class="modal fade" id="autodebit-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding:25px !important">
                <form id="autodebit_checkout">
                    <div class="input-group mb-3">
                        <label for="quantity" style="margin-bottom:24px !important">How long would you like to buy this?</label>
                        <input type="number" id="term" name="term" min="1" max="5" style="width:70%" placeholder="" required="" />
                        <input type="hidden" id="subscription_id" value="" name="subscription_id">
                        <input type="hidden" id="subscription_cost" value="" name="subscription_cost">
                        <div class="input-group-append">
                            <span class="input-group-text">YEAR</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comment">Description:</label>
                        <textarea class="form-control" rows="5" id="description"></textarea>
                    </div>
                    <div class="form-group text-right" style="margin-bottom:0px !important;margin-top:25px!important">
                        <button class="btn btn-primary ezy-autodebit-btn text-right" style="margin-right:5px" data-dismiss="modal" id="autodebit_close">Close</button>
                        <button type="submit" class="btn btn-primary text-right ezy-autodebit-btn">Check Out</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
<!-- Checkout Modal end--> 

<!-- Checkout Insurrance Modal start-->
<div class="modal fade" id="autodebit-insurrance-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="padding: 1rem 1rem !important;">
                <h5 class="modal-title">Insurrance Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding:25px !important">
                <form id="autodebit_insurrance_checkout">
                    <label for="terms">Terms:</label>
                    <div class="input-group mb-3">
                        <input type="number" name="term" min="1" max="5" class="form-control" style="width:70%" placeholder="" required="" />
                        <input type="hidden" id="vendor_id" value="" name="vendor_id">
                        <div class="input-group-append">
                            <span class="input-group-text">YEAR</span>
                        </div>
                    </div>

                    <label for="terms">Method:</label>
                    <div class="input-group mb-3">
                        <select class="input-filed" id="method_list">
                            <option value="monthly" selected>Monthly</option>
                            <option value="quarter">Quarter</option>
                            <option value="half_year">Half Year</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                    <input type="hidden" value="" id="method" name="method">

                    <label for="amount">Amount:</label>
                    <div class="input-group mb-3">
                        <input type="number" min="0" name="amount" class="form-control" required="" id="amount">
                        <div class="input-group-append">
                            <span class="input-group-text">MYR</span>
                        </div>
                    </div>	

                    <div class="form-group">
                        <label for="comment">Description:</label>
                        <textarea class="form-control" rows="5" name="description"></textarea>
                    </div>

                    <div class="form-group text-right" style="margin-bottom:0px !important;margin-top:25px!important">
                        <button class="btn btn-primary ezy-autodebit-btn text-right" style="margin-right:5px" data-dismiss="modal" id="autodebit_insurrance_close">Close</button>
                        <button type="submit" class="btn btn-primary text-right ezy-autodebit-btn">Check Out</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
<!-- Checkout Insurrance Modal end-->  

<!-- Remove Modal start-->
<div class="modal fade" id="autodebit-remove-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Really cancel this subscription?</p>
                <input type="hidden" id="remove_subscription_id" value="" name="subscription_id">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary ezy-autodebit-btn" id="autodebit_remove">Yes</button>
                <button class="btn btn-primary ezy-autodebit-btn" data-dismiss="modal" id="autodebit_close">No</button>
            </div>
        </div>
    </div>
</div>  
<!-- Remove Modal end-->  

<!-- Remove Insurrance Modal start-->
<div class="modal fade" id="autodebit-insurrance-romove-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Really cancel this plan?</p>
                <input type="hidden" id="remove_vendor_id" value="" name="remove_vendor_id">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary ezy-autodebit-btn" id="autodebit_insurrance_remove">Yes</button>
                <button class="btn btn-primary ezy-autodebit-btn" data-dismiss="modal" id="autodebit_close">No</button>
            </div>
        </div>
    </div>
</div>  
<!-- Remove Insurrance Modal end-->  
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    new WOW().init();
    var loadNerbyAutodebits = function(data) {
        $('#subscription').html(data);
        // $('#location_icon').removeClass( "fa fa-spinner fa-spin" ).addClass("fas fa-globe-asia" );
    }

    function autodebit(category_id) {
      $("#cat_id").val(category_id);
      filter_url = "{{route('front.autocategory.store.show')}}";
      $('#subscription').html("<div class='col-lg-12 text-center'><img style='margin: 200px 0px;width:100px' src='{{ asset('assets/images/autodebit_loader.gif') }}'></div>");

      $.ajax({
        method: "GET",
        url: filter_url,
        data: {
            category_id: category_id
        },
        success:function(data) {   
          setTimeout(function() {
            $("#subscription").html(data);
          }, 1000);
        }
      });
    }

    function nearby_autodebit(shop_name) {
        $('#subscription').html("<div class='col-lg-12 text-center'><img style='margin: 200px 0px;width:100px' src='{{ asset('assets/images/autodebit_loader.gif') }}'></div>");
        $('#nearby_autodebit').css('display', 'none');
        $('#nearby_autodebit_range').css('display', 'none');
        $.ajax({
            type: "GET",
            data: {autodebit_name:shop_name},
            url:mainurl+"/auto-debit/get-subscription",
            success:function(data){
                setTimeout(() => {
                    $('#subscription').html(data);
                }, 1000);
            }
        });        
    }

    $(document).ready(function() {
        //--------------------------------------nearby autodebit start ---------------//
		// Read value on page load in range 
        $("#range-result b").html($("#range-value").val());

        // Read value on change in range
        $("#range-value").change(function(){
            $("#range-result b").html($(this).val());
        });
        
        setGeolocation_autodebit($('#range-value').val());

        $(document).on('mouseup touchstart', '#range-value', function(e) {   
            var cat_id = $('#cat_id').val();
			$('#subscription').html("<div class='col-lg-12 text-center'><img style='margin: 200px 0px;width:100px' src='{{ asset('assets/images/autodebit_loader.gif') }}'></div>");
			var latitude = $('#latitude').val();
			var longitude = $('#longitude').val();			
			if(latitude=='' || longitude=='' || latitude=='0' || longitude=='0') {
				showError("Please enter address correctly to get getlocation.\n You might not be supported Nearby Service.");					
				return false;
            }
            
            setGeolocation_autodebit($('#range-value').val(), cat_id);
        });
        
        //--------------------------------------nearby autodebit end ---------------//

        //get search list
        var autodebit_stores;
        $.ajax({
            type: "GET",
            url:mainurl+"/auto-debit/store-show",
            success:function(data){
                autodebit_stores = JSON.parse(data);
            },
            async: false
        });

        @if(Session::has('shop_name'))
            var selected_autodebit_name = $('#autodebit_search').val();
            $.ajax({
                type: "GET",
                data: {autodebit_name:selected_autodebit_name},
                url:mainurl+"/auto-debit/get-subscription",
                success:function(data){
                    $('#subscription').html(data);
                }
            });
        @endif

        //get subscription information about selected autodebit
        $('#autodebit_search').autocomplete({
            source: autodebit_stores,
            select: function( event , ui ) {
                var selected_autodebit_name = ui.item.label;
                $.ajax({
                    type: "GET",
                    data: {autodebit_name:selected_autodebit_name},
                    url:mainurl+"/auto-debit/get-subscription",
                    success:function(data){
                        $('.nearby-header').css('display', 'none');
                        $('#subscription').html(data);
                    }
                });
            }
        });
    })

    //pass subscription id to modal
    $(document).on("click", ".autodebit-modal", function () {
        var subscription_id = $(this).data('id');
        var subscription_cost = $(this).data('cost');
        $(".modal-body #subscription_id").val(subscription_id);
        $(".modal-body #subscription_cost").val(subscription_cost);
        $('#autodebit-modal').modal('toggle');
    });

    //when press checkout button of modal
    $(document).on("submit", "#autodebit_checkout", function (e) {

        @if(!Auth::check())
            e.preventDefault();
            $('#autodebit_close').click();
            $('#myModal').modal('show');
        @else
            e.preventDefault();
            var user_balance = "{{Auth::user()->balance}}";
            var subscription_cost = $('#subscription_cost').val();
            var category_id = $('#cat_id').val();
            
            if(user_balance - subscription_cost < 0) {
                toastr.error("Your wallet is not enough!");
            } else if (category_id == '') {
                toastr.error('Please choose category')
            } else { 
                var term = $('#term').val();
                var description = $('#description').val();
                var subscription_id = $('#subscription_id').val();
                var shop_name = $('#autodebit_search').val();

                $.ajax({
                    type: 'Get',
                    url: "{{URL::to('/auto-debit/order-subscription')}}",
                    data: {
                        'term': term,
                        'subscription_id': subscription_id,
                        'description': description,
                        'shop_name': shop_name,
                        'category_id': category_id,
                    },
                    success: function () {
                        location.reload();
                        toastr.success("Successfullly Ordered !");
                    },
                    error: function() {
                        toastr.error("Failed!!");
                    }
                });
            }
        @endif
    });

    //pass vendor id to insurrance modal
    $(document).on("click", ".autodebit-insurrance-modal", function () {
        var vendor_id = $(this).data('id');
        $(".modal-body #vendor_id").val(vendor_id);
        $('#autodebit-insurrance-modal').modal('toggle');
    });

    //when press checkout button of insurrance modal
    $(document).on("submit", "#autodebit_insurrance_checkout", function (e) {
        
        @if(!Auth::check())
            e.preventDefault();
            $('#autodebit_insurrance_close').click();
            $('#myModal').modal('show');
        @else
            e.preventDefault();
            
            var user_balance = "{{Auth::user()->balance}}";
            if(user_balance - $("#amount").val() < 0) {
                toastr.error("Your wallet is not enough!");
            } else {
                $("#method").val($("#method_list option:selected").val());
                $.ajax({
                    type: 'Get',
                    url: "{{URL::to('/auto-debit/insurrance/order')}}",
                    data: $("#autodebit_insurrance_checkout").serialize(),
                    success: function () {
                        location.reload();
                        toastr.success("Successfullly Ordered !");
                    },
                    error: function() {
                        toastr.error("Failed!!");
                    }
                });  
            }
        @endif

    });

    
    //pass subscription id to remove modal
    $(document).on("click", ".autodebit-remove-modal", function () {
        var subscription_id = $(this).data('id');
        $(".modal-body #remove_subscription_id").val(subscription_id);
        $('#autodebit-remove-modal').modal('toggle');
    });

    //when press remove button of modal
    $(document).on("click", "#autodebit_remove", function () {
        var subscription_id = $('#remove_subscription_id').val();
        var shop_name = $('#autodebit_search').val();

        $.ajax({
            type: 'GET',
            url: mainurl+"/auto-debit/remove-subscription",
            data: {
                subscription_id: subscription_id,
                shop_name: shop_name
            },
            async: false,
            success: function (data) {
                location.reload();
                toastr.success("Successfullly sent your subscription cancel request!");
            },
            error: function() {
                toastr.error("Failed!!");
            }
        });
    });

    //pass vendor id to remove modal
    $(document).on("click", ".autodebit-insurrance-romove-modal", function () {
        var vendor_id = $(this).data('id');
        $(".modal-body #remove_vendor_id").val(vendor_id);
        $('#autodebit-insurrance-romove-modal').modal('toggle');
    });

    //when press remove button of insurrance modal
    $(document).on("click", "#autodebit_insurrance_remove", function () {
        var vendor_id = $('#remove_vendor_id').val();

        $.ajax({
            type: 'GET',
            url: mainurl+"/auto-debit/remove-insurrance",
            data: {
                vendor_id: vendor_id
            },
            async: false,
            success: function (data) {
                location.reload();
                toastr.success("Successfullly sent your subscription cancel request!");
            },
            error: function() {
                toastr.error("Failed!!");
            }
        });
    });

    //when press shop name in order modal
    $(document).on("click", ".order-modal", function () {
        var selected_autodebit_name = $(this).text();

        $.ajax({
            type: "GET",
            data: {autodebit_name:selected_autodebit_name},
            url:mainurl+"/auto-debit/get-subscription",
            success:function(data){
                $('#order-modal-close').click();
                $('.nearby-header').css('display', 'none');
                $('#subscription').html(data);
            }
        });
    });

    function show_ordered_autodebit() {
        $('#show_ordered_autodebit').toggle('slide', {
            direction: 'right'
        }, 500)
    }
</script>

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
@endsection
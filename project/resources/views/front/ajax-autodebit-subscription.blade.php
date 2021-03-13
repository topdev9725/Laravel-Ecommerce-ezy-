
	@if(count($autodebit_subscriptions) != 0)
		<div class="row">
			<div class="col-lg-12 text-center autodebit-header">
				<h2 class="text-capitalize autodebit-shopname">{{ $autodebit_store->shop_name }}</h2>
				<h3 class="autodebit-shop-address">{{ $autodebit_store->shop_address }}</h3>
			</div>
		</div>
		<div class="row" style="margin-bottom:100px">
			@foreach($autodebit_subscriptions as $sub)
			<div class="col-lg-3 col-md-6 col-12" style="padding-right:30px !important;padding-left:30px !important">
				<div class="elegant-pricing-tables style-2 text-center {{isset($user_ordered_subscription) && $sub->id == $user_ordered_subscription->subscription_id?'ordered-shadow':''}}" style="border: 3px solid rgb(193 193 193 / 15%) !important;border-radius:10px">
					<div class="pricing-head">
						<h3 class="text-capitalize"><i class='fas fa-hourglass-half' style='font-size:24px!important;font-weight:600!important'></i>&nbsp;&nbsp;{{ $sub->title }}</h3>
						@if($sub->cost  == 0)
						<span class="price">
						<span class="price-digit">{{ $langg->lang402 }}</span>
						</span>
						@else
						<span class="price">
							<sup>
								<!-- {{ $sub->currency }} -->
								RM
							</sup>
							<span class="price-digit">{{ $sub->cost }}</span><br>

							<span class="price-month text-capitalize">{{ $sub->method == 'half_year'?'half year':$sub->method}}</span>
						</span>
						@endif
					</div>
					<div class="pricing-detail">
						{{ $sub->description }}
					</div>
					@if(isset($user_ordered_subscription) && $sub->id == $user_ordered_subscription->subscription_id)
						<a href="#" data-id="{{ $sub->id }}" class="btn btn-default autodebit-remove-modal" id="{{ 'get_started_btn_'.$sub->id }}">Cancel My Plan</a>
						<br>
						@switch($user_ordered_subscription->status)
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
					@else
						<a href="#" data-id="{{ $sub->id }}" data-cost="{{ $sub->cost }}" class="btn btn-default autodebit-modal" id="{{ 'get_started_btn_'.$sub->id }}">Get Started</a>
						<br><small>&nbsp;</small>
					@endif
				</div>
			</div>
			@endforeach
		</div>
	@elseif($autodebit_store->autodebit_type == 1)
	<div class="row">
		<div class="col-lg-12 text-center autodebit-header">
			<h2 class="text-capitalize autodebit-shopname">{{ $autodebit_store->shop_name }}</h2>
			<h4 class="autodebit-shopname" style="font-size:25px !important">(Insurrance)</h3>
			<h3 class="autodebit-shop-address">{{ $autodebit_store->shop_address }}</h3>
		</div>
	</div>
	<div class="row" style="margin-bottom:100px">
		<div class="col-lg-12 text-center">
			@if(isset($user_ordered_insurrance))
				<a href="#" data-id="{{ $autodebit_store->id }}" class="btn btn-primary autodebit-insurrance-romove-modal" style="background:#0f78f2!important;border-color:#0f78f2!important">Cancel My Plan</a>
			@else
				<a href="#" data-id="{{ $autodebit_store->id }}" class="btn btn-primary autodebit-insurrance-modal" style="background:#0f78f2!important;border-color:#0f78f2!important">Get Started</a>
			@endif
		</div>
	</div>
	@else 
	<div class="row">
		<div class="col-lg-12 text-center autodebit-header">
			<h2 class="text-capitalize autodebit-shopname">{{ $autodebit_store->shop_name }}</h2>
			<h3 class="autodebit-shop-address">{{ $autodebit_store->shop_address }}</h3>
		</div>
	</div>
	<div class="row" style="margin-bottom:100px">
		<div class="col-lg-12 text-center">
			<h3 style="margin: 50px">No subscription plan</h3>
		</div>
	</div>
	@endif


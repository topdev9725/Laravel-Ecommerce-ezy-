<!doctype html>
<html lang="en" dir="ltr">

<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="author" content="GeniusOcean">
      	<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Title -->
		<title>{{$gs->title}}</title>
		<!-- favicon -->
		<link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
		<!-- Bootstrap -->
		<link href="{{asset('assets/vendor/css/bootstrap.min.css')}}" rel="stylesheet" />
		<!-- Fontawesome -->
		<link rel="stylesheet" href="{{asset('assets/vendor/css/fontawesome.css')}}">
		<!-- icofont -->
		<link rel="stylesheet" href="{{asset('assets/vendor/css/icofont.min.css')}}">
		<!-- Sidemenu Css -->
		<link href="{{asset('assets/vendor/plugins/fullside-menu/css/dark-side-style.css')}}" rel="stylesheet" />
		<link href="{{asset('assets/vendor/plugins/fullside-menu/waves.min.css')}}" rel="stylesheet" />

		<link href="{{asset('assets/vendor/css/plugin.css')}}" rel="stylesheet" />

		<link href="{{asset('assets/vendor/css/jquery.tagit.css')}}" rel="stylesheet" />
    	<link rel="stylesheet" href="{{ asset('assets/vendor/css/bootstrap-coloroicker.css') }}">
		<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
		<!-- Main Css -->

	@if($langg->rtl == "1")

	<link href="{{asset('assets/vendor/css/rtl/style.css')}}" rel="stylesheet"/>
	<link href="{{asset('assets/vendor/css/rtl/custom.css')}}" rel="stylesheet"/>\
    <link href="{{ asset('assets/vendor/css/common.css') }}" rel="stylesheet">
	<link href="{{asset('assets/vendor/css/rtl/responsive.css')}}" rel="stylesheet" />

	@else

	<link href="{{asset('assets/vendor/css/style.css')}}" rel="stylesheet"/>
	<link href="{{asset('assets/vendor/css/custom.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendor/css/common.css') }}" rel="stylesheet">
	<link href="{{asset('assets/vendor/css/responsive.css')}}" rel="stylesheet" />

	@endif

		@yield('styles')
	<style>
		.vendor_badge{
			position: absolute;
			top: 8px;
			right: 30px;
			display: block;
			width: 20px;
			height: 20px;
			background-color: #fff;
			border-radius: 50%;
			color: #2d3274;
			line-height: 20px;
			font-weight: bold;
			text-align: center;
			font-size: 11px;
		}
	</style>

	</head>
	<body>
		<div class="page">
			<div class="page-main">
				<!-- Header Menu Area Start -->
				<div class="header">
					<div class="container-fluid">
						<div class="d-flex justify-content-between">
							<div class="menu-toggle-button">
								<a class="nav-link" href="javascript:;" id="sidebarCollapse">
									<div class="my-toggl-icon">
											<span class="bar1"></span>
											<span class="bar2"></span>
											<span class="bar3"></span>
									</div>
								</a>
							</div>

							<div class="right-eliment">
								<ul class="list">

									<!--<li class="bell-area">
										<a id="notf_order" class="dropdown-toggle-1" href="javascript:;">
											<i class="icofont-cart"></i>
											<span data-href="{{ route('vendor-order-notf-count',Auth::guard('web')->user()->id) }}" id="order-notf-count">{{ App\Models\UserNotification::countOrder(Auth::guard('web')->user()->id) }}</span>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper" data-href="{{ route('vendor-order-notf-show',Auth::guard('web')->user()->id) }}" id="order-notf-show">
										</div>
										</div>
									</li>-->

									<li class="login-profile-area">
										<a class="dropdown-toggle-1" href="javascript:;">
											<div class="user-img">
              @if(Auth::user()->is_provider == 1)
              <img src="{{ Auth::user()->photo ? asset(Auth::user()->photo):asset('assets/images/noimage.png') }}" alt="">
              @else
              <img src="{{ Auth::user()->photo ? asset('assets/images/users/'.Auth::user()->photo ):asset('assets/images/noimage.png') }}" alt="">
              @endif
											</div>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper">
													<ul>
														<h5>{{ $langg->lang431 }}</h5>

															<li>

															@if(Auth::user()->autodebit == 1)
																@php
																	Session::put('shop_name', Auth::user()->shop_name);
																@endphp
																<a target="_blank" href="{{ route('front.autodebit') }}"><i class="fas fa-eye"></i> {{ $langg->lang432 }}</a>
															@else
																<a target="_blank" href="{{ route('front.vendor', [str_replace(' ', '-', Auth::user()->shop_name), Auth::user()->id, 2]) }}"><i class="fas fa-eye"></i> {{ $langg->lang432 }}</a>
															@endif
																
															</li>

															<li>
																<a href="javascript:;" data-toggle="modal" data-target="#change_password"><i class="fas fa-key"></i> {{ __('Reset Password') }}</a>
															</li>

															<li>
																<a href="{{ route('vendor-profile') }}"><i class="fas fa-user"></i> {{ $langg->lang434 }}</a>
															</li>
															<li>
																<a href="{{ route('user-logout') }}"><i class="fas fa-power-off"></i> {{ $langg->lang435 }}</a>
															</li>

														</ul>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- Header Menu Area End -->
				<div class="wrapper">
					<!-- Side Menu Area Start -->
					<nav id="sidebar" class="nav-sidebar">
						<ul class="list-unstyled components" id="accordion">
							<li>
								@if(Auth::user()->autodebit == 1)
									@php
										Session::put('shop_name', Auth::user()->shop_name);
									@endphp
									<a target="_blank" href="{{ route('front.autodebit') }}" class="wave-effect active"><i class="fas fa-eye mr-2"></i> {{ $langg->lang440 }}</a>
								@else
									<a target="_blank" href="{{ route('front.vendor', [str_replace(' ', '-', Auth::user()->shop_name), Auth::user()->id, 2]) }}" class="wave-effect active"><i class="fas fa-eye mr-2"></i> {{ $langg->lang440 }}</a>
								@endif
							</li>

							<li>
								<a href="{{ route('vendor-dashboard') }}" class="wave-effect active"><i class="fa fa-home mr-2"></i>{{ $langg->lang441 }}</a>
							</li>
							<li>
								<a href="#order" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false"><i class="fas fa-hand-holding-usd"></i>{{ $langg->lang442 }}</a>
								<ul class="collapse list-unstyled" id="order" data-parent="#accordion" >
									@if(Auth::user()->autodebit == 0)									
										<li>
											<a href="{{route('vendor-order-index')}}"> <span>{{ $langg->lang443 }}</span></a>
										</li>
										@php
											$pending_orders = App\Models\VendorOrder::getPendingOrdersCount(Auth::guard('web')->user()->id);
										@endphp
										<li>
											<a href="{{route('vendor-order-pending')}}"> <span>{{ __('Pending Orders') }}</span><span class="vendor_badge">{{$pending_orders}}</span></a>
										</li>
									@else
										<li>
										@if(Auth::user()->autodebit_type == 0)
											<a href="{{route('vendor-autodebit-order-index')}}"> <span>{{ __('Autodebit Orders') }}</span></a>
										@else
											<a href="{{route('vendor-autodebit-order-insurrrance')}}"> <span>{{ __('Autodebit Orders') }}</span></a>
										@endif
										</li>
										
										@if(Auth::user()->autodebit_type == 0)
											@php
												$pending_orders = App\Models\AutodebitOrder::getPendingOrdersCount(Auth::guard('web')->user()->id);
											@endphp
											<li>
												<a href="{{route('vendor-autodebit-order-pending')}}"> <span>{{ __('Pending Orders') }}</span><span class="vendor_badge">{{$pending_orders}}</span></a>
											</li>
										@else
											@php
												$pending_orders = App\Models\AutodebitInsurranceOrder::getPendingOrdersCount(Auth::guard('web')->user()->id);
											@endphp
											<li>
												<a href="{{route('vendor-autodebit-order-insurrance-pending')}}"> <span>{{ __('Pending Orders') }}</span><span class="vendor_badge">{{$pending_orders}}</span></a>
											</li>
										@endif
									@endif
								</ul>
							</li>

							@if(Auth::user()->autodebit == 0)
							<li>
								<a href="#menu2" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
									<i class="icofont-cart"></i>{{ $langg->lang444 }}
								</a>
								<ul class="collapse list-unstyled" id="menu2" data-parent="#accordion">
									<li>
										<a href="{{ route('vendor-prod-types') }}"><span>{{ $langg->lang445 }}</span></a>
									</li>
									<li>
										<a href="{{ route('vendor-prod-index') }}"><span>{{ $langg->lang446 }}</span></a>
									</li>
									<li>
										<a href="{{ route('admin-vendor-catalog-index') }}"><span>{{ $langg->lang785 }}</span></a>
									</li>
								</ul>
							</li>							
							<!-- <li>
								<a href="#affiliateprod" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
									<i class="icofont-cart"></i>{{ $langg->lang447 }}
								</a>
								<ul class="collapse list-unstyled" id="affiliateprod" data-parent="#accordion">
									<li>
										<a href="{{ route('vendor-import-create') }}"><span>{{ $langg->lang448 }}</span></a>
									</li>
									<li>
										<a href="{{ route('vendor-import-index') }}"><span>{{ $langg->lang449 }}</span></a>
									</li>
								</ul>
							</li> -->
							<li>
								<a href="{{ route('vendor-prod-import') }}"><i class="fas fa-upload"></i>{{ $langg->lang450 }}</a>
							</li>
							@else
							<li>
								<a href="javascript:goto_subscription()"><i class="fas fa-dollar-sign"></i><span>{{ __('Autodebit Subscriptions')}}</span></a>
							</li>
							@endif
							<li>
								<a href="{{ route('vendor-wt-index') }}" class=" wave-effect"><i class="fas fa-list"></i>{{ $langg->lang451 }}</a>
							</li>
							<li>
								<a href="{{ route('vendor-transactions-index') }}" class="wave-effect active"><i class="fas fa-dollar-sign mr-2"></i>{{ __('Transactions') }}</a>
							</li>
							<li>
								@php
								$notifs_count = App\Models\NewNotification::getNewNotifs(Auth::guard('web')->user()->id, 0)->count();
								@endphp
								<a href="{{ route('vendor-notifications') }}" class="wave-effect active">
									<i class="fa fa-bell mr-2"></i>{{ __('Notification') }}
									<span class="vendor_badge">{{$notifs_count}}</span>
								</a>
							</li>
							@if(Auth::user()->autodebit == 0)
							<li>
								<a href="#delivery" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
									<i class="fas fa-truck"></i>{{ $langg->lang912 }}
								</a>
								<ul class="collapse list-unstyled" id="delivery" data-parent="#accordion">
									<li>
                                    	<a href="{{ route('vendor-delivery-fees') }}"><span>{{ $langg->lang913 }}</span></a>
                                    </li>
									<li>
                                    	<a href="{{ route('vendor-delivery-coupons') }}"><span>{{ $langg->lang914 }}</span></a>
                                    </li>
								</ul>
							</li>
							@endif
							<li>
								<a href="#general" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
									<i class="fas fa-cogs"></i>{{ $langg->lang452 }}
								</a>
								<ul class="collapse list-unstyled" id="general" data-parent="#accordion">
									<li>
                                    	<a href="{{ route('vendor-profile') }}"><span>{{ $langg->lang905 }}</span></a>
                                    </li>
                                    <li>
                                    	<a href="{{ route('vendor-qrcode') }}"><span>{{ __('QR Code for Pay') }}</span></a>
                                    </li>
									<li>
                                    	<a href="{{ route('vendor-logo') }}"><span>{{ $langg->lang902 }}</span></a>
                                    </li>
                                    <li>
                                    	<a href="{{ route('vendor-service-index') }}"><span>{{ $langg->lang453 }}</span></a>
                                    </li>
                                    <li>
                                    	<a href="{{ route('vendor-banner') }}"><span>{{ $langg->lang454 }}</span></a>
                                    </li>
									<!--
                                    @if($gs->vendor_ship_info == 1)
	                                    <li>
	                                    	<a href="{{ route('vendor-shipping-index') }}"><span>{{ $langg->lang719 }}</span></a>
	                                    </li>
	                                @endif
	                                @if($gs->multiple_packaging == 1)
	                                    <li>
	                                    	<a href="{{ route('vendor-package-index') }}"><span>{{ $langg->lang721 }}</span></a>
	                                    </li>
	                                @endif
									-->
                                    <li>
                                    	<a href="{{ route('vendor-social-index') }}"><span>{{ $langg->lang456 }}</span></a>
                                    </li>
								</ul>
							</li>

						</ul>
					</nav>
					<!-- Main Content Area Start -->
					@yield('content')
					<!-- Main Content Area End -->
					</div>
				</div>
			</div>

			  <!-- The Modal -->
				<div class="modal fade" id="autodebit_type_modal">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
						
							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title">Autodebit Type</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<form action="{{ route('vendor-ats-index') }}" method="get">
								<!-- Modal body -->
								<div class="modal-body">
									<div>
										<input type="radio" name="autodebit" value="0" checked>
										<label for="normal">Normal</label>
									</div>
									<div>
										<input type="radio" name="autodebit" value="1">
										<label for="insurrance">Insurrance</label>
									</div>
									<input type="hidden" id="autodebit_type" name="autodebit_type" value="0">
								</div>
								
								<!-- Modal footer -->
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-secondary" id="btn_ok">OK</button>
								</div>
							</form>
							
						</div>
					</div>
				</div>

			<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">

					<div class="modal-header d-block text-center">
						<h4 class="modal-title d-inline-block">{{ __('Change Password') }}</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<form id="frmChangePassword" action="" method="POST">
							{{csrf_field()}}
							<div class="row">								
                          		<div class="col-lg-12">
								  	<input type="password" class="input-field" id="cur_password" placeholder="{{ __('Current Password') }}" required="" value="">  
								</div>
							</div>
							<div class="row">								
                          		<div class="col-lg-12">
								  	<input type="password" class="input-field" id="new_password" placeholder="{{ __('New Password') }}" required="" value="">  
								</div>
							</div>
							<div class="row">								
                          		<div class="col-lg-12">
								  	<input type="password" class="input-field" id="confirm_password" placeholder="{{ __('Re-type New Password') }}" required="" value="">  
								</div>
							</div>
						</form>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer justify-content-center">
							<button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
							<button class="btn btn-success btn-ok">{{ __('Change') }}</button>
					</div>

					</div>
				</div>
			</div>

		@php
		  $curr = \App\Models\Currency::where('is_default','=',1)->first();
		@endphp

		<script type="text/javascript">

		  var mainurl = "{{url('/')}}";
		  var admin_loader = {{ $gs->is_admin_loader }};
		  var whole_sell = {{ $gs->wholesell }};
		  var langg    = {!! json_encode($langg) !!};
		  var getattrUrl = '{{ route('vendor-prod-getattributes') }}';
		  var curr = {!! json_encode($curr) !!};
		  var alang    = {
			'add': '{{ __('ADD NEW') }}',
			'edit': '{{ __('EDIT') }}',  
			'status': '{{ __('Status Updated Successfully.') }}',  
  			};
		</script>

		<!-- Dashboard Core -->
		<script src="{{asset('assets/vendor/js/vendors/jquery-1.12.4.min.js')}}"></script>
		<script src="{{asset('assets/vendor/js/vendors/bootstrap.min.js')}}"></script>
		<script src="{{asset('assets/vendor/js/jqueryui.min.js')}}"></script>
		<!-- Fullside-menu Js-->
		<script src="{{asset('assets/vendor/plugins/fullside-menu/jquery.slimscroll.min.js')}}"></script>
		<script src="{{asset('assets/vendor/plugins/fullside-menu/waves.min.js')}}"></script>

		<script src="{{asset('assets/vendor/js/plugin.js')}}"></script>

		<script src="{{asset('assets/vendor/js/Chart.min.js')}}"></script>
		<script src="{{asset('assets/vendor/js/tag-it.js')}}"></script>
		<script src="{{asset('assets/vendor/js/nicEdit.js')}}"></script>
        <script src="{{asset('assets/vendor/js/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{asset('assets/vendor/js/notify.js') }}"></script>
		<script src="{{asset('assets/vendor/js/load.js')}}"></script>
		<script src="{{asset('assets/front/js/toastr.js')}}"></script>
		<!-- Custom Js-->
		<script src="{{asset('assets/vendor/js/custom.js')}}"></script>
		<!-- AJAX Js-->
		<script src="{{asset('assets/vendor/js/myscript.js')}}"></script>
		<script>
			function goto_subscription() {
				@if(count(App\Models\AutodebitInsurrance::where('vendor_id', '=', Auth::user()->id)->get()) == 0 && count(App\Models\AutodebitSubscription::where('vendor_id', '=', Auth::user()->id)->get()) == 0)
					$('#autodebit_type_modal').modal('show');
				@else
					$("#autodebit_type").val("{{Auth::user()->autodebit_type}}");
					$("#btn_ok").click();
				@endif
			}

			$(document).on("change", "input[type='radio']", function() {
				$("#autodebit_type").val($("input[type='radio']:checked").val());
			});

			$(document).ready(function() {
				$('#change_password').on('show.bs.modal', function() {
					$('#cur_password').val('');
					$('#new_password').val('');
					$('#confirm_password').val('');					
				});
			
				$('button.btn-ok', $('#change_password')).on('click', function() {
					if($('#new_password').val()=='') {
						toastr.error('Please enter new password');
						return;
					}
					$.ajax({
						type:'POST',
						url: "{{route('vendor-password-update')}}",
						data: {
							cpass: $('#cur_password').val(),
							newpass: $('#new_password').val(),
							renewpass: $('#confirm_password').val(),
							_token: $('input[name="_token"]').val()
						},
						dataType: 'json',
						success: function(data) {
							if(data.errors) {
								toastr.error(data.errors[0]);
							} else {
								$('#change_password').modal('hide');
								toastr.success(data);
							}
						}
					});
				});
			});
		</script>
		@yield('scripts')

@if($gs->is_admin_loader == 0)
<style>
	div#geniustable_processing {
		display: none !important;
	}
</style>
@endif

	</body>

</html>

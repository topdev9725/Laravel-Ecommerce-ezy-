<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="{{ $page->meta_description }}">
		<title>{{$gs->title}}</title>
	@elseif(isset($blog->meta_tag) && isset($blog->meta_description))
		<meta property="og:title" content="{{$blog->title}}" />
		<meta property="og:description" content="{{ $blog->meta_description != null ? $blog->meta_description : strip_tags($blog->meta_description) }}" />
		<meta property="og:image" content="{{asset('assets/images/blogs'.$blog->photo)}}" />
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="{{ $blog->meta_description }}">
		<title>{{$gs->title}}</title>
    	
		<meta name="keywords" content="{{ !empty($productt->meta_tag) ? implode(',', $productt->meta_tag ): '' }}">
		<meta name="description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}">
	    <meta property="og:title" content="{{$productt->name}}" />
	    <meta property="og:description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}" />
	    <meta property="og:image" content="{{asset('assets/images/thumbnails/'.$productt->thumbnail)}}" />
	    <meta name="author" content="GeniusOcean">
    	<title>{{substr($productt->name, 0,11)."-"}}{{$gs->title}}</title>
	@else
		<meta property="og:title" content="{{$gs->title}}" />
		<meta property="og:description" content="{{ strip_tags($gs->footer) }}" />
		<meta property="og:image" content="{{asset('assets/images/'.$gs->logo)}}" />
	    <meta name="keywords" content="{{ $seo->meta_keys }}">
	    <meta name="author" content="GeniusOcean">
		<title>{{$gs->title}}</title>
    @endif
	<!-- favicon -->
	<link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
	<!-- Plugin css -->
	<link rel="stylesheet" href="{{asset('assets/front/css/plugin.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">

	<!-- jQuery Ui Css-->
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/jquery-ui/jquery-ui.structure.min.css')}}">

@if($langg->rtl == "1")

	<!-- stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/custom.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/responsive.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common-responsive.css')}}">

    <!--Updated CSS-->
 <link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&amp;'.'header_color='.str_replace('#','',$gs->header_color).'&amp;'.'footer_color='.str_replace('#','',$gs->footer_color).'&amp;'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&amp;'.'menu_color='.str_replace('#','',$gs->menu_color).'&amp;'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

@else

	<!-- stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{asset('assets/front/css/responsive.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common-responsive.css')}}">

    <!--Updated CSS-->
 <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&amp;'.'header_color='.str_replace('#','',$gs->header_color).'&amp;'.'footer_color='.str_replace('#','',$gs->footer_color).'&amp;'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&amp;'.'menu_color='.str_replace('#','',$gs->menu_color).'&amp;'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

@endif
	@yield('styles')

</head>

<body>

@if($gs->is_loader == 1)
	<div class="preloader" id="preloader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center #FFF;"></div>
@endif

@if($gs->is_popup== 1)

@if(isset($visited))
    <div style="display:none">
        <img src="{{asset('assets/images/'.$gs->popup_background)}}">
    </div>

    <!--  Starting of subscribe-pre-loader Area   -->
    <!--<div class="subscribe-preloader-wrap" id="subscriptionForm" style="display: none;">-->
    <!--    <div class="subscribePreloader__thumb" style="background-image: url({{asset('assets/images/'.$gs->popup_background)}});">-->
    <!--        <span class="preload-close"><i class="fas fa-times"></i></span>-->
    <!--        <div class="subscribePreloader__text text-center">-->
    <!--            <h1>{{$gs->popup_title}}</h1>-->
    <!--            <p>{{$gs->popup_text}}</p>-->
    <!--            <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">-->
    <!--                {{csrf_field()}}-->
    <!--                <div class="form-group">-->
    <!--                    <input type="email" name="email"  placeholder="{{ $langg->lang741 }}" required="">-->
    <!--                    <button id="sub-btn" type="submit">{{ $langg->lang742 }}</button>-->
    <!--                </div>-->
    <!--            </form>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!--  Ending of subscribe-pre-loader Area   -->

@endif

@endif

@if(Auth::check())
<div class="profile-own-bg" id="user-profile-mobile-header">
	<div class="personal-header-info">
		<div class="container">
			<div class="row">
				<div class="ezy-response-btn" style="position:absolute;right:15px;top:6px;z-index:9">
					<a href="javascript:show_dashboard_menu()"><i class='fas fa-bars text-white' style='font-size:24px'></i></a>
				</div>

				@if(Auth::user()->is_provider == 1)
				<div class="col-12" style="text-align:-webkit-center">
					<div class="profile-img" style="background: url({{ Auth::user()->photo ? asset(Auth::user()->photo):asset('assets/images/'.$gs->user_image) }})"></div>
				</div>
				@else
				<div class="col-12" style="text-align:-webkit-center">
					<div class="profile-img" style="background: url({{ Auth::user()->photo ? asset('assets/images/users/'.Auth::user()->photo):asset('assets/images/'.$gs->user_image) }})"></div>
				</div>
				@endif
				
				<div class="col-12 text-center">
					<b class="text-uppercase">{{ Auth::user()->name }}</b><br>
					<small>{{ Auth::user()->email }}</small>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

<div  style="background: url({{  asset('assets/images/header_pattern/3.jpg') }}) !important;background-repeat: no-repeat; background-size: cover !important;background-position: ;padding: 0px 0px!important;" id="ezy-header">
	<section class="top-header" style="background-color:rgba(0,0,0,0.89) !important">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 remove-padding">
					<div class="content ezy-top-header">
						<div class="left-content">
							<div class="list">
								<ul>

									@if($gs->is_language == 1)
									<li>
										<div class="language-selector">
											<i class="fas fa-globe-americas"></i>
											<select name="language" class="language selectors nice">
										@foreach(DB::table('languages')->get() as $language)
											<option value="{{route('front.language',$language->id)}}" {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }} >{{$language->language}}</option>
										@endforeach
											</select>
										</div>
									</li>
									@endif

									<!-- @if($gs->is_currency == 1)
									<li>
										<div class="currency-selector">
								<span>{{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign   : DB::table('currencies')->where('is_default','=',1)->first()->sign }}</span>
										<select name="currency" class="currency selectors nice">
										@foreach(DB::table('currencies')->get() as $currency)
											<option value="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }} >{{$currency->name}}</option>
										@endforeach
										</select>
										</div>
									</li>
									@endif -->


								</ul>
							</div>
						</div>
						<div class="right-content">
							<div class="list">
								<ul>
									@if(!Auth::guard('web')->check())
									<!-- <li class="login">
										<a href="{{ route('user.login') }}" class="sign-log">
											<div class="links">
												<span class="sign-in">{{ $langg->lang12 }}</span> <span>|</span>
												<span class="join">{{ $langg->lang13 }}</span>
											</div>
										</a>
									</li>	-->
									<li class="login">
										<a href="#" class="sign-log sign" data-toggle="modal" data-target="#myModal">	
											<span class="sign-in" style="color:#fff;">{{ $langg->lang12 }}</span>
										</a>
										<span style="color:#fff;">|</span>
										<a href="#" class="sign-log join" data-toggle="modal" data-target="#myModal">	
											<span class="join" style="color:#fff;">{{ $langg->lang13 }}</span>
										</a>
									</li>

<!-- LOGIN MODALAREA START -->
<div class="modal fade" id="myModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" aria-label="Close">
          <a href=""><span aria-hidden="true">&times;</span></a>
        </button>
      </div>
      <div class="modal-body">
				<nav class="comment-log-reg-tabmenu">
					<div class="nav nav-tabs" id="nav-tab" role="tablist">
						<a class="nav-item nav-link login active" id="nav-log-tab" data-toggle="tab" href="#nav-log" role="tab" aria-controls="nav-log" aria-selected="true">
							{{ $langg->lang197 }}
						</a>
						<a class="nav-item nav-link" id="nav-reg-tab" data-toggle="tab" href="#nav-reg" role="tab" aria-controls="nav-reg" aria-selected="false">
							{{ $langg->lang198 }}
						</a>
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-log" role="tabpanel" aria-labelledby="nav-log-tab">
				        <div class="login-area">
				          <div class="header-area">
				            <h4 class="title">{{ $langg->lang172 }}</h4>
				          </div>
				          <div class="login-form signin-form">
				                @include('includes.admin.form-login')
				            <form id="loginform" action="{{ route('user.login.submit') }}" method="POST">
				              {{ csrf_field() }}
				              <div class="form-input">
				                <input type="text" name="name" placeholder="user name" required="">
				                <i class="icofont-user-alt-5"></i>
				              </div>
				              <div class="form-input">
				                <input type="password" class="Password" name="password" placeholder="{{ $langg->lang174 }}" required="">
				                <i class="icofont-ui-password"></i>
				              </div>
				              <div class="form-forgot-pass">
				                <div class="left">
				              <input type="hidden" name="modal" value="1">
				                  <input type="checkbox" name="remember"  id="mrp" {{ old('remember') ? 'checked' : '' }}>
				                  <label for="mrp">{{ $langg->lang175 }}</label>
				                </div>
				                <div class="right">
				                  <a href="{{ route('user-forgot') }}">
				                    {{ $langg->lang176 }}
				                  </a>
				                </div>
				              </div>
				              <input id="authdata" type="hidden"  value="{{ $langg->lang177 }}">
				              <button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
					              <!-- @if(App\Models\Socialsetting::find(1)->f_check == 1 || App\Models\Socialsetting::find(1)->g_check == 1)
					              <div class="social-area">
					                  <h3 class="title">{{ $langg->lang179 }}</h3>
					                  <p class="text">{{ $langg->lang180 }}</p>
					                  <ul class="social-links">
					                    @if(App\Models\Socialsetting::find(1)->f_check == 1)
					                    <li>
					                      <a href="{{ route('social-provider','facebook') }}"> 
					                        <i class="fab fa-facebook-f"></i>
					                      </a>
					                    </li>
					                    @endif
					                    @if(App\Models\Socialsetting::find(1)->g_check == 1)
					                    <li>
					                      <a href="{{ route('social-provider','google') }}">
					                        <i class="fab fa-google-plus-g"></i>
					                      </a>
					                    </li>
					                    @endif
					                  </ul>
					              </div>
					              @endif -->
				            </form>
				          </div>
				        </div>
					</div>
					<div class="tab-pane fade" id="nav-reg" role="tabpanel" aria-labelledby="nav-reg-tab">
                <div class="login-area signup-area">
                    <div class="header-area">
                        <h4 class="title">{{ $langg->lang181 }}</h4>
                    </div>
                    <div class="login-form signup-form">
                       @include('includes.admin.form-login')
                        <form id="registerform" action="{{route('user-register-submit')}}" method="POST">
                          {{ csrf_field() }}

                            <div class="form-input">
                                <input type="text" class="User Name" name="name" placeholder="{{ $langg->lang182 }}" required="">
                                <i class="icofont-user-alt-5"></i>
                            </div>

                            <div class="form-input">
                                <input type="email" class="User Name" name="email" placeholder="{{ $langg->lang183 }}" required="">
                                <i class="icofont-email"></i>
                            </div>

                            <div class="form-input">
                                <input type="text" class="User Name" name="phone" placeholder="{{ $langg->lang184 }}" required="">
                                <i class="icofont-phone"></i>
                            </div>

                            <div class="form-input">
                                <input type="text" class="User Name" name="address" placeholder="{{ $langg->lang185 }}" required="">
                                <i class="icofont-location-pin"></i>
                            </div>

                            <div class="form-input">
                                <input type="password" class="Password" name="password" placeholder="{{ $langg->lang186 }}" required="">
                                <i class="icofont-ui-password"></i>
                            </div>

                            <div class="form-input">
                                <input type="password" class="Password" name="password_confirmation" placeholder="{{ $langg->lang187 }}" required="">
                                <i class="icofont-ui-password"></i>
                            </div>

@if($gs->is_capcha == 1)

                                    <ul class="captcha-area">
                                        <li>
                                            <p><img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i class="fas fa-sync-alt pointer refresh_code "></i></p>
                                        </li>
                                    </ul>

                            <div class="form-input">
                                <input type="text" class="Password" name="codes" placeholder="{{ $langg->lang51 }}" required="">
                                <i class="icofont-refresh"></i>
                            </div>

@endif

                            <input id="processdata" type="hidden"  value="{{ $langg->lang188 }}">
                            <button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>
                        
                        </form>
                    </div>
                </div>
					</div>
				</div>
      </div>
    </div>
  </div>
</div>
<!-- LOGIN MODAL ENDS -->
									@else
										<li class="profilearea my-dropdown">
											<a href="javascript: ;" id="profile-icon" class="profile carticon">
												<span class="text">
													<i class="far fa-user"></i>	{{ $langg->lang11 }} <i class="fas fa-chevron-down"></i>
												</span>
											</a>
											<div class="my-dropdown-menu profile-dropdown">
												<ul class="profile-links">
													<li>
														<a href="{{ route('user-dashboard') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang221 }}</a>
													</li>
													@if(Auth::user()->IsVendor())
													<li>
														<a href="{{ route('vendor-dashboard') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang222 }}</a>
													</li>
													@endif

													<li>
														<a href="{{ route('user-profile') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang205 }}</a>
													</li>

													<li>
														<a href="{{ route('user-logout') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang223 }}</a>
													</li>
												</ul>
											</div>
										</li>
									@endif


                        			@if($gs->reg_vendor == 1)
										<li>
                        				@if(Auth::check())
	                        				@if(Auth::guard('web')->user()->is_vendor == 2)
	                        					<a href="{{ route('vendor-dashboard') }}" class="sell-btn">{{ $langg->lang220 }}</a>	
	                        				@else
	                        					<a href="{{ route('user-package') }}" class="sell-btn">{{ $langg->lang220 }}</a>
	                        				@endif
										</li>
                        				@else
										<li>
											<!-- <a href="javascript:;" data-toggle="modal" data-target="#vendor-login" class="sell-btn">{{ $langg->lang220 }}</a> -->
										</li>
										@endif
									@endif


								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Top Header Area End -->

	<!-- Search Header Area Start -->
	<section class="logo-header ezy-search-header" style="background-color:rgba(0,0,0,0.85) !important">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-6 col-5 remove-padding ezy-logo">
					<div class="logo">
						<a href="{{ route('front.index') }}">
							<img src="{{asset('assets/images/'.$gs->logo)}}" class="ezy-logo-img" alt="">
						</a>
					</div>
				</div>
				<div class="col-lg-8 col-md-10 col-10 remove-padding order-last order-sm-2 order-md-2 ezy-search-box">
					<div class="search-box-wrapper">
						<div class="search-box">
							<div class="categori-container" id="catSelectForm">
								<select name="category" id="category_select" class="categoris">
									<!-- <option value="">{{ $langg->lang1 }}</option> -->
									<!-- @foreach($categories as $data)
									<option value="{{ $data->slug }}" {{ Request::route('category') == $data->slug ? 'selected' : '' }}>{{ $data->name }}</option>
									@endforeach -->
									<option value="product" {{Session::get('search_type') == 'product'?'selected':''}}>Product</option>
									<option value="store" {{Session::get('search_type') == 'store'?'selected':''}}>Store</option>
								</select>
							</div>

							<form id="searchForm" class="search-form" action="{{ route('front.global.search') }}" method="GET">
								@if (!empty(request()->input('sort')))
									<input type="hidden" name="sort" value="{{ request()->input('sort') }}">
								@endif
								@if (!empty(request()->input('minprice')))
									<input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">
								@endif
								@if (!empty(request()->input('maxprice')))
									<input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">
								@endif
								<input type="text" id="prod_name" name="search" placeholder="{{ $langg->lang2 }}" value="{{ request()->input('search') }}" autocomplete="off">
								<input type="hidden" id="search_type" name="search_type" value="">
								<div class="autocomplete">
									<div id="myInputautocomplete-list" class="autocomplete-items"></div>
								</div>
								<button type="submit"><i class="icofont-search-1"></i></button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-7 remove-padding order-lg-last ezy-small-icon">
					<div class="helpful-links">
						<ul class="helpful-links-inner">
							<li class="my-dropdown"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang3 }}">
								<a href="javascript:;" class="cart carticon">
									<div class="icon">
										<i class="icofont-cart"></i>
										<span class="cart-quantity" id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
									</div>

								</a>
								<div class="my-dropdown-menu" id="cart-items">
									@include('load.cart')
								</div>
							</li>
							<li class="wishlist"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang9 }}">
								@if(Auth::guard('web')->check())
									<a href="{{ route('user-wishlists') }}" class="wish">
										<i class="far fa-heart"></i>
										<span id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>
									</a>
								@else
									<a href="javascript:;" data-toggle="" id="wish-btn" data-target="#comment-log-reg" class="wish">
										<i class="far fa-heart"></i>
										<span id="wishlist-count">0</span>
									</a>
								@endif
							</li>
							<!-- <li class="compare"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang10 }}">
								<a href="{{ route('product.compare') }}" class="wish compare-product">
									<div class="icon">
										<i class="fas fa-exchange-alt"></i>
										<span id="compare-count">{{ Session::has('compare') ? count(Session::get('compare')->items) : '0' }}</span>
									</div>
								</a>
							</li> -->
							<li class="my-dropdown wishlist notif_list"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang900 }}" data-href="{{ route('user.notif.readall') }}">
								@if(Auth::guard('web')->check())
									@php
									$notifs = App\Models\NewNotification::getNewNotifs(Auth::user()->id, 0);
									@endphp
									<a href="{{route('user-notifications')}}" class="cart wish">
										<div class="icon">
											<i class="far fa-bell"></i>
											<span id="noti-count">{{ count($notifs) }}</span>
										</div>
									</a>
									<div class="my-dropdown-menu" id="noti-items">
										<div class="dropdownmenu-wrapper">			
										@if(count($notifs)>0)
											<ul class="dropdown-notifications">
												@foreach($notifs as $notif)
													<li class="notif">
														<div class="notif-details">
															{!!$notif->message!!}
															<div class="notif-remove" data-href="{{ route('user.notif.remove',$notif->id) }}" title="Remove Notification">
																<i class="icofont-close"></i>
															</div>
														</div>
													</li>
												@endforeach
											</ul>											
										@else 
										<p class="text-left">{{ $langg->lang439 }}</p>
										@endif
										</div>
										<div class="view-all"><a href="{{route('user-notifications')}}">{{__('View All')}}</a></div>
									</div>
								@else
									<a href="javascript:;" data-toggle="" id="noti-btn" data-target="#comment-log-reg" class="wish">
										<i class="far fa-bell"></i>
										<span id="noti-count">0</span>
									</a>
								@endif
							</li>

						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Search Header Area End -->

	<!-- Logo Header Area Start -->
	<section class="logo-header ezy-logo-header" id="logo-header" style="z-index: 1000;background-color:rgba(0,0,0,0.84) !important">
		<div class="container ezy-menu">
			<div class="row ">
				<!-- <div class="col-lg-2 col-sm-6 col-5 remove-padding">
					<div class="logo">
						<a href="{{ route('front.index') }}">
							<img src="{{asset('assets/images/'.$gs->logo)}}" alt="">
						</a>
					</div>
				</div> -->
				<div class="col-lg-4 col-md-12 col-12 ezy-location">
					<!-- <div class="form-group">
						<input type="text" class="form-control" id="location" placeholder="Location">
						<button class="btn btn-primary">Go</button>
					</div> -->
					@if(Session::has('geolocation'))
					<!--<form id="geolocation">-->
						<div class="input-group">
							<input class="form-control py-2 border-right-0 border" id="autocomplete" type="text" name="address" value="{{Session::get('geolocation')->address}}" placeholder="Enter your location">
							<span class="input-group-append">
								<button class="btn btn-outline-secondary border-left-0 border" type="button" id="btn_geolocation" style="background:white !important">
									<i class="fas fa-globe-asia" style="color: red" id="location_icon"></i>
									<!-- <i class="fa fa-spinner fa-spin" style="color: red"></i> -->
									<!-- Go -->
								</button>
							</span>
							<input type="hidden" name="latitude" id="latitude" value="{{Session::get('geolocation')->latitude}}"/>
							<input type="hidden" name="latitude" id="longitude" value="{{Session::get('geolocation')->longitude}}"/>
						</div>
					<!--</form>-->
					@else
					<!--<form id="geolocation">-->
						<div class="input-group">
							<input class="form-control py-2 border-right-0 border" type="text" name="address" placeholder="Enter your location" id="autocomplete">
							<span class="input-group-append">
								<button class="btn btn-outline-secondary border-left-0 border" type="button" id="btn_geolocation" style="background:white !important">
									<i class="fas fa-globe-asia" style="color: red" id="location_icon"></i>
									<!-- Go -->
								</button>
							</span>
							<input type="hidden" name="latitude" id="latitude"/>
							<input type="hidden" name="latitude" id="longitude"/>
						</div>
					<!--</form>-->
					@endif
				</div>
				<div class="col-lg-8 col-md-12 col-12 mainmenu-wrapper remove-padding ezy-mainmenu-wrapper">
					<nav hidden>
						<div class="nav-header">
							<button class="toggle-bar"><span class="fa fa-bars"></span></button>
							<div class="col-md-10 col-10 remove-padding order-last order-sm-2 order-md-2 ezy-search-box1">
								<div class="search-box-wrapper">
									<div class="search-box">
										<!--<div class="categori-container" id="catSelectForm">-->
										<!--	<select name="category" id="category_select" class="categoris">-->
										<!--		<option value="product_name">Product</option>-->
										<!--		<option value="store_name">Store</option>-->
										<!--	</select>-->
										<!--</div>-->

										<!--<form id="searchForm" class="search-form" action="{{ route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')]) }}" method="GET">-->
										<!--	@if (!empty(request()->input('sort')))-->
										<!--		<input type="hidden" name="sort" value="{{ request()->input('sort') }}">-->
										<!--	@endif-->
										<!--	@if (!empty(request()->input('minprice')))-->
										<!--		<input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">-->
										<!--	@endif-->
										<!--	@if (!empty(request()->input('maxprice')))-->
										<!--		<input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">-->
										<!--	@endif-->
										<!--	<input type="text" id="prod_name" name="search" placeholder="{{ $langg->lang2 }}" value="{{ request()->input('search') }}" autocomplete="off">-->
										<!--	<div class="autocomplete">-->
										<!--	<div id="myInputautocomplete-list" class="autocomplete-items">-->
										<!--	</div>-->
										<!--	</div>-->
										<!--	<button type="submit"><i class="icofont-search-1"></i></button>-->
										<!--</form>-->
									</div>
								</div>
							</div>
						</div>
						<ul class="menu">
							@if($gs->is_home == 1)
							<li><a href="{{ route('front.index') }}">{{ $langg->lang17 }}</a></li>
							@endif
							@foreach(DB::table('pages')->where('header','=',1)->get() as $data)
								<li><a href="{{ route('front.page',$data->slug) }}">{{ $data->title }}</a></li>
							@endforeach
							@if($gs->is_contact == 1)
							<li><a href="{{ route('front.contact') }}">{{ $langg->lang20 }}</a></li>
							@endif
							<!--<li>-->
							<!--	<a href="javascript:;" data-toggle="modal" data-target="#track-order-modal" class="track-btn">{{ $langg->lang16 }}</a>-->
							<!--</li>-->
							<li>
								<a href="{{ route('front.autodebit') }}">Auto Debit</a>
							</li>
							<li><a href="{{ route('front-scan-qrcode') }}">Scan</a></li>
						</ul>

					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- Logo Header Area End -->

	<!-- Logo Responsive Header Area Start -->
	<section class="logo-header ezy-logo-header ezy-logo-responsive-header" style="background-color:rgba(0,0,0,0.84) !important" id="responsive_search_box">
		<div class="container ezy-menu">
			<div class="row ">
				<div class="col-lg-6 col-md-12 col-12 mainmenu-wrapper remove-padding">
					<nav hidden>
						<div class="nav-header">
							<div class="col-md-12 col-12 remove-padding order-last order-sm-2 order-md-2 ezy-search-box1">
								<div class="search-box-wrapper">
									<div class="search-box">
										<div class="categori-container" id="catSelectForm">
											<select name="category" id="category_select1" class="categoris">
												<option value="product" {{Session::get('search_type') == 'product'?'selected':''}}>Product</option>
												<option value="store" {{Session::get('search_type') == 'store'?'selected':''}}>Store</option>
											</select>
										</div>

										<form id="searchForm" class="search-form" action="{{ route('front.global.search') }}" method="GET">
											@if (!empty(request()->input('sort')))
												<input type="hidden" name="sort" value="{{ request()->input('sort') }}">
											@endif
											@if (!empty(request()->input('minprice')))
												<input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">
											@endif
											@if (!empty(request()->input('maxprice')))
												<input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">
											@endif
											<input type="text" id="prod_name" name="search" placeholder="{{ $langg->lang2 }}" value="{{ request()->input('search') }}" autocomplete="off">
											<input type="hidden" id="search_type1" name="search_type" value="">
											<div class="autocomplete">
												<div id="myInputautocomplete-list" class="autocomplete-items"></div>
											</div>
											<button type="submit"><i class="icofont-search-1"></i></button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<ul class="menu" style="background: rgba(0,0,0,0.7);">
							@if($gs->is_home == 1)
							<li><a href="{{ route('front.index') }}">{{ $langg->lang17 }}</a></li>
							@endif
							@foreach(DB::table('pages')->where('header','=',1)->get() as $data)
								<li><a href="{{ route('front.page',$data->slug) }}">{{ $data->title }}</a></li>
							@endforeach
							@if($gs->is_contact == 1)
							<li><a href="{{ route('front.contact') }}">{{ $langg->lang20 }}</a></li>
							@endif
							<li>
								<a href="{{ route('front.autodebit') }}">Auto Debit</a>
							</li>
							<li><a href="{{ route('front-scan-qrcode') }}">Scan</a></li>
						</ul>

					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- Logo Header Area End -->

	<!--Main-Menu Area Start-->
	<div class="mainmenu-area mainmenu-bb" style="display: none" style="background-color:rgba(0,0,0,0.9) !important">
		<div class="container">
			<div class="row align-items-center mainmenu-area-innner">
				<div class="col-lg-3 col-md-6 categorimenu-wrapper remove-padding">
					<!--categorie menu start-->
					<div class="categories_menu">
						<div class="categories_title">
							<h2 class="categori_toggle"><i class="fa fa-bars"></i>  {{ $langg->lang14 }} <i class="fa fa-angle-down arrow-down"></i></h2>
						</div>
						<div class="categories_menu_inner">
							<ul>
								@php
								$i=1;
								@endphp
								@foreach($categories as $category)

								<li class="{{count($category->subs) > 0 ? 'dropdown_list':''}} {{ $i >= 15 ? 'rx-child' : '' }}">
								@if(count($category->subs) > 0)
									<div class="img">
										<img src="{{ asset('assets/images/categories/'.$category->photo) }}" alt="">
									</div>
									<div class="link-area">
										<span><a href="{{ route('front.category',$category->slug) }}">{{ $category->name }}</a></span>
										@if(count($category->subs) > 0)
										<a href="javascript:;">
											<i class="fa fa-angle-right" aria-hidden="true"></i>
										</a>
										@endif
									</div>

								@else
									<a href="{{ route('front.category',$category->slug) }}"><img src="{{ asset('assets/images/categories/'.$category->photo) }}"> {{ $category->name }}</a>

								@endif
									@if(count($category->subs) > 0)

									@php
									$ck = 0;
									foreach($category->subs as $subcat) {
										if(count($subcat->childs) > 0) {
											$ck = 1;
											break;
										}
									}
									@endphp
									<ul class="{{ $ck == 1 ? 'categories_mega_menu' : 'categories_mega_menu column_1' }}">
										@foreach($category->subs as $subcat)
											<li>
												<a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug]) }}">{{$subcat->name}}</a>
												@if(count($subcat->childs) > 0)
													<div class="categorie_sub_menu">
														<ul>
															@foreach($subcat->childs as $childcat)
															<li><a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug]) }}">{{$childcat->name}}</a></li>
															@endforeach
														</ul>
													</div>
												@endif
											</li>
										@endforeach
									</ul>

									@endif

									</li>

									@php
									$i++;
									@endphp

									@if($i == 15)
						                <li>
						                <a href="{{ route('front.categories') }}"><i class="fas fa-plus"></i> {{ $langg->lang15 }} </a>
						                </li>
						                @break
									@endif


									@endforeach

							</ul>
						</div>
					</div>
					<!--categorie menu end-->
				</div>
				<div class="col-lg-9 col-md-6 mainmenu-wrapper remove-padding">
					<nav hidden>
						<div class="nav-header">
							<button class="toggle-bar"><span class="fa fa-bars"></span></button>
						</div>
						<ul class="menu">
							@if($gs->is_home == 1)
							<li><a href="{{ route('front.index') }}">{{ $langg->lang17 }}</a></li>
							@endif
							<li><a href="{{ route('front.blog') }}">{{ $langg->lang18 }}</a></li>
							@if($gs->is_faq == 1)
							<li><a href="{{ route('front.faq') }}">{{ $langg->lang19 }}</a></li>
							@endif
							@foreach(DB::table('pages')->where('header','=',1)->get() as $data)
								<li><a href="{{ route('front.page',$data->slug) }}">{{ $data->title }}</a></li>
							@endforeach
							@if($gs->is_contact == 1)
							<li><a href="{{ route('front.contact') }}">{{ $langg->lang20 }}</a></li>
							@endif
							<li>
								<a href="javascript:;" data-toggle="modal" data-target="#track-order-modal" class="track-btn">{{ $langg->lang16 }}</a>
							</li>
						</ul>

					</nav>
				</div>
			</div>
		</div>
	</div>
	<!--Main-Menu Area End-->
</div>
@yield('content')

<!--bottom menu in mobile start-->
<div class="footer-device-mobile visible-xxs user-account-footer-menu" style="padding: 0px 15px;box-shadow: 0px 0px 10px -6px rgb(0 0 0 / 66%);">
	<div class="device-home active" style="margin: 10px 6px;">
		<a href="{{ route('front.index') }}"><i class='fas fa-home' style='font-size:24px;color:#007bff'></i></a>
		<a href="{{ route('front.index') }}" style='margin: 0px 5px;color:#007bff !important'>Home</a>   
	</div>
	<div class="device-home active" style="margin: 10px 6px;">
		<a href="{{route('front.nearbymerchant')}}"><i class='fas fa-map-marked-alt' style='font-size:24px;color:#007bff'></i></a> 
		<a href="{{ route('front.nearbymerchant') }}" style='margin: 0px 5px;color:#007bff !important'>Nearby</a>
	</div>
	<div class="device-home active" style="margin: 10px 6px;"> 
		<a href="javascript:show_searchbox()"><i class='fas fa-search' style='font-size:24px;color:#007bff'></i></a>
		<a href="javascript:show_searchbox()" style='margin: 0px 5px;color:#007bff !important'>Search</a>  
	</div>
	<div class="device-home active" style="margin: 10px 6px;">
		<a href="{{ route('front-scan-qrcode') }}"><i class="fa fa-qrcode" style="font-size:24px;color:#007bff"></i></a>
		<a href="{{ route('front-scan-qrcode') }}" style="margin: 0px 10px;color:#007bff !important">Scan</a>   
	</div>
	<div class="device-home active" style="margin: 10px 6px;">
		<a href="{{ route('user-dashboard') }}"><i class='fas fa-user-alt' style='font-size:24px;color:#007bff'></i></a>
		<a href="{{ route('user-dashboard') }}" style='margin: 0px 5px;color:#007bff !important'>Account</a>
	</div>
</div>
<!--bottom menu in mobile end-->

<div  style="background: url({{  asset('assets/images/header_pattern/3.jpg') }}) !important;background-repeat: no-repeat; background-size: cover !important;background-position: ;padding: 0px 0px!important;" id="ezy-footer">
	<!-- Footer Area Start -->
	<footer class="footer" id="footer" style="background-color:rgba(0,0,0,0.88) !important">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-4">
					<div class="footer-info-area">
						<div class="footer-logo">
							<a href="{{ route('front.index') }}" class="logo-link">
								<img src="{{asset('assets/images/'.$gs->footer_logo)}}" alt="">
							</a>
						</div>
						<div class="text" style="display: none">
							<p>
									{!! $gs->footer !!}
							</p>
						</div>
					</div>
					<div class="fotter-social-links">
						<ul>

                               	     @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="facebook" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->g_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="google-plus" target="_blank">
                                            <i class="fab fa-google-plus-g"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="twitter" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="linkedin" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if(App\Models\Socialsetting::find(1)->d_status == 1)
                                      <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="dribbble" target="_blank">
                                            <i class="fab fa-dribbble"></i>
                                        </a>
                                      </li>
                                      @endif

						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-4">
					<div class="footer-widget info-link-widget">
						<h4 class="title">
								{{ $langg->lang21 }}
						</h4>
						<ul class="link-list">
							<li>
								<a href="{{ route('front.index') }}">
									<i class="fas fa-angle-double-right"></i>{{ $langg->lang22 }}
								</a>
							</li>

							@foreach(DB::table('pages')->where('footer','=',1)->get() as $data)
							<li>
								<a href="{{ route('front.page',$data->slug) }}">
									<i class="fas fa-angle-double-right"></i>{{ $data->title }}
								</a>
							</li>
							@endforeach

							<li>
								<a href="{{ route('front.contact') }}">
									<i class="fas fa-angle-double-right"></i>{{ $langg->lang23 }}
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-4">
					<div class="footer-widget recent-post-widget">
						<h4 class="title">
							{{ $langg->lang24 }}
						</h4>
						<ul class="post-list">
							@foreach (App\Models\Blog::orderBy('created_at', 'desc')->limit(3)->get() as $blog)
							<li>
								<div class="post">
								  <div class="post-img">
									<img style="width: 73px; height: 59px;" src="{{ asset('assets/images/blogs/'.$blog->photo) }}" alt="">
								  </div>
								  <div class="post-details">
									<a href="{{ route('front.blogshow',$blog->id) }}">
										<h4 class="post-title">
											{{mb_strlen($blog->title,'utf-8') > 45 ? mb_substr($blog->title,0,45,'utf-8')." .." : $blog->title}}
										</h4>
									</a>
									<p class="date">
										{{ date('M d - Y',(strtotime($blog->created_at))) }}
									</p>
								  </div>
								</div>
							  </li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="copy-bg" style="background-color:rgba(0, 0, 0, 0.23) !important">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
							<div class="content">
								<div class="content">
									<p>{!! $gs->copyright !!}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer Area End -->

	<!-- Back to Top Start -->
	<div class="bottomtotop" style="background-color:rgba(0,0,0,0.8) !important">
		<i class="fas fa-chevron-right"></i>
	</div>
	<!-- Back to Top End -->
</div>
	<!-- LOGIN MODAL -->
	<div class="modal fade" id="comment-log-reg" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title"
		aria-hidden="true">
		<div class="modal-dialog  modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<nav class="comment-log-reg-tabmenu">
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link login active" id="nav-log-tab1" data-toggle="tab" href="#nav-log1"
								role="tab" aria-controls="nav-log" aria-selected="true">
								{{ $langg->lang197 }}
							</a>
							<a class="nav-item nav-link" id="nav-reg-tab1" data-toggle="tab" href="#nav-reg1" role="tab"
								aria-controls="nav-reg" aria-selected="false">
								{{ $langg->lang198 }}
							</a>
						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-log1" role="tabpanel"
							aria-labelledby="nav-log-tab1">
							<div class="login-area">
								<div class="header-area">
									<h4 class="title">{{ $langg->lang172 }}</h4>
								</div>
								<div class="login-form signin-form">
									@include('includes.admin.form-login')
									<form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
										{{ csrf_field() }}
										<div class="form-input">
											<input type="text" name="name" placeholder="{{ $langg->lang173 }}"
												required="">
											<i class="icofont-user-alt-5"></i>
										</div>
										<div class="form-input">
											<input type="password" class="Password" name="password"
												placeholder="{{ $langg->lang174 }}" required="">
											<i class="icofont-ui-password"></i>
										</div>
										<div class="form-forgot-pass">
											<div class="left">
												<input type="checkbox" name="remember" id="mrp"
													{{ old('remember') ? 'checked' : '' }}>
												<label for="mrp">{{ $langg->lang175 }}</label>
											</div>
											<div class="right">
												<a href="javascript:;" id="show-forgot">
													{{ $langg->lang176 }}
												</a>
											</div>
										</div>
										<input type="hidden" name="modal" value="1">
										<input class="mauthdata" type="hidden" value="{{ $langg->lang177 }}">
										<button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
										@if(App\Models\Socialsetting::find(1)->f_check == 1 ||
										App\Models\Socialsetting::find(1)->g_check == 1)
										<div class="social-area">
											<h3 class="title">{{ $langg->lang179 }}</h3>
											<p class="text">{{ $langg->lang180 }}</p>
											<ul class="social-links">
												@if(App\Models\Socialsetting::find(1)->f_check == 1)
												<li>
													<a href="{{ route('social-provider','facebook') }}">
														<i class="fab fa-facebook-f"></i>
													</a>
												</li>
												@endif
												@if(App\Models\Socialsetting::find(1)->g_check == 1)
												<li>
													<a href="{{ route('social-provider','google') }}">
														<i class="fab fa-google-plus-g"></i>
													</a>
												</li>
												@endif
											</ul>
										</div>
										@endif
									</form>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="nav-reg1" role="tabpanel" aria-labelledby="nav-reg-tab1">
							<div class="login-area signup-area">
								<div class="header-area">
									<h4 class="title">{{ $langg->lang181 }}</h4>
								</div>
								<div class="login-form signup-form">
									@include('includes.admin.form-login')
									<form class="mregisterform" action="{{route('user-register-submit')}}"
										method="POST">
										{{ csrf_field() }}

										<div class="form-input">
											<input type="text" class="User Name" name="name"
												placeholder="{{ $langg->lang182 }}" required="">
											<i class="icofont-user-alt-5"></i>
										</div>

										<div class="form-input">
											<input type="email" class="User Name" name="email"
												placeholder="{{ $langg->lang183 }}" required="">
											<i class="icofont-email"></i>
										</div>

										<div class="form-input">
											<input type="text" class="User Name" name="phone"
												placeholder="{{ $langg->lang184 }}" required="">
											<i class="icofont-phone"></i>
										</div>

										<div class="form-input">
											<input type="text" class="User Name" name="address"
												placeholder="{{ $langg->lang185 }}" required="">
											<i class="icofont-location-pin"></i>
										</div>

										<div class="form-input">
											<input type="password" class="Password" name="password"
												placeholder="{{ $langg->lang186 }}" required="">
											<i class="icofont-ui-password"></i>
										</div>

										<div class="form-input">
											<input type="password" class="Password" name="password_confirmation"
												placeholder="{{ $langg->lang187 }}" required="">
											<i class="icofont-ui-password"></i>
										</div>


										@if($gs->is_capcha == 1)

										<ul class="captcha-area">
											<li>
												<p><img class="codeimg1"
														src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i
														class="fas fa-sync-alt pointer refresh_code "></i></p>
											</li>
										</ul>

										<div class="form-input">
											<input type="text" class="Password" name="codes"
												placeholder="{{ $langg->lang51 }}" required="">
											<i class="icofont-refresh"></i>
										</div>


										@endif

										<input class="mprocessdata" type="hidden" value="{{ $langg->lang188 }}">
										<button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- LOGIN MODAL ENDS -->

	<!-- FORGOT MODAL -->
	<div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title"
		aria-hidden="true">
		<div class="modal-dialog  modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="login-area">
						<div class="header-area forgot-passwor-area">
							<h4 class="title">{{ $langg->lang191 }} </h4>
							<p class="text">{{ $langg->lang192 }} </p>
						</div>
						<div class="login-form">
							@include('includes.admin.form-login')
							<form id="mforgotform" action="{{route('user-forgot-submit')}}" method="POST">
								{{ csrf_field() }}
								<div class="form-input">
									<input type="email" name="email" class="User Name"
										placeholder="{{ $langg->lang193 }}" required="">
									<i class="icofont-user-alt-5"></i>
								</div>
								<div class="to-login-page">
									<a href="javascript:;" id="show-login">
										{{ $langg->lang194 }}
									</a>
								</div>
								<input class="fauthdata" type="hidden" value="{{ $langg->lang195 }}">
								<button type="submit" class="submit-btn">{{ $langg->lang196 }}</button>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- FORGOT MODAL ENDS -->


<!-- VENDOR LOGIN MODAL -->
	<div class="modal fade" id="vendor-login" tabindex="-1" role="dialog" aria-labelledby="vendor-login-Title" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" style="transition: .5s;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<nav class="comment-log-reg-tabmenu">
					<div class="nav nav-tabs" id="nav-tab1" role="tablist">
						<a class="nav-item nav-link login active" id="nav-log-tab11" data-toggle="tab" href="#nav-log11" role="tab" aria-controls="nav-log" aria-selected="true">
							{{ $langg->lang234 }}
						</a>
						<a class="nav-item nav-link" id="nav-reg-tab11" data-toggle="tab" href="#nav-reg11" role="tab" aria-controls="nav-reg" aria-selected="false">
							{{ $langg->lang235 }}
						</a>
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-log11" role="tabpanel" aria-labelledby="nav-log-tab">
				        <div class="login-area">
				          <div class="login-form signin-form">
				                @include('includes.admin.form-login')
				            <form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
				              {{ csrf_field() }}
				              <div class="form-input">
				                <input type="email" name="email" placeholder="{{ $langg->lang173 }}" required="">
				                <i class="icofont-user-alt-5"></i>
				              </div>
				              <div class="form-input">
				                <input type="password" class="Password" name="password" placeholder="{{ $langg->lang174 }}" required="">
				                <i class="icofont-ui-password"></i>
				              </div>
				              <div class="form-forgot-pass">
				                <div class="left">
				                  <input type="checkbox" name="remember"  id="mrp1" {{ old('remember') ? 'checked' : '' }}>
				                  <label for="mrp1">{{ $langg->lang175 }}</label>
				                </div>
				                <div class="right">
				                  <a href="javascript:;" id="show-forgot1">
				                    {{ $langg->lang176 }}
				                  </a>
				                </div>
				              </div>
				              <input type="hidden" name="modal"  value="1">
				               <input type="hidden" name="vendor"  value="1">
				              <input class="mauthdata" type="hidden"  value="{{ $langg->lang177 }}">
				              <button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
					              @if(App\Models\Socialsetting::find(1)->f_check == 1 || App\Models\Socialsetting::find(1)->g_check == 1)
					              <div class="social-area">
					                  <h3 class="title">{{ $langg->lang179 }}</h3>
					                  <p class="text">{{ $langg->lang180 }}</p>
					                  <ul class="social-links">
					                    @if(App\Models\Socialsetting::find(1)->f_check == 1)
					                    <li>
					                      <a href="{{ route('social-provider','facebook') }}">
					                        <i class="fab fa-facebook-f"></i>
					                      </a>
					                    </li>
					                    @endif
					                    @if(App\Models\Socialsetting::find(1)->g_check == 1)
					                    <li>
					                      <a href="{{ route('social-provider','google') }}">
					                        <i class="fab fa-google-plus-g"></i>
					                      </a>
					                    </li>
					                    @endif
					                  </ul>
					              </div>
					              @endif
				            </form>
				          </div>
				        </div>
					</div>
					<div class="tab-pane fade" id="nav-reg11" role="tabpanel" aria-labelledby="nav-reg-tab">
                <div class="login-area signup-area">
                    <div class="login-form signup-form">
                       @include('includes.admin.form-login')
                        <form class="mregisterform" action="{{route('user-register-submit')}}" method="POST">
                          {{ csrf_field() }}

                          <div class="row">

                          <div class="col-lg-6">
                            <div class="form-input">
                                <input type="text" class="User Name" name="name" placeholder="{{ $langg->lang182 }}" required="">
                                <i class="icofont-user-alt-5"></i>
                            	</div>
                           </div>

                           <div class="col-lg-6">
 <div class="form-input">
                                <input type="email" class="User Name" name="email" placeholder="{{ $langg->lang183 }}" required="">
                                <i class="icofont-email"></i>
                            </div>

                           	</div>
                           <div class="col-lg-6">
    <div class="form-input">
                                <input type="text" class="User Name" name="phone" placeholder="{{ $langg->lang184 }}" required="">
                                <i class="icofont-phone"></i>
                            </div>

                           	</div>
                           <div class="col-lg-6">

<div class="form-input">
                                <input type="text" class="User Name" name="address" placeholder="{{ $langg->lang185 }}" required="">
                                <i class="icofont-location-pin"></i>
                            </div>
                           	</div>

                           <div class="col-lg-6">
 <div class="form-input">
                                <input type="text" class="User Name" name="shop_name" placeholder="{{ $langg->lang238 }}" required="">
                                <i class="icofont-cart-alt"></i>
                            </div>

                           	</div>
                           <div class="col-lg-6">

 <div class="form-input">
                                <input type="text" class="User Name" name="owner_name" placeholder="{{ $langg->lang239 }}" required="">
                                <i class="icofont-cart"></i>
                            </div>
                           	</div>
                           <div class="col-lg-6">

<div class="form-input">
                                <input type="text" class="User Name" name="shop_number" placeholder="{{ $langg->lang240 }}" required="">
                                <i class="icofont-shopping-cart"></i>
                            </div>
                           	</div>
                           <div class="col-lg-6">

 <div class="form-input">
                                <input type="text" class="User Name" name="shop_address" placeholder="{{ $langg->lang241 }}" required="">
                                <i class="icofont-opencart"></i>
                            </div>
                           	</div>
                           <div class="col-lg-6">

<div class="form-input">
                                <input type="text" class="User Name" name="reg_number" placeholder="{{ $langg->lang242 }}" required="">
                                <i class="icofont-ui-cart"></i>
                            </div>
                           	</div>
                           <div class="col-lg-6">

 <div class="form-input">
                                <input type="text" class="User Name" name="shop_message" placeholder="{{ $langg->lang243 }}" required="">
                                <i class="icofont-envelope"></i>
                            </div>
                           	</div>

                           <div class="col-lg-6">
  <div class="form-input">
                                <input type="password" class="Password" name="password" placeholder="{{ $langg->lang186 }}" required="">
                                <i class="icofont-ui-password"></i>
                            </div>

                           	</div>
                           <div class="col-lg-6">
 								<div class="form-input">
                                <input type="password" class="Password" name="password_confirmation" placeholder="{{ $langg->lang187 }}" required="">
                                <i class="icofont-ui-password"></i>
                            	</div>
                           	</div>

                            @if($gs->is_capcha == 1)

<div class="col-lg-6">


                            <ul class="captcha-area">
                                <li>
                                 	<p>
                                 		<img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i class="fas fa-sync-alt pointer refresh_code "></i>
                                 	</p>

                                </li>
                            </ul>


</div>

<div class="col-lg-6">

 <div class="form-input">
                                <input type="text" class="Password" name="codes" placeholder="{{ $langg->lang51 }}" required="">
                                <i class="icofont-refresh"></i>

                            </div>



                          </div>

                          @endif

				            <input type="hidden" name="vendor"  value="1">
                            <input class="mprocessdata" type="hidden"  value="{{ $langg->lang188 }}">
                            <button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>

                           	</div>




                        </form>
                    </div>
                </div>
					</div>
				</div>
      </div>
    </div>
  </div>
</div>
<!-- VENDOR LOGIN MODAL ENDS -->

<!-- Product Quick View Modal -->

	  <div class="modal fade" id="quickview" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog quickview-modal modal-dialog-centered modal-lg" role="document">
		  <div class="modal-content">
			<div class="submit-loader">
				<img src="{{asset('assets/images/'.$gs->loader)}}" alt="">
			</div>
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
				<div class="container quick-view-modal">

				</div>
			</div>
		  </div>
		</div>
	  </div>
<!-- Product Quick View Modal -->

<!-- Order Tracking modal Start-->
    <div class="modal fade" id="track-order-modal" tabindex="-1" role="dialog" aria-labelledby="order-tracking-modal" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"> <b>{{ $langg->lang772 }}</b> </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                        <div class="order-tracking-content">
                            <form id="track-form" class="track-form">
                                {{ csrf_field() }}
                                <input type="text" id="track-code" placeholder="{{ $langg->lang773 }}" required="">
                                <button type="submit" class="mybtn1">{{ $langg->lang774 }}</button>
                                <a href="#"  data-toggle="modal" data-target="#order-tracking-modal"></a>
                            </form>
                        </div>

                        <div>
				            <div class="submit-loader d-none">
								<img src="{{asset('assets/images/'.$gs->loader)}}" alt="">
							</div>
							<div id="track-order">

							</div>
                        </div>

            </div>
            </div>
        </div>
    </div>
<!-- Order Tracking modal End -->

<script type="text/javascript">
  var mainurl = "{{url('/')}}";
  var gs      = {!! json_encode($gs) !!};
  var langg    = {!! json_encode($langg) !!};

  window.onscroll = function() {myFunction()};

	var header = document.getElementById("logo-header");
	var sticky = header.offsetTop;

	function myFunction() {
		if (window.pageYOffset > sticky) {
			header.classList.add("sticky");
		} else {
			header.classList.remove("sticky");
		}
	}
</script>

	<!-- jquery -->
	<script src="{{asset('assets/front/js/jquery.js')}}"></script>
	{{-- <script src="{{asset('assets/front/js/vue.js')}}"></script> --}}
	<script src="{{asset('assets/front/jquery-ui/jquery-ui.min.js')}}"></script>
	<!-- popper -->
	<script src="{{asset('assets/front/js/popper.min.js')}}"></script>
	<!-- bootstrap -->
	<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
	<!-- plugin js-->
	<script src="{{asset('assets/front/js/plugin.js')}}"></script>

	<script src="{{asset('assets/front/js/xzoom.min.js')}}"></script>
	<script src="{{asset('assets/front/js/jquery.hammer.min.js')}}"></script>
	<script src="{{asset('assets/front/js/jquery.number.min.js')}}"></script>
	<script src="{{asset('assets/front/js/setup.js')}}"></script>

	<script src="{{asset('assets/front/js/toastr.js')}}"></script>
	<!-- main -->
	<script src="{{asset('assets/front/js/main.js')}}"></script>
	<!-- custom -->
	<script src="{{asset('assets/front/js/custom.js')}}"></script>

    {!! $seo->google_analytics !!}

	@if($gs->is_talkto == 1)
		<!--Start of Tawk.to Script-->
		{!! $gs->talkto !!}
		<!--End of Tawk.to Script-->
	@endif
	
	<script type="text/javascript">
		var isInitGeoLocate = parseInt("{{empty($geolocation->address)?1:0}}");
		var isFullAddress = true;
		var is_affiliate = 0;
		var loadNerbyVendors = function(data) {
			$('#nearby-store').html(data);
			$('#location_icon').removeClass( "fa fa-spinner fa-spin" ).addClass("fas fa-globe-asia" );
		}
		$(document).ready(function() {

			setGeolocation($('#range-value').val());
			console.log("latitude is" + $('#latitude').val());
			console.log("longitude is" + $('#longitude').val());
			
			$("#autocomplete").keyup(function(e){
				console.log(12)
				if (e.keyCode === 13) {
					$('#location_icon').removeClass( "fas fa-globe-asia" ).addClass( "fa fa-spinner fa-spin" );
					var latitude = $('#latitude').val();
					var longitude = $('#longitude').val();			
					if(latitude=='' || longitude=='' || latitude=='0' || longitude=='0') {
						showError("Please enter address correctly to get getlocation.\n You might not be supported Nearby Service.");					
						return false;
					}
					setGeolocation($('#range-value').val());
				}
			});

			$(document).on('click', '#btn_geolocation', function(e) { 
				$('#location_icon').removeClass( "fas fa-globe-asia" ).addClass( "fa fa-spinner fa-spin" );
				var latitude = $('#latitude').val();
				var longitude = $('#longitude').val();			
				if(latitude=='' || longitude=='' || latitude=='0' || longitude=='0') {
					showError("Please enter address correctly to get getlocation.\n You might not be supported Nearby Service.");					
					return false;
				}
				
				setGeolocation($('#range-value').val());
			});
			@if(Session::has('affilate') && !Auth::check())			
			is_affiliate = 1;
			$('#myModal').modal('toggle');
			@endif
			$('#myModal').on('shown.bs.modal', function(e) {
				$('.refresh_code').trigger('click');				
				var target = $(e.relatedTarget);				
				if(target.hasClass('sign')) {
					$('#nav-log-tab').trigger('click');
				}
				if(target.hasClass('join') || is_affiliate == 1) {
					$('#nav-reg-tab').trigger('click');
					is_affiliate = 0;
				}
			});
		});
	</script>
	
	<script>
		//--------user dashbord response btn start
		function show_dashboard_menu() {
			$("#responsive-list").slideToggle("slow");
		}
		//--------user dashbord response btn end
		
		function show_searchbox() {
			$('#responsive_search_box').slideToggle("slow");
		}
	</script>
	
	<script src="{{asset('assets/front/js/geocoder.js') }}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key={{$gs->map_api_key}}&libraries=places&callback=initAutocomplete" async defer></script>
	
	@yield('scripts')
	

</body>

</html>

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
<style>
	.vendor-banner{padding: 20px;}
	.ezy-img-circle{max-width: 100px;}
	.vendor-title{    
		width: calc(100% - 100px);
		display: flex;    	
    	align-items: center;
    	margin-left: 10px;
	}
	.input-group-text{min-width: 51px; text-align: center; display:inline;}
	.scanpay{
		padding: 15px;
    	border: 2px solid green;
    	margin-top: 20px;
	}
	.success-title i{
		color: green;
	}
	.success-title i.fa-check{color: #fff;}
</style>

</head>

<body>
<div class="preloader" id="preloader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center #FFF;"></div>

<div style="background: url({{  asset('assets/images/header_pattern/3.jpg') }}) !important;background-repeat: no-repeat; background-size: cover !important;background-position: ;padding: 0px 0px!important;">
	<!-- Search Header Area Start -->
	<section class="logo-header ezy-search-header" style="background-color:rgba(0,0,0,0.85) !important">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-6 col-5 remove-padding ezy-logo">
					<div class="logo">
						<a href="{{ route('front.index') }}">
							<img src="{{asset('assets/images/'.$gs->logo)}}" alt="">
						</a>
					</div>
				</div>
				<div class="col-lg-10 col-md-6 col-7 d-flex">					
					<div class="ml-auto">
						@if(!Auth::guard('web')->check())
						<a href="#" class="sign-log sign" data-toggle="modal" data-target="#myModal">	
							<span class="sign-in" style="color:#fff;">{{ $langg->lang12 }}</span>
						</a>
						<span style="color:#fff;">|</span>
						<a href="#" class="sign-log join" data-toggle="modal" data-target="#myModal">	
							<span class="join" style="color:#fff;">{{ $langg->lang13 }}</span>
						</a>
						@else
						<a href="{{route('user-logout')}}">	
							<span class="join" style="color:#fff;">Logout</span>
						</a>
						@endif
					</div>					
				</div>
			</div>
		</div>				
	</section>	
</div>
<section class="hero-area p-3">
	<div class="text-center">
	@if(!Auth::guard('web')->check())	
		<h4>Please <a href="#" class="sign-log sign" data-toggle="modal" data-target="#myModal">login</a> to pay</h4>
	@else
		<!-- Vendor Area Start -->
		<div class="vendor-banner" style="background: url({{  $vendor->shop_image != null ? asset('assets/images/vendorbanner/'.$vendor->shop_image) : '' }}); background-repeat: no-repeat; background-size: cover;background-position: center;{!! $vendor->shop_image != null ? '' : 'background-color:'.$gs->vendor_color !!} ">
    		<div class="d-flex">      			
				<img src="{{ !empty($vendor->shop_logo)?asset('assets/images/vendorlogo/'.$vendor->shop_logo):asset('assets/images/vendorlogo/default_logo.jpg') }}" class="ezy-img-circle" alt="">
				<div class="vendor-title">
					<h2 class="title">{{ $vendor->shop_name }}</h2>
				</div>
    		</div>
  		</div>
		<div class="scanpay">						
			<h4 class="success-title">
				<span class="fa-stack">
  					<i class="fa fa-circle fa-stack-2x icon-background"></i>
  					<i class="fa fa-check fa-stack-1x"></i>
				</span>
				<br>Successful Payment!
			</h4>
			<h5>Payment Amount : {{Session::get('payment_amount')}}</h5>
			<a href="{{route('user-scanpay-index', $vendor->id)}}" class="btn btn-primary">Continue Payment</a>
		</div>
	@endif
	</div>
</section>
<div  style="background: url({{  asset('assets/images/header_pattern/3.jpg') }}) !important;background-repeat: no-repeat; background-size: cover !important;background-position: ;padding: 0px 0px!important;">
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
<!-- LOGIN MODALAREA START -->
<div class="modal fade" id="myModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" aria-label="Close" data-dismiss="modal">
          			<span aria-hidden="true">&times;</span>
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
				                		<input type="email" name="email" placeholder="{{ $langg->lang173 }}" required="">
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
				                  			<a href="{{ route('user-forgot') }}">{{ $langg->lang176 }}</a>
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

<script type="text/javascript">
  var mainurl = "{{url('/')}}";
  var gs      = {!! json_encode($gs) !!};
  var langg    = {!! json_encode($langg) !!};
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
	<script src="{{asset('assets/front/js/setup.js')}}"></script>

	<script src="{{asset('assets/front/js/toastr.js')}}"></script>
	<!-- main -->
	<script src="{{asset('assets/front/js/main.js')}}"></script>
	<!-- custom -->
	<script src="{{asset('assets/front/js/custom.js')}}"></script>

    {!! $seo->google_analytics !!}
	
	<script type="text/javascript">
		$(document).ready(function() {
			$(window).on("load", function (e) {
				setTimeout(function(){
					$('#preloader').fadeOut(500);
				},100)
			});
		});
	</script>

</body>

</html>

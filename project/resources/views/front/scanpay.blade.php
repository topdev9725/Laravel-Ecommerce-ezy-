<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
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

    <!-- stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common.css')}}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{asset('assets/front/css/responsive.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/common-responsive.css')}}">

    <!--Updated CSS-->
    <link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&amp;'.'header_color='.str_replace('#','',$gs->header_color).'&amp;'.'footer_color='.str_replace('#','',$gs->footer_color).'&amp;'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&amp;'.'menu_color='.str_replace('#','',$gs->menu_color).'&amp;'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">
    
    <style>
		#deviceModal .modal-header{margin-top: 10px; font-weight:bold;}
		.device label{display: flex; }
		.device label span{line-height: 38px; margin-left: 10px;}
		.device .form-control{display: inline-block;width:30px;}
		.hero-area{border: 2px solid green;   margin: 10px;  min-height: 50vh;}
		#reader{border:none !important;}
		#reader > div > span:nth-child(1){font-size: 25px; color: #0f0f7f; font-weight: bold;}
		#reader__dashboard_section_csr button{
			color: white;
    		background-color: #fd8803;
    		border-color: #fd8803;
    		font-size: 20px;    
    		border-radius: 5px;
			margin: 10px 0 20px;
			padding: 5px 10px;
		}
		#reader__dashboard_section_csr select{width: 100%;}
		/*#reader__dashboard_section_swaplink{display:none;}*/
		#reader__scan_region > img{width: 40%;}
	</style>
    <script src="{{asset('assets/front/js/html5-qrcode.min.js')}}"></script>
</head>
<body>

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
    <!-- <h3>QR Code Scanner</h3>	 -->
    <div id="qr-reader-error" style="color: red;"></div>
    <div id="reader" style="width:100%"></div>    
	<div id="qr-reader-results"></div>
</section>
<div class="modal fade" id="deviceModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
      		<div class="modal-header">
        		Please Choose a Camera Device To Scan
      		</div>
      		<div class="modal-body">
			  	<div class="devices">				  	
				</div>
			</div>
		</div>
	</div>
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
				                		<input type="text" name="name" placeholder="User name" required="">
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
<script>
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

<script>

function onScanSuccess(qrMessage) {
	// handle the scanned code as you like
	console.log(`QR matched = ${qrMessage}`);
	location.href = decodeURIComponent(qrMessage);
}

function onScanFailure(error) {
	// handle scan failure, usually better to ignore and keep scanning
	console.warn(`QR error = ${error}`);
	//$('#qr-reader-error').text(error);

}

let html5QrcodeScanner = new Html5QrcodeScanner(
	"reader", { fps: 10, qrbox: 250 }, /* verbose= */ true);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);

$(document).ready(function() {	
	//This method will trigger user permissions	
	// Html5Qrcode.getCameras().then(devices => {
	// 	/**
	// 	 * devices would be an array of objects of type:
	// 	 * { id: "id", label: "label" }
	// 	 */	
	// 	if (devices && devices.length) {
	// 		// if(devices.length>1) {
	// 		// 	startScan(devices[1].id);
	// 		// } else {
	// 		// 	startScan(devices[0].id);
	// 		// }
	// 		var html = '';
	// 		for(var i=0;i<devices.length;i++) {				
	// 			html += '<div class="device"><label><input type="radio" name="device" id="device'+i+'" class="form-control device_control" data-id="' + devices[i].id + '" /><span>' + devices[i].label + '</span></label></div>';
	// 		}
	// 		$('.devices', $('#deviceModal')).html(html);
	// 		$('#deviceModal').modal('show');			
	// 	} else {
	// 		$('#qr-reader-error').text('Can not find any camera device');
	// 	}
	// }).catch(err => {
	// 	// handle err
	// 	console.log(err);
	// 	$('#qr-reader-error').text(err);
	// });

	$(document).on('click', 'input.device_control', function() {
		$('#deviceModal').modal('hide');
		var cameraId = $(this).attr('data-id');
		startScan(cameraId);
	});

	$('button', $('#reader__dashboard_section_csr')).trigger('click');
});

function startScan(cameraId) {
	const html5QrCode = new Html5Qrcode("reader", true);	
    html5QrCode.start(
        cameraId, 
        {
            fps: 10,    // Optional frame per seconds for qr code scanning
            qrbox: 250  // Optional if you want bounded box UI
        },
        qrCodeMessage => {
			alert('matched');
            // do something when code is read            
			location.href = qrCodeMessage;
			$('#qr-reader-results').text(qrCodeMessage);
        },
        errorMessage => {
            // parse error, ignore it.
            $('#qr-reader-error').text(errorMessage);
		}
	).catch(
		err => {
        	$('#qr-reader-error').text(err);
        }
    );
}
</script>
</body>
</html>
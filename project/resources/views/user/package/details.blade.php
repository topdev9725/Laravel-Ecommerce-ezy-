@extends('layouts.front')
@section('content')

<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
                <div class="col-lg-8">
<div class="user-profile-details">
                        
<div class="account-info">
                            <div class="header-area">
                                <h4 class="title">
                                    {{ $langg->lang409 }} <a class="mybtn1" href="{{route('user-package')}}"> <i class="fas fa-arrow-left"></i> {{ $langg->lang410 }}</a>
                                </h4>
                            </div>
                            <div class="pack-details">
                                <div class="row">

                                    <div class="col-lg-4">
                                        <h5 class="title">
                                            {{ $langg->lang411 }}
                                        </h5>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="value">
                                            {{$subs->title}}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h5 class="title">
                                            {{ $langg->lang412 }}
                                        </h5>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="value">
                                            {{$subs->price}}{{$subs->currency}}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h5 class="title">
                                            {{ $langg->lang413 }}
                                        </h5>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="value">
                                            {{$subs->days}} {{ $langg->lang403 }}
                                    </p></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h5 class="title">
                                            {{ $langg->lang414 }}
                                        </h5>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="value">
                                            {{ $subs->allowed_products == 0 ? 'Unlimited':  $subs->allowed_products}}
                                        </p>
                                    </div>
                                </div>

                                        @if(!empty($package))
                                            @if($package->subscription_id != $subs->id)
                                <div class="row">
                                    <div class="col-lg-4">
                                    </div>
                                    <div class="col-lg-8">
                                        <span class="notic"><b>{{ $langg->lang415 }}</b> {{ $langg->lang416 }}</span>
                                    </div>
                                </div>

                                <br>
                                            @else
                                <br>

                                            @endif
                                        @else
                                <br>
                                        @endif

                                        <form id="subscribe-form" class="pay-form" action="{{route('user-vendor-request-submit')}}" method="POST">

                            @include('includes.form-success')
                            @include('includes.form-error')
                            @include('includes.admin.form-error') 
                                            
                                            {{ csrf_field() }}


                                        @if($user->is_vendor == 0)

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    {{ $langg->lang238 }} *
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text"  id="shop-name" class="option" name="shop_name" placeholder="{{ $langg->lang238 }}" required>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    {{ $langg->lang239 }} *
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text" class="option" name="owner_name" placeholder="{{ $langg->lang239 }}" required>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    {{ $langg->lang240 }} *
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text" class="option" name="shop_number" placeholder="{{ $langg->lang240 }}" required>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    {{ $langg->lang241 }} *
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text" class="option" id="autocomplete1" name="shop_address" placeholder="{{ $langg->lang241 }}" required>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    {{ $langg->lang242 }} <small>{{ $langg->lang417 }}</small>
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text" class="option" name="reg_number" placeholder="{{ $langg->lang242 }}">
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    {{ $langg->lang243 }} <small>{{ $langg->lang417 }}</small>
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                <textarea class="option" name="shop_message" placeholder="{{ $langg->lang243 }}" rows="5"></textarea>
                                            </div>
                                        </div>

                                        <br>


                                        @endif
                                        <input type="hidden" name="subs_id" value="{{ $subs->id }}">
                                        <input id="token" name="token" type="hidden" value="">



                                 @if($subs->price != 0)       

                                <div class="row">
                                    <div class="col-lg-4">
                                        <h5 class="title pt-1">
                                            {{ $langg->lang418 }} *
                                        </h5>
                                    </div>
                                    <div class="col-lg-8">

                                            <select name="method" id="option" onchange="meThods(this)" class="option" required="">
                                                <option value="">{{ $langg->lang419 }}</option>
                                                @if($gs->paypal_check == 1)
                                                    <option value="Paypal">{{ $langg->lang420 }}</option>
                                                @endif
                                                @if($gs->stripe_check == 1)
                                                    <option value="Stripe">{{ $langg->lang421 }}</option>
                                                @endif
                                                @if($gs->is_instamojo == 1)
                                                    <option value="Instamojo">{{ $langg->lang763 }}</option>
                                                @endif
                                                @if($gs->is_paystack == 1)
                                                    <option value="Paystack">{{ $langg->lang764 }}</option>
                                                @endif
                                                @if($gs->is_molly == 1)
                                                    <option value="Molly">{{ $langg->lang802 }}</option>
                                                @endif
                                                @if($gs->is_paytm == 1)
                                                    <option value="Paytm">{{ $langg->paytm }}</option>
                                                @endif
                                                @if($gs->is_razorpay == 1)
                                                    <option value="Razorpay">{{ $langg->razorpay }}</option>
                                                @endif
                                                @if($gs->is_authorize == 1)
                                                    <option value="Authorize.Net">{{ $langg->lang809 }}</option>
                                                @endif
                                                @if($gs->is_mercado == 1)
                                                    <option value="Mercadopago">{{ $langg->lang810 }}</option>
                                                @endif
                                                @if($gs->is_flutter == 1)
                                                <option value="Flutter">{{ $langg->lang811 }}</option>
                                                @endif
                                                @if($gs->is_twocheckout == 1)
                                                <option value="Twocheckout">{{ $langg->lang812 }}</option>
                                                @endif
                                                @if($gs->is_ssl == 1)
                                                <option value="ssl">{{ $langg->lang813 }}</option>
                                                @endif
                                                @if($gs->is_voguepay == 1)
                                                <option value="voguepay">{{ $langg->lang814 }}</option>
                                                @endif
                                            </select>

                                    </div>
                                </div>


                                            <div id="stripes" style="display: none;">

                                    <br>



                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    {{ $langg->lang422 }} *
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text" class="option" name="card" id="scard" placeholder="{{ $langg->lang422 }}">
                                            </div>
                                        </div>

                                    <br>


                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    {{ $langg->lang423 }} *
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text" class="option" name="cvv" id="scvv" placeholder="{{ $langg->lang423 }}">
                                            </div>
                                        </div>

                                    <br>


                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    {{ $langg->lang424 }} *
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text" class="option" name="month" id="smonth" placeholder="{{ $langg->lang424 }}">
                                            </div>
                                        </div>


                                    <br>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5 class="title pt-1">
                                                    {{ $langg->lang425 }} *
                                                </h5>
                                            </div>
                                            <div class="col-lg-8">
                                                    <input type="text" class="option" name="year" id="syear" placeholder="{{ $langg->lang425 }}">
                                            </div>
                                        </div>

                                            </div>


                                            <div id="twocheckout" style="display: none;">

                                                <br>
            
            
            
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <h5 class="title pt-1">
                                                                {{ $langg->lang422 }} *
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-8">
                                                                <input type="text" class="option" name="tcard" id="scard2" placeholder="{{ $langg->lang422 }}">
                                                        </div>
                                                    </div>
            
                                                <br>
            
            
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <h5 class="title pt-1">
                                                                {{ $langg->lang423 }} *
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-8">
                                                                <input type="text" class="option" name="tcvv" id="scvv2" placeholder="{{ $langg->lang423 }}">
                                                        </div>
                                                    </div>
            
                                                <br>
            
            
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <h5 class="title pt-1">
                                                                {{ $langg->lang424 }} *
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-8">
                                                                <input type="text" class="option" name="tmonth" id="smonth2" placeholder="{{ $langg->lang424 }}">
                                                        </div>
                                                    </div>
            
            
                                                <br>
            
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <h5 class="title pt-1">
                                                                {{ $langg->lang425 }} *
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-8">
                                                                <input type="text" class="option" name="tyear" id="syear2" placeholder="{{ $langg->lang425 }}">
                                                        </div>
                                                    </div>
            
                                                        </div>




                                            <div id="authorize" style="display: none;">

                                                <br>
            
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <h5 class="title pt-1">
                                                                {{ $langg->lang163 }} *
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-8">
                                                                <input type="text" class="option" name="cardNumber" id="scard1" placeholder="{{ $langg->lang163 }}">
                                                        </div>
                                                    </div>
            
                                                <br>
            
            
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <h5 class="title pt-1">
                                                                {{ $langg->lang807 }} *
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-8">
                                                                <input type="text" class="option" name="cardCode" id="scvv1" placeholder="{{ $langg->lang807 }}">
                                                        </div>
                                                    </div>
            
                                                <br>
            
            
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <h5 class="title pt-1">
                                                                {{ $langg->lang165 }} *
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-8">
                                                                <input type="text" class="option" name="amonth" id="smonth1" placeholder="{{ $langg->lang165 }}">
                                                        </div>
                                                    </div>
            
            
                                                <br>
            
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <h5 class="title pt-1">
                                                                {{ $langg->lang808 }} *
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-8">
                                                                <input type="text" class="option" name="ayear" id="syear1" placeholder="{{ $langg->lang808 }}">
                                                        </div>
                                                    </div>
            
                                            </div>



                                            <div id="paypals">
                                                <input type="hidden" name="cmd" value="_xclick">
                                                <input type="hidden" name="no_note" value="1">
                                                <input type="hidden" name="lc" value="UK">
                                                <input type="hidden" name="currency_code" value="{{strtoupper($subs->currency_code)}}">
                                                <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest">
                                                <input type="hidden" name="ref_id" id="ref_id" value="">
                                                <input type="hidden" name="sub" id="sub" value="0">
                                                <input type="hidden" name="ck" id="ck" value="0">
                                            </div>

                                @endif
                                <div class="row">
                                    <div class="col-lg-4">
                                        <input type="hidden" id="latitude1" name="shop_latitude" value=""/>
                                        <input type="hidden" id="longitude1" name="shop_longitude" value=""/>
                                    </div>
                                    <div class="col-lg-8">
                                            <button type="submit" id="final-btn" class="mybtn1">{{ $langg->lang426 }}</button>
                                    </div>
                                </div>




                                 </form>



                            </div>
                        </div>
                    </div>
                </div>
      </div>
    </div>
  </section>

@endsection



@section('scripts')

<script src="https://js.paystack.co/v1/inline.js"></script>

<script src="//voguepay.com/js/voguepay.js"></script>

<script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>

<script>
    // Called when token created successfully.
    var successCallback = function(data) {
        var myForm = document.getElementById('twock-form');

        // Set the token as the value for the token input
        myForm.token.value = data.response.token.token;

        // IMPORTANT: Here we call `submit()` on the form element directly instead of using jQuery to prevent and infinite token request loop.
        myForm.submit();
    };

    // Called when token creation fails.
    var errorCallback = function(data) {
        if (data.errorCode === 200) {tokenRequest();} else {alert(data.errorMsg);}
    };

    var tokenRequest = function() {
        // Setup token request arguments
        var args = {
            sellerId: "{{ $gs->twocheckout_seller_id }}",
            publishableKey: "{{ $gs->twocheckout_public_key }}",
            ccNo: $("#scard2").val(),
            cvv: $("#scvv2").val(),
            expMonth: $("#smonth2").val(),
            expYear: $("#syear2").val()
        };

        // Make the token request
        TCO.requestToken(successCallback, errorCallback, args);
    };

    $(function() {
        // Pull in the public encryption key for our environment
        @if($gs->twocheckout_sandbox_check == 1)
        TCO.loadPubKey('sandbox');
        @else 
        TCO.loadPubKey('production');
        @endif

        $(document).on('submit',"#twock-form",function(e) {
            // Call our token request function
            tokenRequest();
            // Prevent form from submitting
            return false;
        });
    });

</script>

<script type="text/javascript">
    
        $(document).on('submit','#paystack-form',function(e){
            var val = $('#sub').val();
                if(val == 0)
                {            
                    $.get("{{ route('user.paystack.check').'?shop_name=' }}"+$('#shop-name').val(), function(data, status){


                          if ((data.errors)) {

                          $('.alert-danger').show();
                          $('.alert-danger ul').html('');
                            for(var error in data.errors)
                            {
                              $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>');
                              $('#sub').val('0');
                              $('#ck').val('1');
                            }

                          }
                          else {
                            $('#ck').val('0');
                          }

                    });

                    setTimeout(function(){ 

                        if($('#ck').val() == '0') {

                            $('#preloader').hide();

                            var total = {{$subs->price}};

                                var handler = PaystackPop.setup({
                                  key: '{{$gs->paystack_key}}',
                                  email: '{{$user->email}}',
                                  amount: total * 100,
                                  currency: "{{strtoupper($subs->currency_code)}}",
                                  ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                                  callback: function(response){
                                    $('#ref_id').val(response.reference);
                                    $('#sub').val('1');
                                    $('#final-btn').click();
                                  },
                                  onClose: function(){
                                  }
                                });
                                handler.openIframe();
                                    return false;    

                            }
                    }, 1000);
  
                         return false;
                        }
                        else {
                            $('#preloader').show();
                            return true;   
                        }
        });

        $(document).on('submit','#voguepay-form',function(e){
            var val = $('#sub').val();
                if(val == 0)
                {            
                    $.get("{{ route('user.voguepay.check').'?shop_name=' }}"+$('#shop-name').val(), function(data, status){


                          if ((data.errors)) {

                            $('.alert-danger').show();
                            $('.alert-danger ul').html('');
                            for(var error in data.errors)
                            {
                              $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>');
                              $('#sub').val('0');
                              $('#ck').val('1');
                            }

                          }
                          else {
                            $('#ck').val('0');
                          }

                    });

                    setTimeout(function(){ 

                        if($('#ck').val() == '0') {

                            $('#preloader').hide();

                            var total = '{{$subs->price}}';


                                Voguepay.init({
                                    v_merchant_id: '{{ $gs->vougepay_merchant_id }}',
                                    total: total,
                                    cur: '{{strtoupper($subs->currency_code)}}',
                                    merchant_ref: 'ref'+Math.floor((Math.random() * 1000000000) + 1),
                                    memo:'{{ $subs->title }} Plan',
                                    developer_code: '{{ $gs->vougepay_developer_code }}',
                                    store_id:'{{ Auth::user() ? Auth::user()->id : 0 }}',
                                    closed:function(){
                                        var newval = $('#sub').val();
                                        if(newval == 1){
                                            $('#final-btn').click();
                                        }
                                    },
                                    success:function(transaction_id){
                                        $('#ref_id').val(transaction_id);
                                        $('#sub').val('1');
                                    },
                                    failed:function(){
                                        alert('Payment Failed');
                                    }
                                });

                            return false;    

                        }
                    }, 1000);
  
                    return false;
                }
                else {
                    $('#preloader').show();
                    return true;   
                }
        });


</script>


@if($subs->price != 0)
<script type="text/javascript">
        function meThods(val) {

            var action1  = "{{route('user.paypal.submit')}}";
            var action2  = "{{route('user.stripe.submit')}}";
            var action3  = "{{route('user.instamojo.submit')}}";
            var action4  = "{{route('user.paystack.submit')}}";
            var action5  = "{{route('user.molly.submit')}}";
            var action6  = "{{route('user.paytm.submit')}}";
            var action7  = "{{route('user.razorpay.submit')}}";
            var action8  = "{{route('user.authorize.submit')}}";
            var action9  = "{{route('user.mercadopago.submit')}}";
            var action10 = "{{route('user.flutter.submit')}}";
            var action11 = "{{route('user.twocheckout.submit')}}";
            var action12 = "{{route('user.ssl.submit')}}";
            var action13 = "{{route('user.voguepay.submit')}}";

             if (val.value == "Paypal") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action1);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#scard1").prop("required", false);
                $("#scvv1").prop("required", false);
                $("#smonth1").prop("required", false);
                $("#syear1").prop("required", false);
                $("#scard2").prop("required", false);
                $("#scvv2").prop("required", false);
                $("#smonth2").prop("required", false);
                $("#syear2").prop("required", false);
                $("#stripes").hide();
                $("#authorize").hide();
                $("#twocheckout").hide();
            }
            if (val.value == "ssl") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action12);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#scard1").prop("required", false);
                $("#scvv1").prop("required", false);
                $("#smonth1").prop("required", false);
                $("#syear1").prop("required", false);
                $("#scard2").prop("required", false);
                $("#scvv2").prop("required", false);
                $("#smonth2").prop("required", false);
                $("#syear2").prop("required", false);
                $("#stripes").hide();
                $("#authorize").hide();
                $("#twocheckout").hide();


            }



            else if (val.value == "Instamojo") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action3);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#scard1").prop("required", false);
                $("#scvv1").prop("required", false);
                $("#smonth1").prop("required", false);
                $("#syear1").prop("required", false);
                $("#scard2").prop("required", false);
                $("#scvv2").prop("required", false);
                $("#smonth2").prop("required", false);
                $("#syear2").prop("required", false);
                $("#stripes").hide();
                $("#authorize").hide();
                $("#twocheckout").hide();
            }
            else if (val.value == "Molly") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action5);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#scard1").prop("required", false);
                $("#scvv1").prop("required", false);
                $("#smonth1").prop("required", false);
                $("#syear1").prop("required", false);
                $("#scard2").prop("required", false);
                $("#scvv2").prop("required", false);
                $("#smonth2").prop("required", false);
                $("#syear2").prop("required", false);
                $("#stripes").hide();
                $("#authorize").hide();
                $("#twocheckout").hide();
            }
            else if (val.value == "Mercadopago") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action9);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#scard1").prop("required", false);
                $("#scvv1").prop("required", false);
                $("#smonth1").prop("required", false);
                $("#syear1").prop("required", false);
                $("#scard2").prop("required", false);
                $("#scvv2").prop("required", false);
                $("#smonth2").prop("required", false);
                $("#syear2").prop("required", false);
                $("#stripes").hide();
                $("#authorize").hide();
                $("#twocheckout").hide();
            }
            else if (val.value == "Paytm") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action6);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#scard1").prop("required", false);
                $("#scvv1").prop("required", false);
                $("#smonth1").prop("required", false);
                $("#syear1").prop("required", false);
                $("#scard2").prop("required", false);
                $("#scvv2").prop("required", false);
                $("#smonth2").prop("required", false);
                $("#syear2").prop("required", false);
                $("#stripes").hide();
                $("#authorize").hide();
                $("#twocheckout").hide();
            }
            else if (val.value == "Razorpay") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action7);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#scard1").prop("required", false);
                $("#scvv1").prop("required", false);
                $("#smonth1").prop("required", false);
                $("#syear1").prop("required", false);
                $("#scard2").prop("required", false);
                $("#scvv2").prop("required", false);
                $("#smonth2").prop("required", false);
                $("#syear2").prop("required", false);
                $("#stripes").hide();
                $("#authorize").hide();
                $("#twocheckout").hide();
            }
            else if (val.value == "Paystack") {
               $('.pay-form').attr('id','paystack-form');
                $(".pay-form").attr("action", action4);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#scard1").prop("required", false);
                $("#scvv1").prop("required", false);
                $("#smonth1").prop("required", false);
                $("#syear1").prop("required", false);
                $("#scard2").prop("required", false);
                $("#scvv2").prop("required", false);
                $("#smonth2").prop("required", false);
                $("#syear2").prop("required", false);
                $("#stripes").hide();
                $("#authorize").hide();
                $("#twocheckout").hide();
            }
            else if (val.value == "Flutter") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action10);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#scard1").prop("required", false);
                $("#scvv1").prop("required", false);
                $("#smonth1").prop("required", false);
                $("#syear1").prop("required", false);
                $("#scard2").prop("required", false);
                $("#scvv2").prop("required", false);
                $("#smonth2").prop("required", false);
                $("#syear2").prop("required", false);
                $("#stripes").hide();
                $("#authorize").hide();
                $("#twocheckout").hide();
            }


            else if (val.value == "Stripe") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action2);
                $("#scard").prop("required", true);
                $("#scvv").prop("required", true);
                $("#smonth").prop("required", true);
                $("#syear").prop("required", true);
                $("#scard1").prop("required", false);
                $("#scvv1").prop("required", false);
                $("#smonth1").prop("required", false);
                $("#syear1").prop("required", false);
                $("#scard2").prop("required", false);
                $("#scvv2").prop("required", false);
                $("#smonth2").prop("required", false);
                $("#syear2").prop("required", false);
                $("#stripes").show();
                $("#authorize").hide();
                $("#twocheckout").hide();
            }
            else if (val.value == "Authorize.Net") {
               $('.pay-form').attr('id','subscribe-form');
                $(".pay-form").attr("action", action8);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#scard1").prop("required", true);
                $("#scvv1").prop("required", true);
                $("#smonth1").prop("required", true);
                $("#syear1").prop("required", true);
                $("#scard2").prop("required", false);
                $("#scvv2").prop("required", false);
                $("#smonth2").prop("required", false);
                $("#syear2").prop("required", false);
                $("#authorize").show();
                $("#stripes").hide();
                $("#twocheckout").hide();
            }
            else if (val.value == "Twocheckout") {
                $('.pay-form').attr('id','twock-form');
                $(".pay-form").attr("action", action11);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#scard1").prop("required", false);
                $("#scvv1").prop("required", false);
                $("#smonth1").prop("required", false);
                $("#syear1").prop("required", false);
                $("#scard2").prop("required", true);
                $("#scvv2").prop("required", true);
                $("#smonth2").prop("required", true);
                $("#syear2").prop("required", true);
                $("#twocheckout").show();
                $("#stripes").hide();
                $("#authorize").hide();
            }
            else if (val.value == "voguepay") {
               $('.pay-form').attr('id','voguepay-form');
                $(".pay-form").attr("action", action13);
                $("#scard").prop("required", false);
                $("#scvv").prop("required", false);
                $("#smonth").prop("required", false);
                $("#syear").prop("required", false);
                $("#scard1").prop("required", false);
                $("#scvv1").prop("required", false);
                $("#smonth1").prop("required", false);
                $("#syear1").prop("required", false);
                $("#scard2").prop("required", false);
                $("#scvv2").prop("required", false);
                $("#smonth2").prop("required", false);
                $("#syear2").prop("required", false);
                $("#stripes").hide();
                $("#authorize").hide();
                $("#twocheckout").hide();
            }


        }    
</script>
@endif

<script type="text/javascript">
    
$(document).on('submit','#subscribe-form',function(){
    var latitude = $('#latitude1').val();
    var longitude = $('#longitude1').val();			
    if(latitude=='' || longitude=='' || latitude=='0' || longitude=='0') {
        showError("Please enter address correctly to get getlocation.\n You might not be supported Nearby Service.");					
        return false;
    }
    $('#preloader').show();
});
 var autocomplete1;
function initAutocomplete1() {
    // Create the autocomplete object, restricting the search predictions to
    // geographical location types.    
    initGeoLocate1();
    if($('#autocomplete').length==0){
        return;
    }
    autocomplete1 = new google.maps.places.Autocomplete(
        document.getElementById('autocomplete1'), {types: ['geocode']});

    // Avoid paying for data that you don't need by restricting the set of
    // place fields that are returned to just the address components.
    autocomplete1.setFields(['address_component']);

    // When the user selects an address from the drop-down, populate the
    // address fields in the form.
    autocomplete1.addListener('place_changed', fillInAddress1);    
}

function fillInAddress1() {
    getGeoLocate($('#autocomplete1').val());
    // Get the place details from the autocomplete object.
    var place = autocomplete1.getPlace();

    // Get each component of the address from the place details,
    // and then fill-in the corresponding field on the form.  
    var address = '';
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];    
        var val = place.address_components[i][componentForm[addressType]];        
        if(addressType == 'street_number' || addressType == 'route') {
            address += ' ' + val;
        }       
    }
    if(address != '') 
        $('#autocomplete').val(address);
}

function getGeoLocate1(address) {
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode( 
        { 'address': address},
        function(results, status) {		            
		    if (status === "OK") {
			    if (results[0]) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();	
				    $('#latitude1').val(latitude);
                    $('#longitude1').val(longitude);                    
			    } 
		    } else {
                showError("Geocoder failed due to: " + status);
		    }
		}
    );   
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function initGeoLocate1() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
	        var geocoder = new google.maps.Geocoder();	  
	        geocoder.geocode(
		        {
		            location: geolocation
		        },
		        function(results, status) {	
		            if (status === "OK") {
			            if (results[0]) {	
                            $('#autocomplete1').val(results[0].formatted_address);
                            $('#latitude1').val(geolocation.lat);
                            $('#longitude1').val(geolocation.lng);
			            } 
		            } else {
                        showError("Geocoder failed due to: " + status);			            
		            }
		        }
	        );      
        });
    }
}
$(document).ready(function() {
    setTimeout(() => {
        initAutocomplete1();
    }, 200);    
    
    if ($(window).width() < 800){
      $('#ezy-header').css('display', 'none');
      $('#ezy-footer').css('display', 'none');
      $('#user-profile-mobile-header').css('display', 'flex');
    }
})
</script>
@endsection
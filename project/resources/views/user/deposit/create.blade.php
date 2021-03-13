@extends('layouts.front')

@section('styles')
<style type="text/css">
  .total_amount_detail{width: 100%}
  .total_amount_detail tr td{text-align: right; padding: 0.5rem;}

</style>


@endsection

@section('content')


<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
        <div class="col-lg-8">
					<div class="user-profile-details">
						<div class="order-history shadow-no-border">
							<div class="header-area">
								<h4 class="title" >
									{{ $langg->lang821 }}
									<a class="mybtn1" href="{{ url()->previous() }}"> <i class="fas fa-arrow-left"></i> {{ $langg->lang337 }}</a>
								</h4>
							</div>

                    <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                         <form id="subscribe-form" class="pay-form" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">

                                {{ csrf_field() }}

                                @include('includes.form-success')
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="name">{{ $langg->lang355 }} : {{ App\Models\Product::vendorConvertPrice(Auth::user()->balance) }}</label>
                                </div>


                                <div class="form-group">
                                  <div class="row">
                                     <div class="col-lg-12">
                                       <label class="control-label col-sm-12" for="name">{{ $langg->lang418 }} * </label>
                                     </div>
                                     <div class="col-lg-12">
                                      <div class="col-sm-12">
                                        <select class="form-control" name="method" id="option" onchange="meThods(this)" class="option" required="">
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
                                            @if($gs->bank_check == 1)
                                            <option value="bank">{{ $langg->lang910 }}</option>
                                            @endif
                                            @if($gs->surepay_check == 1)
                                            <option value="surepay">{{ $langg->lang915 }}</option>
                                            @endif
                                        </select>
                                      </div>
                                     </div>
                                  </div>
                                </div>
                                <!-- <input id="token" name="token" type="hidden" value=""> -->
                                
                                <div class="form-group">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <label class="control-label col-sm-12" for="name">{{ $langg->lang822 }} *  </label>
                                      <div class="col-sm-12">
                                        <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon2">{{ $curr->sign }}</span>
                                          </div>
                                          <input type="text" id="depositAmount" name="sub_total" class="form-control" placeholder="{{ $langg->lang823 }}" value="{{ old('amount') }}" aria-label="Recipient's username" aria-describedby="basic-addon2" required="">
                                          <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">{{ $curr->name }}</span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div id="surepay" style="display: none;">
                                  <div class="row">
                                      <div class="col-lg-12 form-group">
                                         <label class="control-label col-sm-12" for="name">Bank *  </label>
                                         <div class="col-sm-12">
                                            <select class="form-control" name="bankcode" id="bank_code" class="option" required="">
                                              <option value="10001014">CIMB</option>
                                              <option value="10001039">AFFIN</option>
                                              <option value="10001040">AMBANK</option>
                                              <option value="10001038">BSN</option>
                                              <option value="10001037">Hong Leong</option>
                                              <option value="10001041">Hong Leong 2</option>
                                              <option value="10001035">MAYBANK</option>
                                              <option value="10001034">Public Bank</option>
                                              <option value="10001036">RHB</option>
                                            </select>
                                        </div>
                                      </div>
                                   </div>
                                  <input type="hidden" name="surepay_tax" value="{{$gs->surepay_tax}}"/>
                                  <input type="hidden" name="merchant" id="merchant" value="{{$gs->merchant_id}}" />
                                  <input type="hidden" name="amount" id="amount" value="" />
                                  <input type="hidden" name="refid" id="refid" value="" />
                                  <input type="hidden" name="token" id="ezy_token" value="" />
                                  <input type="hidden" name="customer" id="customer" value="{{ Auth::user()->id }}" />
                                  <input type="hidden" name="currency" id="currency" value="MYR" />
                                  <!-- <input type="hidden" name="bankcode" id="bankcode" value="{{$gs->surepay_bank_code}}" /> -->
                                  <input type="hidden" name="clientip" id="clientip" value="" />
                                  <input type="hidden" name="post_url" id="post_url" value="{{ route('user-deposit-create') }}" />
                                  <input type="hidden" name="failed_return_url" value="{{ route('deposit.surepay.errormsg') }}" />
                                  <input type="hidden" name="return_url" id="return_url" value="" />
                                </div>

                                <div id="banks" style="display:none;">
                                  <input type="hidden" name="bank_tax" value="{{$gs->bank_tax}}"/>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <label class="control-label col-sm-12" for="name">{{ __('Reference ID') }} *  </label>
                                      <div class="col-sm-12">                                        
                                          <input type="text" name="reference_id" class="form-control" placeholder="{{ __('Reference ID') }}" value="" aria-label="Reference ID" aria-describedby="basic-addon2" required="">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row" style="display:none" id="bank_img_upload">
                                    <div class="col-md-12">
                                      <div class="file-upload-area">
                                          <div class="upload-file">
                                              <input type="file" name="photo" class="upload" required>
                                              <!-- <span>{{ $langg->lang263 }}</span> -->
                                          </div>
                                      </div>
                                    </div>
                                </div>


                                <div id="stripes" style="display: none;">
                                    <input type="hidden" name="stripe_tax" value="{{$gs->stripe_tax}}"/>
                                   <div class="row">
                                      <div class="col-lg-12">
                                         <label class="control-label col-sm-12" for="name">{{ $langg->lang422 }} *  </label>
                                         <div class="col-sm-12">
                                         <input type="text" class="form-control" name="card" id="scard" placeholder="{{ $langg->lang422 }}">
                                        </div>
                                      </div>
                                   </div>
                                   <br>
                                   <div class="row">
                                      <div class="col-lg-12">
                                         <label class="control-label col-sm-12" for="name">{{ $langg->lang423 }} *  </label>
                                         <div class="col-sm-12">
                                         <input type="text" class="form-control" name="cvv" id="scvv" placeholder="{{ $langg->lang423 }}">
                                        </div>
                                      </div>
                                   </div>
                                   <br>
                                   <div class="row">
                                      <div class="col-lg-12">
                                         <label class="control-label col-sm-12" for="name">{{ $langg->lang424 }} *  </label>
                                         <div class="col-sm-12">
                                         <input type="text" class="form-control" name="month" id="smonth" placeholder="{{ $langg->lang424 }}">
                                        </div>
                                      </div>
                                   </div>
                                   <br>
                                   <div class="row">
                                      <div class="col-lg-12">
                                         <label class="control-label col-sm-12" for="name">{{ $langg->lang425 }} *  </label>
                                         <div class="col-sm-12">
                                         <input type="text" class="form-control" name="year" id="syear" placeholder="{{ $langg->lang425 }}">
                                        </div>
                                      </div>
                                   </div>
                                </div>

                                <div id="twocheckout" style="display: none;">

                                  <br>

                                  <div class="row">
                                    <div class="col-lg-12">
                                       <label class="control-label col-sm-12" for="name">{{ $langg->lang422 }} *  </label>
                                       <div class="col-sm-12">
                                       <input type="text" class="form-control" name="tcard" id="scard2" placeholder="{{ $langg->lang422 }}">
                                      </div>
                                    </div>
                                 </div>
                                 <br>
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <label class="control-label col-sm-12" for="name">{{ $langg->lang423 }} *  </label>
                                       <div class="col-sm-12">
                                       <input type="text" class="form-control" name="tcvv" id="scvv2" placeholder="{{ $langg->lang423 }}">
                                      </div>
                                    </div>
                                 </div>
                                 <br>
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <label class="control-label col-sm-12" for="name">{{ $langg->lang424 }} *  </label>
                                       <div class="col-sm-12">
                                       <input type="text" class="form-control" name="tmonth" id="smonth2" placeholder="{{ $langg->lang424 }}">
                                      </div>
                                    </div>
                                 </div>
                                 <br>
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <label class="control-label col-sm-12" for="name">{{ $langg->lang425 }} *  </label>
                                       <div class="col-sm-12">
                                       <input type="text" class="form-control" name="tyear" id="syear2" placeholder="{{ $langg->lang425 }}">
                                      </div>
                                    </div>
                                 </div>


                                </div>


                                <div id="authorize" style="display: none;">

                                  <div class="row">
                                     <div class="col-lg-12">
                                        <label class="control-label col-sm-12" for="scard1">{{ $langg->lang163 }} *  </label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" name="cardNumber" id="scard1" placeholder="{{ $langg->lang163 }}">
                                       </div>
                                     </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                     <div class="col-lg-12">
                                        <label class="control-label col-sm-12" for="scvv1">{{ $langg->lang807 }} *  </label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" name="cardCode" id="scvv1" placeholder="{{ $langg->lang807 }}">
                                       </div>
                                     </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                     <div class="col-lg-12">
                                        <label class="control-label col-sm-12" for="smonth1">{{ $langg->lang165 }} *  </label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" name="amonth" id="smonth1" placeholder="{{ $langg->lang165 }}">
                                       </div>
                                     </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                     <div class="col-lg-12">
                                        <label class="control-label col-sm-12" for="syear1">{{ $langg->lang808 }} *  </label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" name="ayear" id="syear1" placeholder="{{ $langg->lang808 }}">
                                       </div>
                                     </div>
                                  </div>

                               </div>

                                <div id="paypals">
                                   <input type="hidden" name="cmd" value="_xclick">
                                   <input type="hidden" name="no_note" value="1">
                                   <input type="hidden" name="lc" value="UK">
                                   <!-- <input type="hidden" name="currency" value=""> -->
                                   <input type="hidden" name="currency_code" value="{{ $curr->name }}">
                                   <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest">
                                   <input type="hidden" name="ref_id" id="ref_id" value="">
                                   <input type="hidden" name="sub" id="sub" value="0">
                                </div>
                                <div class="row" style="margin-top: 30px">
                                    <div class="col-lg-4 text-center">
                                      <b>Ezy Life Enterprise</b>
                                    </div>
                                    <div class="col-lg-4 text-center">
                                      <b>CIMB</b>
                                    </div>
                                    <div class="col-lg-4 text-center">
                                      <b>8009942070</b>
                                    </div>
                                </div>
                      <hr>
                      <table class="total_amount_detail">
                        <tr>
                          <td><b>{{__('Sub Total')}}</b></td>
                          <td width="30%">{{$curr->sign}} <span class="sub_total">0.00</span></td>
                        </tr>
                        <tr>
                          <td><b>{{__('Tax')}}(<span class="tax_rate">0.0</span>%)</b></td>
                          <td width="30%">{{$curr->sign}} <span class="tax_amount">0.00</span></td>
                        </tr>
                        <tr>
                          <td><b>{{__('Total')}}</b></td>
                          <td width="30%">{{$curr->sign}} <span class="total">0.00</span></td>
                        </tr>
                      </table>
                      <div class="add-product-footer">                          
                          <input type="hidden" name="amount"/>                          
                          <button name="addProduct_btn" id="final-btn" type="submit" class="mybtn1">{{ $langg->lang819 }} </button>
                      </div>
                  </form>


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

    var calcAmount = function() {
      var method = $('#option').val(),
          tax_rate = 0,
          sub_total = $('input[name="sub_total"]').val();
      if(method == 'Stripe') tax_rate = Number($('input[name="stripe_tax"]').val());
      if(method == 'bank') tax_rate = Number($('input[name="bank_tax"]').val());
      if(method == 'surepay') tax_rate = Number($('input[name="surepay_tax"]').val());
      if(sub_total == '') sub_total = 0; else sub_total = Number(sub_total);
      var tax_amount = sub_total * tax_rate/100;
      // var total = sub_total + tax_amount;      
      var total = 100 * sub_total/(100-tax_rate);      
      $('span.sub_total').number(sub_total, 2);
      $('span.total').number(total, 2);
      $('span.tax_rate').number(tax_rate, 1);
      $('span.tax_amount').number(tax_amount, 2);
      $('input[name="amount"]').val(Math.round(total));
    }

    $(document).on('keyup', '#depositAmount', function() {
      calcAmount();

      var merchant = $('#surepay>input[name=merchant]').val();
      var amount = $('#surepay>input[name=amount]').val();
      var refid = $('#surepay>input[name=refid]').val();
      var customer = $('#surepay>input[name=customer]').val();
      var apikey = '{{$gs->surepay_api_key}}';
      var currency = $('#surepay>input[name=currency]').val();
      var clientIp = $('#surepay>input[name=clientip]').val();
      var token = merchant + amount + refid + customer + apikey + currency + clientIp;

      $.ajax({
          method: "GET",
          url: "{{route('surepay.md5.token')}}",
          data: {
              token:token
          },
          success:function(data)
          {
              $('#surepay>input[name=token]').val(data['token']);
          },
          error:function(){
              toastr.error("Failed!");
          }
      });	

      $("#return_url").val("{{ route('deposit.surepay.success') }}" + '?amount=' + amount)
    });

    $(document).on('submit','#paystack-form',function(e){
      // e.preventDefault();
        $('#preloader').hide();

        var total = $('input[name="total"]').val();
        if(total > 0)
        { 
          var handler = PaystackPop.setup({
            key: '{{$gs->paystack_key}}',
            email: '{{$gs->paystack_email}}',
            amount: total * 100,
            currency: "{{strtoupper($curr->name)}}",
            ref: ''+Math.floor((Math.random() * 1000000000) + 1),
            callback: function(response){
              $('#ref_id').val(response.reference);
              $(".pay-form").attr('id', 'subscribe-form');
              $('#final-btn').click();
            },
            onClose: function(){
            }
          });
          handler.openIframe();
          return false;
        }
        else {
            $('#preloader').show();
            return true;
        }
    });

    // $(document).on('submit', '.pay-form', function(e){ 
    //   e.preventDefault();
    //   alert(1)
    //   $.ajax({
    //       headers: {
    //         'Access-Control-Allow-Origin': '*',
    //         'Content-Type': 'application/ x-www-form-urlencoded',
    //       },
    //       type: 'POST',
    //       url: "https://pgw.surepay88.com/v1/payout/",
    //       data: $(this).serialize(),
    //       success: function () {
    //         alert(2);
    //       },
    //       error: function() {
    //           toastr.error("Failed!!");
    //       }
    //   });  
    // });

    $(document).on('submit','#voguepay-form',function(e){
      // e.preventDefault();
        $('#preloader').hide();

        var total = $('input[name="total"]').val();
        if(total > 0)
        {

          Voguepay.init({
            v_merchant_id: '{{ $gs->vougepay_merchant_id }}',
            total: total,
            cur: '{{strtoupper($curr->name)}}',
            merchant_ref: 'ref'+Math.floor((Math.random() * 1000000000) + 1),
            memo:'Deposit Via Voguepay',
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
              $(".pay-form").attr('id', 'subscribe-form');
            },
            failed:function(){
              alert('Payment Failed');
            }
          });
          return false;
        }
        else {
            $('#preloader').show();
            return true;
        }

    });

  </script>


{{-- @if($subs->price != 0) --}}
<script type="text/javascript">
  function meThods(val) {
      var action1  = "{{route('deposit.paypal.submit')}}";
      var action2  = "{{route('deposit.stripe.submit')}}";
      var action3  = "{{route('deposit.paystack.submit')}}";
      var action4  = "{{route('deposit.instamojo.submit')}}";
      var action5  = "{{route('deposit.molly.submit')}}";
      var action6  = "{{route('deposit.paytm.submit')}}";
      var action7  = "{{route('deposit.razorpay.submit')}}";
      var action8  = "{{route('deposit.authorize.submit')}}";
      var action9  = "{{route('deposit.mercadopago.submit')}}";
      var action10 = "{{route('deposit.flutter.submit')}}";
      var action11 = "{{route('deposit.twocheckout.submit')}}";
      var action12 = "{{route('deposit.ssl.submit')}}";
      var action13 = "{{route('deposit.voguepay.submit')}}";
      var action14 = "{{route('deposit.bank.submit')}}";
      var action15 = "https://pgw2.surepay88.com/fundtransfer";

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
                $("#banks").hide();
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
                $("#banks").hide();
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
                $("#banks").hide();
                $("#stripes").show();
                $("#authorize").hide();
                $("#twocheckout").hide();
                $("#surepay").hide();
      }

      else if (val.value == "Paystack") {
               $('.pay-form').attr('id','paystack-form');
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
                $("#banks").hide();
                $("#stripes").hide();
                $("#authorize").hide();
                $("#twocheckout").hide();
            }

      else if (val.value == "Instamojo") {
                $('.pay-form').attr('id','subscribe-form');
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
                $("#banks").hide();
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
                $("#banks").hide();
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
                $("#banks").hide();
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
                $("#banks").hide();
                $("#stripes").hide();
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
                $("#banks").hide();
                $("#authorize").show();
                $("#stripes").hide();
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
                $("#banks").hide();
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
                $("#banks").hide();
                $("#stripes").hide();
                $("#authorize").hide();
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
                $("#scard2").prop("required", false);
                $("#scvv2").prop("required", false);
                $("#smonth2").prop("required", false);
                $("#syear2").prop("required", false);
                $("#banks").hide();
                $("#stripes").hide();
                $("#authorize").hide();
                $("#twocheckout").show();
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
                $("#banks").hide();
                $("#stripes").hide();
                $("#authorize").hide();
                $("#twocheckout").hide();
        } 
        else if(val.value=='bank') {
              $('.pay-form').attr('id','bank-form');
              $(".pay-form").attr("action", action14);
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
              $("#banks").show();
              $("#stripes").hide();
              $("#authorize").hide();
              $("#twocheckout").hide();
              $("#surepay").hide();
              $('#bank_img_upload').css('display', 'initial');
        }
        else if(val.value=='surepay') {
              $('.pay-form').attr('id','bank-form');
              $(".pay-form").attr("action", action15);
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
              
              $("#surepay").show();
              $("#banks").show();
              $("#stripes").hide();
              $("#authorize").hide();
              $("#twocheckout").hide();

              $('#surepay>input[name=refid]').val(Math.random().toString(36).substring(2, 15));
              $('#surepay>input[name=clientip]').val("{{ $_SERVER['REMOTE_ADDR'] }}");
        }
        else{
              $("#banks").hide();
              $("#stripes").hide();
              $("#authorize").hide();
              $("#twocheckout").hide();
              $("#surepay").hide();
        }
        calcAmount();

  }

</script>
{{-- @endif --}}

<script type="text/javascript">

  $('#subscribe-form').on('submit',function(){
       $('#preloader').show();
  });
  $(document).ready(function() {
    if ($(window).width() < 800){
      $('#ezy-header').css('display', 'none');
      $('#ezy-footer').css('display', 'none');
      $('#user-profile-mobile-header').css('display', 'flex');
    }
  });
</script>

@endsection

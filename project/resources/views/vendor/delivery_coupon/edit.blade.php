@extends('layouts.vendor')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
@endsection

@section('content')

            <div class="content-area">

              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Edit Delivery Coupon') }} <a class="add-btn" href="{{route('vendor-delivery-coupons')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                      <ul class="links">
                        <li>
                          <a href="{{ route('vendor-dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                          <a href="javascript:;">{{ __('Delivery Settings') }}</a>
                        </li>
                        <li>
                          <a href="{{ route('vendor-delivery_coupon-edit', $delivery_coupon->id) }}">{{ __('Edit Delivery Coupon') }}</a>
                        </li>
                      </ul>
                  </div>
                </div>
              </div>

              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                        @include('includes.vendor.form-both') 
                      <form id="geniusform" action="{{route('vendor-delivery_coupon-update')}}" method="POST">
                        {{csrf_field()}}

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Class Name') }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <select name="deliveryfee_id" class="input-field" required="">
                              @foreach($delivery_fees as $delivery_fee)
                                <option value="{{$delivery_fee->id}}" {{$delivery_fee->id == $delivery_coupon->deliveryfee_id?'selected':''}}>{{ $delivery_fee->class_name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Minimum Amount') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
							<div class="input-group mb-3">
								<input type="number" min="0" id="min_amount" name="min_amount" class="form-control" value="{{$delivery_coupon->min_amount}}">
								<div class="input-group-append">
									<span class="input-group-text">{{$sign->name}}</span>
								</div>
							</div>	
                          </div>
                        </div>

						<div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Maximum Amount') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
							<div class="input-group mb-3">
								<input type="number" min="0" id="max_amount" name="max_amount" class="form-control" value="{{$delivery_coupon->max_amount}}">
								<div class="input-group-append">
									<span class="input-group-text">{{$sign->name}}</span>
								</div>
							</div>	
                          </div>
                        </div>

						<div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Delivery Fee Rate') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
							<div class="input-group mb-3">
								<input type="number" min="0" id="delivery_rate" name="delivery_rate" class="form-control" value="{{$delivery_coupon->delivery_rate}}">
								<div class="input-group-append">
									<span class="input-group-text">%</span>
								</div>
							</div>	
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Description') }}</h4>
								<p class="sub-heading">{{ __('(This field is optional)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            	<textarea class="input-field" name="description" placeholder="{{ __('Enter Description') }}">{{$delivery_coupon->description}}</textarea>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
								<input type="hidden" name="id" value="{{$delivery_coupon->id}}"/>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn btn-submit" type="button">{{ __('Update Coupon') }}</button>
                          </div>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

@endsection

@section('scripts')
<script src="{{asset('assets/front/js/toastr.js')}}"></script>
<script type="text/javascript">
	$('.btn-submit').on('click', function() {		
		var msg = '';
		if($("#class_name").val()=='') {
			msg += 'Please Enter Class Name';
		}
		if($('#min_amount').val()=='') {
			if(msg!='') msg += '<br>';
			msg += 'Please Enter Minimum Amount';
		}
		if($('#max_amount').val()=='' || Number($('#max_amount').val())==0 || Number($('#max_amount').val())<Number($('#min_amount').val())) {
			if(msg!='') msg += '<br>';
			msg += 'Please Enter Maximum Amount Correctly';
		}

		if($('#delivery_rate').val()=='') {
			if(msg!='') msg += '<br>';
			msg += 'Please Enter Delivery Fee Rate';
		}
		
		if(msg != '') {
			toastr.error(msg);
			return false;
		}		
		$('#geniusform').submit();
	});


</script>

@endsection


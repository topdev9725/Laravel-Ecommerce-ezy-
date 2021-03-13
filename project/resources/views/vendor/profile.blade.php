@extends('layouts.vendor')
@section('styles')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<link rel="stylesheet" href="{{asset('assets/vendor/plugins/slim-select/slimselect.min.css')}}">
<style>
	a.ui-corner-all{color: #000 !important;}	
</style>
@endsection
@section('content')

						<div class="content-area">
							<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading">{{ $langg->lang434 }}</h4>
											<ul class="links">
												<li>
													<a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
												</li>
												<li>
													<a href="{{ route('vendor-profile') }}">{{ $langg->lang434 }} </a>
												</li>
											</ul>
									</div>
								</div>
							</div>
							<div class="add-product-content">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area" id="modalEdit">

				                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
											<form id="geniusform" action="{{ route('vendor-profile-update') }}" method="POST" enctype="multipart/form-data">
												{{csrf_field()}}

                      						 @include('includes.vendor.form-both')  

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang457 }}: </h4>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="right-area">
																<h6 class="heading"> {{ $data->shop_name }}
																	@if($data->checkStatus())
																	<a class="badge badge-success verify-link" href="javascript:;">{{ $langg->lang783 }}</a>
																	@else
																	 <span class="verify-link"><a href="{{ route('vendor-verify') }}">{{ $langg->lang784 }}</a></span>
																	@endif
																</h6>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang458 }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="owner_name" placeholder="{{ $langg->lang458 }}" required="" value="{{$data->owner_name}}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang459 }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="shop_number" placeholder="{{ $langg->lang459 }}" required="" value="{{$data->shop_number}}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang460 }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" id="autocomplete" name="shop_address" placeholder="{{ $langg->lang460 }}" required="" value="{{$data->shop_address}}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang906 }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field timepicker" name="opening_hours" placeholder="{{ $langg->lang906 }}" required="" value="{{$data->opening_hours}}" autocomplete="off">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Closing Hours *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field timepicker1" name="closing_hours" placeholder="closing hours" required="" value="{{$data->closing_hours}}" autocomplete="off">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Scan and pay Cashback *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="snpcashback" placeholder="Scan and pay cashback" required="" value="{{$data->snpcashback}}">
													</div>
												</div>

												<div class="row social-links-area m-0 p-0 pb-2 pt-2">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang909 }} *</h4>
														</div>
													</div>
                  									<div class="col-lg-7">
                    									<label class="switch">
                      										<input type="checkbox" name="autodebit" {{$data->autodebit==1?"checked":""}}>
                      										<span class="slider round"></span>
                    									</label>
                  									</div>
                								</div>		
												<div class="none_autodebit_items" {{$data->autodebit==1?"style=display:none;":""}}>
												<div class="row social-links-area m-0 p-0 pb-2 pt-2">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang907 }} *</h4>
														</div>
													</div>
                  									<div class="col-lg-7">
                    									<label class="switch">
                      										<input type="checkbox" name="online" {{$data->online==1?"checked":""}}>
                      										<span class="slider round"></span>
                    									</label>
                  									</div>
                								</div>
												<div class="row social-links-area m-0 p-0 pb-2 pt-2">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang908 }} *</h4>
														</div>
													</div>
                  									<div class="col-lg-7">
                    									<label class="switch">
                      										<input type="checkbox" name="nearby" {{$data->nearby==1?"checked":""}}>
                      										<span class="slider round"></span>
                    									</label>
                  									</div>
                								</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang461 }}</h4>
																<p class="sub-heading">{{ $langg->lang462 }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="reg_number" placeholder="{{ $langg->lang461 }}" value="{{$data->reg_number}}">
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															<h4 class="heading">{{ __('Categories') }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">						  					  		
														<select id="categories" name="categories" multiple>                             
															@foreach($categories as $item)
															@php
															$selected = '';
															if($data->category_id && in_array($item->id, json_decode($data->category_id))){
																$selected = 'selected';
															}
															@endphp
															<option value="{{$item->id}}" {{$selected}}>{{ $item->name }}</option>                                
															@endforeach
														</select>
														<input type="hidden" name="category_id" value="{{!empty($data->category_id)?implode(',', json_decode($data->category_id)):''}}"/>
													</div>
												</div>	
												</div>
												<div class="row" id="autodebit_category" {{$data->autodebit==1?"":"style='display:none'"}} >
													<div class="col-lg-4">
														<div class="left-area">
															<h4 class="heading">{{ __('Categories') }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">						  					  		
														<select id="autodebit_categories" name="autodebit_categories" multiple>                             
															@foreach($autodebit_categories as $item)
															@php
															$selected = '';
															if($data->category_id && in_array($item->id, json_decode($data->category_id))){
																$selected = 'selected';
															}
															@endphp
															<option value="{{$item->id}}" {{$selected}}>{{ $item->name }}</option>                                
															@endforeach
														</select>
														<input type="hidden" name="category_id" value="{{!empty($data->category_id)?implode(',', json_decode($data->category_id)):''}}"/>
													</div>
												</div>			
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang463 }}</h4>
																<p class="sub-heading">{{ __("(This Field is Optional)") }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<textarea class="input-field nic-edit" name="shop_details" placeholder="{{ $langg->lang463 }}">{{$data->shop_details}}</textarea>
													</div>
												</div>

						                        <div class="row">
						                          <div class="col-lg-4">
						                            <div class="left-area">
														<input type="hidden" id="latitude" name="shop_latitude" value="{{$data->shop_latitude}}"/>
														<input type="hidden" id="longitude" name="shop_longitude" value="{{$data->shop_longitude}}"/>
						                            </div>
						                          </div>
						                          <div class="col-lg-7">
													<input type="hidden" id="reload" value="1"/>
						                            <button class="addProductSubmit-btn" type="submit" id="btnSave">{{ $langg->lang464 }}</button>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="{{asset('assets/vendor/plugins/slim-select/slimselect.min.js')}}"></script>
<script type="text/javascript">
	new SlimSelect({
		select: '#categories'
	});	
	new SlimSelect({
		select: '#autodebit_categories'
	});	

	var isInitGeoLocate = false;
	var isFullAddress = true;
	$(document).ready(function() {		
		$(document).on('click', '#btnSave', function(e) {   
			var latitude = $('#latitude').val();
			var longitude = $('#longitude').val();			
			if(latitude=='' || longitude=='' || latitude=='0' || longitude=='0') {
				showError("Please enter address correctly to get getlocation.<br/>You might not be supported Nearby Service.");				
				return false;
			}
			return true;			
		});		
		$('.timepicker').timepicker({
			timeFormat: 'HH:mm',
			interval: 60,
			minTime: '6',
			maxTime: '22:00',			
			startTime: '6:00',
			dynamic: false,
			dropdown: true,
			scrollbar: true
		});
		$('.timepicker1').timepicker({
			timeFormat: 'HH:mm',
			interval: 60,
			minTime: '6',
			maxTime: '22:00',			
			startTime: '6:00',
			dynamic: false,
			dropdown: true,
			scrollbar: true
		});
		$('#categories').on('change', function() {
			var categories = $(this).val();
			if(categories) {
				$('input[name="category_id"]').val(categories.join(','));
			} else {
				$('input[name="category_id"]').val('');
			}
		});
		$('#autodebit_categories').on('change', function() {
			var categories = $(this).val();
			if(categories) {
				$('input[name="category_id"]').val(categories.join(','));
			} else {
				$('input[name="category_id"]').val('');
			}
		});
		$('input[name="autodebit"]').on('change', function() {
			var checked = $(this).is(':checked');
			if(checked) {
				$('.none_autodebit_items').hide();
				$('#autodebit_category').css("display", "flex");
				
			} else {
				$('.none_autodebit_items').show();
				$('#autodebit_category').css("display", "none");
			}
		});
	});
</script>
<script src="{{asset('assets/front/js/geocoder.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{$gs->map_api_key}}&libraries=places&callback=initAutocomplete" async defer></script>
@endsection
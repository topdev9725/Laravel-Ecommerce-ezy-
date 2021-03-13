@extends('layouts.load')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/vendor/plugins/slim-select/slimselect.min.css')}}">
@endsection
@section('content')

						<div class="content-area">
							<div class="add-product-content">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area" id="modalEdit">
                        					@include('includes.admin.form-error') 
											<form id="geniusformdata" action="{{ route('admin-vendor-edit',$data->id) }}" method="POST" enctype="multipart/form-data">
												{{csrf_field()}}

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __("Email") }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="email" class="input-field" name="email" placeholder="{{ __("Email Address") }}" value="{{ $data->email }}" disabled="">
													</div>
												</div>


												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __("Shop Name") }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="shop_name" placeholder="{{ __("Shop Name") }}" required="" value="{{ $data->shop_name }}">
													</div>
												</div>
												<div class="row">
						                          <div class="col-lg-4">
						                            <div class="left-area">
						                                <h4 class="heading">{{ $langg->lang902 }} *</h4>
						                            </div>
						                          </div>
						                          <div class="col-lg-7">
						                            <div class="img-upload full-width-img">
						                                <div id="image-preview" class="img-preview" style="background: url({{ $data->shop_logo ? asset('assets/images/vendorlogo/'.$data->shop_logo):asset('assets/images/noimage.png') }});">
						                                    <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ $langg->lang904 }}</label>
						                                    <input type="file" name="shop_logo" class="img-upload" id="image-upload">
						                                  </div>
						                                  <p class="text">{{ $langg->lang903 }}</p>
						                            </div>

						                          </div>
						                        </div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __("Shop Details") }} </h4>
																<p class="sub-heading">{{ __("(This Field is Optional)") }}</p>
														</div>
													</div>
													<div class="col-lg-7">
													<textarea class="nic-edit" name="shop_details" placeholder="{{ __("Details") }}">{{ $data->shop_details }}</textarea> 
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __("Owner Name") }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="owner_name" placeholder="{{ __("Owner Name") }}" required="" value="{{ $data->owner_name }}">
													</div>
												</div>


												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __("Shop Number") }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="shop_number" placeholder="{{ __("Shop Number") }}" required="" value="{{ $data->shop_number }}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __("Shop Address") }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" id="autocomplete" name="shop_address" placeholder="{{ __("Shop Address") }}" required="" value="{{ $data->shop_address }}">
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

											<div class="none_autodebit_items" style={{$data->autodebit==1?'display:none':''}}>
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
														<input type="hidden" name="category_id" value="{{$data->category_id}}"/>
													</div>
												</div>
											</div>						

												<div class="row" id="autodebit_category" style={{$data->autodebit==1?"":'display:none'}} >
													<div class="col-lg-4">
														<div class="left-area">
															<h4 class="heading">{{ __('Categories') }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">						  					  		
														<select id="autodebit_categories" name="autodebit_categories">                             
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
																<h4 class="heading">{{ __("Registration Number") }} </h4>
																<p class="sub-heading">{{ __("(This Field is Optional)") }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="reg_number" placeholder="Registration Number" value="{{ $data->reg_number }}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __("Message") }} </h4>
																<p class="sub-heading">{{ __("(This Field is Optional)") }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="shop_message" placeholder="{{ __("Message") }}" value="{{ $data->shop_message }}">
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
						                            <button class="addProductSubmit-btn" type="submit" id="btnSave">{{ __("Submit") }}</button>
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
	$(document).ready(function() {	
		$('.ui-timepicker-container').remove();
		setTimeout(() => {
			if($().timepicker) {
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
			}
			new SlimSelect({
				select: '#categories'
			});	

			// new SlimSelect({
			// 	select: '#autodebit_categories'
			// });	
		}, 100);
		$(document).on('change', '#categories', function() {
			var categories = $(this).val();
			if(categories) {
				$('input[name="category_id"]').val(categories.join(','));
			} else {
				$('input[name="category_id"]').val('');
			}
		})
		$(document).on('change', '#autodebit_categories', function() {
			var categories = $(this).val();
			if(categories) {
				$('input[name="category_id"]').val(categories);
			} else {
				$('input[name="category_id"]').val('');
			}
		});
		$(document).on('change', 'input[name="autodebit"]', function() {
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
@endsection
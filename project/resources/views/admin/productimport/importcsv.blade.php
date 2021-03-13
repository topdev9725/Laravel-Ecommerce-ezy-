@extends('layouts.admin')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet"/>

@endsection
@section('content')

						<div class="content-area">
							<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading">{{ __("Import CSV Product") }} <a class="add-btn" href="{{ route('admin-prod-types') }}"><i class="fas fa-arrow-left"></i> {{ __("Back") }}</a></h4>
											<ul class="links">
												<li>
													<a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
												</li>
											<li>
												<a href="javascript:;">{{ __("Import CSV Product") }} </a>
											</li>
											<li>
												<a href="{{ route('admin-import-index') }}">{{ __("All Products") }}</a>
											</li>
												<li>
													<a href="{{ route('admin-import-csv') }}">{{ __("Import CSV Product") }}</a>
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
					                      <form id="geniusform" action="{{route('admin-import-csv-store')}}" method="POST" enctype="multipart/form-data">
					                        {{csrf_field()}}

                        @include('includes.admin.form-both')  



												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __("Category") }}*</h4>
														</div>
													</div>
													<div class="col-lg-7">
															<select id="cat" name="category_id" required="">
																	<option value="">{{ __("Select Category") }}</option>
						                                              @foreach($cats as $cat)
						                                                  <option data-href="{{ route('admin-subcat-load',$cat->id) }}" value="{{ $cat->id }}">{{$cat->name}}</option>
						                                              @endforeach
						                                     </select>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __("Sub Category") }}*</h4>
														</div>
													</div>
													<div class="col-lg-7">
															<select id="subcat" name="subcategory_id" disabled="">
                                                  				<option value="">{{ __("Select Sub Category") }}</option>
															</select>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __("Child Category") }}*</h4>
														</div>
													</div>
													<div class="col-lg-7">
															<select id="childcat" name="childcategory_id" disabled="">
                                                  				<option value="">{{ __("Select Child Category") }}</option>
															</select>
													</div>
												</div>

											  <div class="row">
												  <div class="col-lg-4">
													  <div class="left-area">
														  <h4 class="heading">{{ __("Import File") }} *</h4>
													  </div>
												  </div>
												  <div class="col-lg-7">
													  <span class="file-btn">
														  <input type="file" id="csvfile" name="csvfile" accept=".csv">
													  </span>
												  </div>

											  </div>
												
	
						                        <input type="hidden" name="type" value="Physical">
												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
															
														</div>
													</div>
													<div class="col-lg-7 text-center">
														<button class="addProductSubmit-btn" type="submit">{{ __("Start Import") }}</button>
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

<script src="{{asset('assets/admin/js/product.js')}}"></script>
@endsection
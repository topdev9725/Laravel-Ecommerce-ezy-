@extends('layouts.admin')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet"/>

@endsection
@section('content')

						<div class="content-area">
							<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading">{{ __("Product Bulk Upload") }}</h4>
											<ul class="links">
												<li>
													<a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
												</li>
											<li>
												<a href="javascript:;">{{ __("Products") }} </a>
											</li>
											<li>
												<a href="{{ route('admin-prod-index') }}">{{ __("All Products") }}</a>
											</li>
												<li>
													<a href="{{ route('admin-prod-import') }}">{{ __("Bulk Upload") }}</a>
												</li>
											</ul>
									</div>
								</div>
							</div>
							<div class="add-product-content">
								<div class="row">
									<div class="col-lg-12 p-5">

					                      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
					                      <form id="geniusform" action="{{route('admin-prod-importsubmit')}}" method="POST" enctype="multipart/form-data">
					                        {{csrf_field()}}

                        @include('includes.admin.form-both')  

											  <div class="row">
												  <div class="col-lg-12 text-right">
													  <span style="margin-top:10px;"><a class="btn btn-primary" href="{{asset('assets/product-csv-format.csv')}}">{{ __("Download Sample CSV") }}</a></span>
												  </div>

											  </div>
											  <hr>
											  <div class="row justify-content-center">
												  <div class="col-lg-12 d-flex justify-content-center text-center">
														<div class="csv-icon">
																<i class="fas fa-file-csv"></i>
														</div>
												  </div>
												  <div class="col-lg-12 d-flex justify-content-center text-center">
													  <div class="left-area mr-4">
														  <h4 class="heading">{{ __("Upload a File") }} *</h4>
													  </div>
													  <span class="file-btn">
														  <input type="file" id="csvfile" name="csvfile" accept=".csv">
													  </span>

												  </div>

											  </div>

						                        <input type="hidden" name="type" value="Physical">
												<div class="row">
													<div class="col-lg-12 mt-4 text-center">
														<button class="mybtn1 mr-5" type="submit">{{ __("Start Import") }}</button>
													</div>
												</div>
											</form>
									</div>
								</div>
							</div>
						</div>



@endsection

@section('scripts')

<script src="{{asset('assets/admin/js/product.js')}}"></script>
@endsection
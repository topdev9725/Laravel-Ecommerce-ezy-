@extends('layouts.admin')

@section('content')

<div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Affiliate Market Plan') }}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{ __('General Settings') }}</a>
                      </li>
                      <li>
                        <a href="{{ route('admin-gs-affilate') }}">{{ __('Affiliate Market Plan') }}</a>
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
                        <form action="{{ route('admin-gs-update') }}" id="geniusform" method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}

                        @include('includes.admin.form-both')  

                        <div class="row justify-content-center">
                            <div class="col-lg-3">
                              <div class="left-area">
                                <h4 class="heading">
                                    {{ __('Affilate Service') }}
                                </h4>
                              </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="action-list">
                                    <select class="process select droplinks {{ $gs->is_affilate == 1 ? 'drop-success' : 'drop-danger' }}">
                                      <option data-val="1" value="{{route('admin-gs-isaffilate',1)}}" {{ $gs->is_affilate == 1 ? 'selected' : '' }}>{{ __('Activated') }}</option>
                                      <option data-val="0" value="{{route('admin-gs-isaffilate',0)}}" {{ $gs->is_affilate == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}</option>
                                    </select>
                                  </div>
                            </div>
                          </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Affiliate Maximum Layers') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Write Maximum Layer Count of Affiliate Plan') }}" name="affiliate_max_layers" value="{{ $gs->affiliate_max_layers }}" required="">
                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Affiliate Members') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Write Member Count of Affiliate Plan') }}" name="affiliate_members" value="{{ $gs->affiliate_members }}" required="">
                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">                                
                                @php
                                  $curr = \App\Models\Currency::where('is_default','=',1)->first();
                                @endphp
                                <h4 class="heading">{{ __('Affiliate Minimum Amount') }}({{$curr->sign}}) *</h4>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="input-field" placeholder="{{ __('Write Minimum Monthly Amount to get cashback') }}" name="affiliate_min_amount" value="{{ $gs->affiliate_min_amount }}" required="">
                          </div>
                        </div>

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area"></div>
                          </div>
                          <div class="col-lg-6">
                            <div class="cashback_fees_area">
															<div class="heading-area" style="border:0;"><h4 class="title">{{ __('Charging Fees of Each Category') }}(%)</h4></div>
															<div class="cashback_fees_field">
																<input type="hidden" name="affiliate_plan" value="1"/>
                              @if($categories->count() > 0)
																@foreach($categories as $category)
																<div class="row">
																	<div class="col-lg-6">
																		<div class="left-area text-left"><h4 class="heading">{{$category->name}} *</h4></div>
																	</div>
																	<div class="col-lg-6">
																		<input type="text" class="input-field" placeholder="{{ __('Write cashback fees') }}" name="{{$category->slug}}" value="{{$category->charging_fee }}" required="">
																	</div>
																</div>
																@endforeach
                              @endif
                              @if($autodebit_categories->count() > 0)
                                @foreach($autodebit_categories as $category)
																<div class="row">
																	<div class="col-lg-6">
																		<div class="left-area text-left"><h4 class="heading">{{$category->name}} *</h4></div>
																	</div>
																	<div class="col-lg-6">
																		<input type="text" class="input-field" placeholder="{{ __('Write cashback fees') }}" name="{{$category->slug}}" value="{{$category->charging_fee }}" required="">
																	</div>
																</div>
																@endforeach
                              @endif
															</div>
														</div>
                          </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-3">
                                <div class="left-area">
                                    <h4 class="heading">{{ __('Current Featured Image') }} *</h4>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                        <div class="img-upload">
                                            <div id="image-preview" class="img-preview" style="background: url({{ $gs->affilate_banner ? asset('assets/images/'.$gs->affilate_banner):asset('assets/images/noimage.png') }});">
                                                <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                                                <input type="file" name="affilate_banner" class="img-upload">
                                              </div>
                                        </div>

                            </div>
                        </div>


                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
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
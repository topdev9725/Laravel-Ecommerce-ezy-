@extends('layouts.admin')

@section('content')
            <div class="content-area">
                <div class="mr-breadcrumb">
                    <div class="row">
                      <div class="col-lg-12">
                          <h4 class="heading">{{ __('Edit Role') }} <a class="add-btn" href="{{route('admin-role-index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                          <ul class="links">
                            <li>
                              <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                            </li>
                            <li>
                              <a href="{{ route('admin-role-index') }}">{{ __('Manage Roles') }}</a>
                            </li>
                            <li>
                              <a href="{{ route('admin-role-edit',$data->id) }}">{{ __('Edit Role') }}</a>
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
                      <form id="geniusform" action="{{route('admin-role-update',$data->id)}}" method="POST" enctype="multipart/form-data">
                          {{csrf_field()}}
                          @include('includes.admin.form-both') 

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __("Name") }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="name" placeholder="{{ __('Name') }}" value="{{$data->name}}" required="">
                          </div>
                        </div>


                        <hr>
                        <h5 class="text-center">{{ __('Permissions') }}</h5>
                        <hr>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Orders') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="orders" {{ $data->sectionCheck('orders') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Products') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="products" {{ $data->sectionCheck('products') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>


                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Affiliate Products') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="affilate_products" {{ $data->sectionCheck('affilate_products') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Customers') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="customers" {{ $data->sectionCheck('customers') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Vendors & Vendor Verifications') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="vendors" {{ $data->sectionCheck('vendors') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Vendor Subscription Plans') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="vendor_subscription_plans" {{ $data->sectionCheck('vendor_subscription_plans') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Categories') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="categories" {{ $data->sectionCheck('categories') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Bulk Product Upload') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="bulk_product_upload" {{ $data->sectionCheck('bulk_product_upload') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Product Discussion') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="product_discussion" {{ $data->sectionCheck('product_discussion') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Set Coupons') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="set_coupons" {{ $data->sectionCheck('set_coupons') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Blog') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="blog" {{ $data->sectionCheck('blog') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Messages') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="messages" {{ $data->sectionCheck('messages') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('General Settings') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="general_settings" {{ $data->sectionCheck('general_settings') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Home Page Settings') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="home_page_settings" {{ $data->sectionCheck('home_page_settings') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Menu Page Settings') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="menu_page_settings" {{ $data->sectionCheck('menu_page_settings') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Email Settings') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="emails_settings" {{ $data->sectionCheck('emails_settings') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>


                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Payment Settings') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="payment_settings" {{ $data->sectionCheck('payment_settings') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Social Settings') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="social_settings" {{ $data->sectionCheck('social_settings') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Language Settings') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="language_settings" {{ $data->sectionCheck('language_settings') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('SEO Tools') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="seo_tools" {{ $data->sectionCheck('seo_tools') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Manage Staffs') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="manage_staffs" {{ $data->sectionCheck('manage_staffs') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 d-flex justify-content-between">
                              <label class="control-label">{{ __('Subscribers') }} *</label>
                              <label class="switch">
                                <input type="checkbox" name="section[]" value="subscribers" {{ $data->sectionCheck('subscribers') ? 'checked' : '' }}>
                                <span class="slider round"></span>
                              </label>
                            </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-5">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
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
@extends('layouts.admin')

@push('styles')
<style media="screen">
.special-box {
  box-shadow: 0px 1px 6px 0px rgba(208, 208, 208, 0.61);
}
</style>
@endpush

@section('content')
  <div class="content-area">
    <div class="mr-breadcrumb">
      <div class="row align-items-center">
        <div class="col-lg-12">
            <h4 class="heading d-inline-block">
               {{__('Manage Attribute')}}
              <a
              @if (request()->input('type') == 'category')
              href="{{ route('admin-cat-index') }}"
              @elseif (request()->input('type') == 'subcategory')
              href="{{ route('admin-subcat-index') }}"
              @elseif (request()->input('type') == 'childcategory')
              href="{{ route('admin-childcat-index') }}"
              @endif
              class="add-btn"><i class="fas fa-angle-left"></i> {{__('Back')}}</a>
            </h4>
            <ul class="links d-inline-block">
              <li>
                <a href="{{ route('admin.dashboard') }}">{{__('Dashboard')}} </a>
              </li>
              <li>
                <a href="javascript:;">{{__('Manage Attribute')}}
                </a>
              </li>
              <li><a href="javascript:;">{{__('Edit')}}</a></li>
            </ul>

        </div>
      </div>
    </div>

    <div class="product-area">
      <div class="row">
        <div class="col-lg-12">
          <div class="py-5" id="app">

            <div class="add-product-content">
              <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session()->has('success'))
                      <div class="row">
                        <div class="col-md-12">
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        </div>
                      </div>
                    @endif

                    {{-- show attributes of the category of this subcategory / childcategory starts --}}
                    @if ($type == 'subcategory' || $type == 'childcategory')
                      @php
                        if ($type == 'subcategory') {
                          $category = $data->category;
                        } elseif ($type == 'childcategory') {
                          $category = $data->subcategory->category;
                        }
                      @endphp

                      @if ($category->attributes()->count() > 0)
                        @foreach ($category->attributes as $key => $attribute)
                          <div class="row">
                            <div class="col-lg-3">
                              <div class="left-area">
                                  <h4 class="heading">{{ __($attribute->name) }} *</h4>
                                  <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                              </div>
                            </div>
                            <div class="col-lg-9">
                              @foreach ($attribute->attribute_options as $key => $option)
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" id="customRadioInline{{$option->id}}" name="{{ $attribute->id }}" class="custom-control-input">
                                  <label class="custom-control-label" for="customRadioInline{{$option->id}}">{{ $option->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                          <br>
                        @endforeach
                      @endif
                    @endif
                    {{-- show attributes of the category of this subcategory / childcategory ends --}}


                    {{-- show attributes of the subcategory of this childcategory starts --}}
                    @if ($type == 'childcategory')
                      @if ($data->subcategory->attributes()->count() > 0)
                        @foreach ($data->subcategory->attributes as $key => $attribute)
                          <div class="row">
                            <div class="col-lg-3">
                              <div class="left-area">
                                  <h4 class="heading">{{ __($attribute->name) }} *</h4>
                                  <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                              </div>
                            </div>
                            <div class="col-lg-9">
                              @foreach ($attribute->attribute_options as $key => $option)
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" id="customRadioInline{{$option->id}}" name="{{ $attribute->id }}" class="custom-control-input">
                                  <label class="custom-control-label" for="customRadioInline{{$option->id}}">{{ $option->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                          <br>
                        @endforeach
                      @endif
                    @endif
                    {{-- show attributes of the subcategory of this childcategory ends --}}


                    @foreach ($data->attributes as $key => $attribute)
                      <div class="row">
                        <div class="col-lg-3">
                          <div class="left-area">
                              <h4 class="heading">{{ __($attribute->name) }} *</h4>
                              <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          @foreach ($attribute->attribute_options as $key => $option)
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="customRadioInline{{$option->id}}" name="{{ $attribute->id }}" class="custom-control-input">
                              <label class="custom-control-label" for="customRadioInline{{$option->id}}">{{ $option->name }}</label>
                            </div>
                          @endforeach
                        </div>
                        <div class="col-md-3">
                          <a href="{{route('admin-attr-edit', $attribute->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                          <form class="d-inline-block" action="{{ route('admin-attr-delete', $attribute->id) }}" method="get">
                            <button type="submit" class="btn btn-danger" data-target="#confirm-delete" data-toggle="modal"><i class="fas fa-trash-alt"></i></button>
                          </form>
                        </div>
                      </div>
                      <br>
                    @endforeach


                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           <div class="submit-loader">
              <img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
           </div>
           <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
           </div>
           <div class="modal-body">
           </div>
           <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
           </div>
        </div>
     </div>
  </div>


@endsection

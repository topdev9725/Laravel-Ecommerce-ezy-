@extends('layouts.vendor')

@section('content')

            <div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Vendor Verification') }}</h4>
                      <ul class="links">
                        <li>
                          <a href="{{ route('vendor-dashboard') }}">{{ __('Dashboard') }}</a>
                        </li>
                      <li>
                        <a href="{{ route('vendor-verify') }}">{{ __('Vendor Verification') }}</a>
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

                        @if($data->checkVerification())


<div class="alert alert-success validation" style="">
            <p class="text-left"><div class="text-center"><i class="fas fa-check-circle fa-4x"></i><br><h3>{{ $langg->lang804 }}</h3></div></p> 
      </div>


      @else

                        @include('includes.admin.form-both')

                                <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                                <form id="verifyform"  action="{{route('vendor-verify-submit')}}" method="POST" enctype="multipart/form-data">
                                  {{csrf_field()}}



                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              <h4 class="heading">
                                  {{ __('Description') }} *
                              </h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <textarea class="input-field" name="text" required="" placeholder="{{ __('Enter Details') }}"></textarea> 
                          </div>
                        </div>

                          <div class="row">
                              <div  class="col-lg-4">
                                <div class="left-area">
                                  <h4 class="heading">
                                    {{ __('Attachment') }}*
                                  </h4>
                                  <p class="sub-heading">(Maximum Size is 10 MB)</p>

                                </div>
                              </div>
                              <div  class="col-lg-3">
                                  <div class="attachments" id="attachment-section">
                                    <div class="attachment-area">
                                      <span class="remove attachment-remove"><i class="fas fa-times"></i></span>
                                      <input type="file" name="attachments[]" required>
                                    </div>
                                  </div>
                                <a href="javascript:;" id="attachment-btn" class="add-more mt-4"><i class="fas fa-plus"></i>{{ __('Add More Attachment') }} </a>
                              </div>
                            </div>
                            <input type="hidden" name="warning" value="{{ isset($verify) ? $verify->admin_warning : '0' }}" />
                            <input type="hidden" name="verify_id" value="{{ isset($verify) ? $verify->id : '0' }}" />
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">

                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Submitt') }}</button>
                          </div>
                        </div>
                      </form>

@endif

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>



@endsection

@section('scripts')


<script type="text/javascript">
  

  function isEmpty(el){
      return !$.trim(el.html())
  }

// Color Section

$("#attachment-btn").on('click', function(){

    $("#attachment-section").append(''+
                            '<div class="attachment-area  mt-2">'+
                                '<span class="remove attachment-remove"><i class="fas fa-times"></i></span>'+
                                '<input type="file" name="attachments[]" required>'+
                            '</div>'
                            +'');
});


$(document).on('click','.attachment-remove', function(){

    $(this.parentNode).remove();
    if (isEmpty($('#attachment-section'))) {

    $("#attachment-section").append(''+
                            '<div class="attachment-area  mt-2">'+
                                '<span class="remove attachment-remove"><i class="fas fa-times"></i></span>'+
                                '<input type="file" name="attachments[]" required>'+
                            '</div>'
                            +'');

    }

});

// Color Section Ends

</script>

@endsection

@extends('layouts.front')
@section('content')

<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
                <div class="col-lg-8">
                    <div class="user-profile-details">
                        <div class="account-info shadow-no-border">
                            <div class="header-area">
                                <h4 class="title">{{__('Reset Pin Code')}}</h4>
                            </div>
                            <div class="edit-info-area">
                                
                                <div class="body">
                                        <div class="edit-info-area-form">
                                                <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                                                <form id="userform" action="{{route('user-reset-pincode-submit')}}" method="POST" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    @include('includes.admin.form-both') 
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <input type="text" name="pin_code" class="input-field" autocomplete="off" placeholder="{{ __('Pin Code') }}" value="" required="">
                                                        </div>
                                                    </div>                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <input type="password" name="password"  class="input-field" placeholder="{{ __('Enter Current Password') }}" value="" required="">
                                                        </div>
                                                    </div>
                                                        <div class="form-links">
                                                            <button class="submit-btn" type="submit">{{ $langg->lang276 }}</button>
                                                        </div>
                                                </form>
                                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
      </div>
    </div>
  </section>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
    if ($(window).width() < 800){
      $('#ezy-header').css('display', 'none');
      $('#ezy-footer').css('display', 'none');
      $('#user-profile-mobile-header').css('display', 'flex');
    }
  }); 
</script>
@endsection
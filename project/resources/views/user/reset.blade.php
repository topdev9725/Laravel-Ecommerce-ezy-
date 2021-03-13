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
                                <h4 class="title">
                                    {{ $langg->lang272 }}
                                </h4>
                            </div>
                            <div class="edit-info-area">
                                
                                <div class="body">
                                        <div class="edit-info-area-form">
                                                <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                                                <form id="userform" action="{{route('user-reset-submit')}}" method="POST" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    @include('includes.admin.form-both') 
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                                <input type="password" name="cpass"  class="input-field" placeholder="{{ $langg->lang273 }}" value="" required="">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                                <input type="password" name="newpass"  class="input-field" placeholder="{{ $langg->lang274 }}" value="" required="">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                                <input type="password" name="renewpass"  class="input-field" placeholder="{{ $langg->lang275 }}" value="" required="">
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
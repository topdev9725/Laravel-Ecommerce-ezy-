@extends('layouts.front')
@section('styles')
<style>
    #enameform label{font-weight: bold;}
    #qr_code svg{max-width:100%;}
</style>
@endsection
@section('content')

<section class="user-dashbord">
    <div class="container">
        <div class="row">
            @include('includes.user-dashboard-sidebar')
            <div class="col-lg-8">
                <div class="user-profile-details">
                    <div class="account-info shadow-no-border">
                        <div class="header-area">
                            <h4 class="title">{{__('E-name Card')}}</h4>
                        </div>
                        <div class="edit-info-area">                                
                            <div class="body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="#ename_form" class="nav-link active" data-toggle="tab">E-name Card</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#qr_code" class="nav-link" data-toggle="tab">QR Code</a>
                                    </li>                                
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="ename_form">
                                        <div class="edit-info-area-form p-3">
                                            <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                                            <form id="enameform" action="{{route('user-ename-update')}}" method="POST">
                                                {{ csrf_field() }}
                                                @include('includes.form-success') 
                                                <div class="row">                                                    
                                                    <div class="col-lg-12">
                                                        <label>Name * : </label>
                                                        <input type="text" name="name" class="input-field" autocomplete="off" placeholder="{{ __('Name') }}" value="{{$ename->name}}" required="">
                                                    </div>
                                                </div>                                                    
                                                <div class="row">                                                    
                                                    <div class="col-lg-12">
                                                        <label>Componay Name: </label>
                                                        <input type="text" name="company" class="input-field" autocomplete="off" placeholder="{{ __('Company Name') }}" value="{{$ename->company}}">
                                                    </div>
                                                </div>
                                                <div class="row">                                                    
                                                    <div class="col-lg-12">
                                                        <label>Position: </label>
                                                        <input type="text" name="position" class="input-field" autocomplete="off" placeholder="{{ __('Position') }}" value="{{$ename->position}}">
                                                    </div>
                                                </div> 
                                                <div class="row">                                                    
                                                    <div class="col-lg-12">
                                                        <label>Hp no & WhatsApp api: </label>
                                                        <input type="text" name="hpno_whatsapp" class="input-field" autocomplete="off" placeholder="{{ __('Hp no & WhatsApp api') }}" value="{{$ename->hpno_whatsapp}}">
                                                    </div>
                                                </div> 
                                                <div class="row">                                                    
                                                    <div class="col-lg-12">
                                                        <label>Email: </label>
                                                        <input type="text" name="email" class="input-field" autocomplete="off" placeholder="{{ __('Email') }}" value="{{$ename->email}}">
                                                    </div>
                                                </div> 
                                                <div class="row">                                                    
                                                    <div class="col-lg-12">
                                                        <label>Web Link: </label>
                                                        <input type="text" name="web_link" class="input-field" autocomplete="off" placeholder="{{ __('Web Link') }}" value="{{$ename->web_link}}">
                                                    </div>
                                                </div> 
                                                <div class="row">                                                    
                                                    <div class="col-lg-12">
                                                        <label>Introduction: </label>
                                                        <textarea class="input-field" name="introduction" placeholder="{{ __('Introduction') }}">{{$ename->introduction}}</textarea>
                                                    </div>
                                                </div> 
                                                <div class="row">                                                    
                                                    <div class="col-lg-12">
                                                        <label>Description: </label>
                                                        <textarea class="input-field" name="description" placeholder="{{ __('Description') }}">{{$ename->description}}</textarea>
                                                    </div>
                                                </div> 
                                                <div class="form-links">
                                                    <button class="submit-btn" type="submit">{{ $langg->lang276 }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="qr_code">
                                        <div class="p-3">
                                        @php
                                        $str = 'Name: '.$ename->name.PHP_EOL;
                                        if($ename->company) $str .= 'Company Name: '.$ename->company.PHP_EOL;
                                        if($ename->position) $str .= 'Position: '.$ename->position.PHP_EOL;
                                        if($ename->hpno_whatsapp) $str .= 'Hp no & WhatsApp api: '.$ename->hpno_whatsapp.PHP_EOL;
                                        if($ename->email) $str .= 'Email: '.$ename->email.PHP_EOL;
                                        if($ename->web_link) $str .= 'Web Link: '.$ename->web_link.PHP_EOL;
                                        if($ename->introduction) $str .= 'Introduction: '.$ename->introduction.PHP_EOL;
                                        if($ename->description) $str .= 'Description: '.$ename->description.PHP_EOL;
                                        @endphp                                        
                                        {!! QrCode::size(300)->generate($str) !!}
                                        </div>
                                    </div>                                
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
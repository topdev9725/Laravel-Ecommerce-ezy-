@extends('layouts.vendor')

@section('content')

<div class="content-area">
            <div class="mr-breadcrumb">
              <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ $langg->lang456 }}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{ $langg->lang452 }}</a>
                      </li>
                      <li>
                        <a href="{{ route('vendor-social-index') }}">{{ $langg->lang456 }}</a>
                      </li>
                    </ul>
                </div>
              </div>
            </div>
            <div class="social-links-area">
            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
              <form id="geniusform" class="form-horizontal" action="{{ route('vendor-social-update') }}" method="POST">   
              {{ csrf_field() }}

              @include('includes.admin.form-both')  

                <div class="row">
                  <label class="control-label col-sm-3" for="facebook">{{ $langg->lang526 }} *</label>
                  <div class="col-sm-6">
                    <input class="form-control" name="f_url" id="facebook" placeholder="{{ $langg->lang526 }}" required="" type="text" value="{{$data->f_url}}">
                  </div>
                  <div class="col-sm-3">
                    <label class="switch">
                      <input type="checkbox" name="f_check" value="1" {{$data->f_check==1?"checked":""}}>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>

                <div class="row">
                  <label class="control-label col-sm-3" for="gplus">{{ $langg->lang527 }} *</label>
                  <div class="col-sm-6">
                    <input class="form-control" name="g_url" id="gplus" placeholder="{{ $langg->lang527 }}" required="" type="text" value="{{$data->g_url}}">
                  </div>
                  <div class="col-sm-3">
                    <label class="switch">
                      <input type="checkbox" name="g_check" value="1" {{$data->g_check==1?"checked":""}}>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>

                <div class="row">
                  <label class="control-label col-sm-3" for="twitter">{{ $langg->lang528 }} *</label>
                  <div class="col-sm-6">
                    <input class="form-control" name="t_url" id="twitter" placeholder="{{ $langg->lang528 }}" required="" type="text" value="{{$data->t_url}}">
                  </div>
                  <div class="col-sm-3">
                    <label class="switch">
                      <input type="checkbox" name="t_check" value="1" {{$data->t_check==1?"checked":""}}>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>

                <div class="row">
                  <label class="control-label col-sm-3" for="linkedin">{{ $langg->lang529 }} *</label>
                  <div class="col-sm-6">
                    <input class="form-control" name="l_url" id="linkedin" placeholder="{{ $langg->lang529 }}" required="" type="text" value="{{$data->l_url}}">
                  </div>
                  <div class="col-sm-3">
                    <label class="switch">
                      <input type="checkbox" name="l_check" value="1" {{$data->l_check==1?"checked":""}}>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12 text-center">
                    <button type="submit" class="submit-btn">{{ $langg->lang530 }}</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

@endsection
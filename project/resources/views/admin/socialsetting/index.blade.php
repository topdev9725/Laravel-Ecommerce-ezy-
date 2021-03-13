@extends('layouts.admin')

@section('content')

<div class="content-area">
            <div class="mr-breadcrumb">
              <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Social Links') }}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{ __('Social Settings') }}</a>
                      </li>
                      <li>
                        <a href="{{ route('admin-social-index') }}">{{ __('Social Links') }}</a>
                      </li>
                    </ul>
                </div>
              </div>
            </div>
            <div class="social-links-area">
            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
              <form id="geniusform" class="form-horizontal" action="{{ route('admin-social-update-all') }}" method="POST">   
              {{ csrf_field() }}

              @include('includes.admin.form-both')  

                <div class="row">
                  <label class="control-label col-sm-3" for="facebook">{{ __('Facebook') }} *</label>
                  <div class="col-sm-6">
                    <input class="form-control" name="facebook" id="facebook" placeholder="{{ __('http://facebook.com/') }}" required="" type="text" value="{{$data->facebook}}">
                  </div>
                  <div class="col-sm-3">
                    <label class="switch">
                      <input type="checkbox" name="f_status" value="1" {{$data->f_status==1?"checked":""}}>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>

                <div class="row">
                  <label class="control-label col-sm-3" for="gplus">{{ __('Google Plus') }} *</label>
                  <div class="col-sm-6">
                    <input class="form-control" name="gplus" id="gplus" placeholder="{{ __('http://google.com/') }}" required="" type="text" value="{{$data->gplus}}">
                  </div>
                  <div class="col-sm-3">
                    <label class="switch">
                      <input type="checkbox" name="g_status" value="1" {{$data->g_status==1?"checked":""}}>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>

                <div class="row">
                  <label class="control-label col-sm-3" for="twitter">{{ __('Twitter') }} *</label>
                  <div class="col-sm-6">
                    <input class="form-control" name="twitter" id="twitter" placeholder="{{ __('http://twitter.com/') }}" required="" type="text" value="{{$data->twitter}}">
                  </div>
                  <div class="col-sm-3">
                    <label class="switch">
                      <input type="checkbox" name="t_status" value="1" {{$data->t_status==1?"checked":""}}>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>

                <div class="row">
                  <label class="control-label col-sm-3" for="linkedin">{{ __('Linkedin') }} *</label>
                  <div class="col-sm-6">
                    <input class="form-control" name="linkedin" id="linkedin" placeholder="{{ __('http://linkedin.com/') }}" required="" type="text" value="{{$data->linkedin}}">
                  </div>
                  <div class="col-sm-3">
                    <label class="switch">
                      <input type="checkbox" name="l_status" value="1" {{$data->l_status==1?"checked":""}}>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>


                <div class="row">
                  <label class="control-label col-sm-3" for="dribble">{{ __('Dribble') }} *</label>
                  <div class="col-sm-6">
                    <input class="form-control" name="dribble" id="dribble" placeholder="{{ __('https://dribbble.com/') }}" required="" type="text" value="{{$data->dribble}}">
                  </div>
                  <div class="col-sm-3">
                    <label class="switch">
                      <input type="checkbox" name="d_status" value="1" {{$data->d_status==1?"checked":""}}>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12 text-center">
                    <button type="submit" class="submit-btn">{{ __('Save') }}</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

@endsection
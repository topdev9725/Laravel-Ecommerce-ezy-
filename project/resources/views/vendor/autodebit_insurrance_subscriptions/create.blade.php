@extends('layouts.vendor')
@section('content')

                        <div class="content-area">
                            <div class="mr-breadcrumb">
                                <div class="row">
                                    <div class="col-lg-12">
                                            <h4 class="heading">{{ __('Add New Plan') }} <a class="add-btn" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> {{ $langg->lang480 }}</a></h4>
                                            <ul class="links">
                                                <li>
                                                    <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('vendor-ats-index')}}">{{ __('Autodebit Plan') }} </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">{{ __('Add New Plan') }}</a>
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

                                                    @include('includes.vendor.form-both') 
                                            <form id="geniusform" class="form-horizontal" action="{{route('vendor-ats-store1')}}" method="POST">

                                                    {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="left-area">
                                                            <h4 class="heading">{{ __('Title') }} *</h4>
                                                            <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="input-field" name="title" placeholder="{{ __('Enter Title') }}" required="" value="">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="left-area">
                                                            <h4 class="heading">{{ __('Min') }} *</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">{{$sign->sign}}</span>
                                                            </div>
                                                            <input type="number" min="0" name="min" class="form-control" required="">
                                                            <!-- <div class="input-group-append">
                                                                <span class="input-group-text">{{$sign->name}}</span>
                                                            </div> -->
                                                        </div>	
                                                    </div>
                                                </div>  
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="left-area">
                                                            <h4 class="heading">{{ __('Max') }} *</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">{{$sign->sign}}</span>
                                                            </div>
                                                            <input type="number" min="0" name="max" class="form-control" required="">
                                                            <!-- <div class="input-group-append">
                                                                <span class="input-group-text">{{$sign->name}}</span>
                                                            </div> -->
                                                        </div>	
                                                    </div>
                                                </div>  
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="left-area">
                                                            <h4 class="heading">{{ __('Description') }}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <textarea name="description" class="input-field"></textarea>
                                                    </div>
                                                </div>                                                
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="left-area">
                                                            <input type="hidden" name="id" value="0"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <button class="addProductSubmit-btn" type="submit">{{ __('Create Plan') }}</button>
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

@section('scripts')
<script type="text/javascript">

    

</script>
@endsection
@extends('layouts.vendor')
@section('content')

                        <div class="content-area">
                            <div class="mr-breadcrumb">
                                <div class="row">
                                    <div class="col-lg-12">
                                            <h4 class="heading">{{ __('Add New Subscription') }} <a class="add-btn" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> {{ $langg->lang480 }}</a></h4>
                                            <ul class="links">
                                                <li>
                                                    <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('vendor-ats-index')}}">{{ __('Autodebit Subscriptions') }} </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">{{ __('Add New Subscription') }}</a>
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
                                            <form id="geniusform" class="form-horizontal" action="{{route('vendor-ats-store')}}" method="POST">

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
                                                            <h4 class="heading">{{ __('Method') }} *</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <select class="input-filed" name="method">
                                                            <option value="monthly">Monthly</option>
                                                            <option value="quarter">Quarter</option>
                                                            <option value="half_year">Half Year</option>
                                                            <option value="yearly">Yearly</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="left-area">
                                                            <h4 class="heading">{{ __('Cost') }} *</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">{{$sign->sign}}</span>
                                                            </div>
                                                            <input type="number" min="0" name="cost" class="form-control" required="">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">{{$sign->name}}</span>
                                                            </div>
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
                                                        <button class="addProductSubmit-btn" type="submit">{{ __('Create Subscription') }}</button>
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
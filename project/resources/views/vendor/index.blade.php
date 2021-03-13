@extends('layouts.vendor') 

@section('content')
                    <div class="content-area">

                            @if($user->checkWarning())

                                <div class="alert alert-danger validation text-center">
                                        <h3>{{ $user->displayWarning() }} </h3> <a href="{{ route('vendor-warning',$user->verifies()->where('admin_warning','=','1')->orderBy('id','desc')->first()->id) }}"> {{$langg->lang803}} </a>
                                </div>

                            @endif

                        
                        @include('includes.form-success')
                        <h3>Current Balance: {{App\Classes\Common::formatPrice($user->balance)}}</h3>
                        <div class="row row-cards-one">

                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg1">
                                        <div class="left">
                                            <h5 class="title">{{ $langg->lang465 }} </h5>
                                            <span class="number">{{ count($pending) }}</span>
                                            @if(!$user->autodebit)
                                            <a href="{{route('vendor-order-pending')}}" class="link">{{ $langg->lang471 }}</a>
                                            @else
                                            <a href="{{route('vendor-autodebit-order-pending')}}" class="link">{{ $langg->lang471 }}</a>
                                            @endif
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                                <i class="icofont-dollar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!$user->autodebit)
                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg2">
                                        <div class="left">
                                            <h5 class="title">{{ $langg->lang466 }}</h5>
                                            <span class="number">{{ count($processing) }}</span>
                                            <a href="{{route('vendor-order-index')}}" class="link">{{ $langg->lang471 }}</a>
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                                <i class="icofont-truck-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg3">
                                        <div class="left">
                                            <h5 class="title">{{ $langg->lang467 }}</h5>
                                            <span class="number">{{ count($completed) }}</span>
                                            @if($user->autodebit)
                                            <a href="{{route('vendor-autodebit-order-index')}}" class="link">{{ $langg->lang471 }}</a>
                                            @else
                                            <a href="{{route('vendor-order-index')}}" class="link">{{ $langg->lang471 }}</a>
                                            @endif
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                                <i class="icofont-check-circled"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!$user->autodebit)
                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg4">
                                        <div class="left">
                                            <h5 class="title">{{ $langg->lang468 }}</h5>
                                            <span class="number">{{ count($user->products) }}</span>
                                            <a href="{{route('vendor-prod-index')}}" class="link">{{ $langg->lang471 }}</a>
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                                <i class="icofont-cart-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>  


                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg5">
                                        <div class="left">
                                            <h5 class="title">{{ $langg->lang469 }}</h5>
                                            <span class="number">{{ App\Models\VendorOrder::where('user_id','=',$user->id)->where('status','=','completed')->sum('qty') }}</span>
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                                <i class="icofont-shopify"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg6">
                                        <div class="left">
                                            <h5 class="title">{{ $langg->lang470 }}</h5>
                                            @php
                                                $amount = App\Models\VendorOrder::where('user_id', '=', $user->id)->where('status','=','completed')->sum('price');
                                                $sp_amount = App\Models\ScanAndPay::where('vendor_id', '=', Auth::user()->id)->sum('amount');
                                                $total = $amount + $sp_amount;
                                            @endphp
                                            <span class="number">{{ App\Models\Product::vendorConvertPrice( $total ) }}</span>
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                               <i class="icofont-dollar-true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="mycard bg6">
                                        <div class="left">
                                            <h5 class="title">{{ $langg->lang470 }}</h5>
                                            <span class="number">{{ App\Models\Product::vendorConvertPrice( App\Models\Withdraw::where('user_id','=',$user->id)->where('status','=','completed')->sum('amount') ) }}</span>
                                        </div>
                                        <div class="right d-flex align-self-center">
                                            <div class="icon">
                                               <i class="icofont-dollar-true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="row row-cards-one">

                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="card">
                                        <h5 class="card-header">{{ __('Total Sales in Last 30 Days') }}</h5>
                                        <div class="card-body">

                                            <canvas id="lineChart"></canvas>

                                        </div>
                                    </div>

                                </div>

                            </div>
                    </div>

@endsection
@section('scripts')

<script language="JavaScript">
    displayLineChart();

    function displayLineChart() {
        var data = {
            labels: [
            {!!$days!!}
            ],
            datasets: [{
                label: "Prime and Fibonacci",
                fillColor: "#3dbcff",
                strokeColor: "#0099ff",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [
                {!!$sales!!}
                ]
            }]
        };
        var ctx = document.getElementById("lineChart").getContext("2d");
        var options = {
            responsive: true
        };
        var lineChart = new Chart(ctx).Line(data, options);
    }
    
</script>
@endsection

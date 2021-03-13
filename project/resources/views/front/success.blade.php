@extends('layouts.front')

@section('styles')
<style>
    .order-number h5 {
        font-size: 12px !important;
        margin-top:12px;
    }

    .delivery-cost {
        margin-top: 15px !important;
        margin-bottom: 0px !important;
    }

    .table-responsive {
        overflow-x: hidden !important;
    }
@media only screen and (max-width: 767px) { 
    .ezy-order-btn {
        width: 100% !important;
        font-size: 12px !important;
    }

    p {
        font-size: 12px !important;
    }

    .top-area .content .heading {
        font-size: 22px !important;
    }

    .success-shop-name {
        /* text-align: left !important; */
    }

    .success-shop-name h4 {
        font-size: 16px !important;
    }

    .order-number {
        display: none;
    }

    .tempcart .content-box {
        padding: 50px 15px 50px !important;
    }
    .shipping-address {
        margin-bottom: 16px;
    }
    
    .tempcart {
        padding: 40px 0px 70px !important;
    }

    .table-responsive {
        overflow-x: auto !important;
    }
}
</style>
@endsection

@section('content')

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="pages">
          <li>
            <a href="{{ route('front.index') }}">
              {{ $langg->lang17 }}
            </a>
          </li>
          <li>
            <a href="{{ route('payment.return') }}">
              {{ $langg->lang169 }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Area End -->







<section class="tempcart">

@if(!empty($tempcart))

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Starting of Dashboard data-table area -->
                    <div class="content-box section-padding add-product-1">
                        <div class="top-area">
                                <div class="content">
                                    <h4 class="heading">
                                        {{ $langg->order_title }}
                                    </h4>
                                    <p class="text">
                                        {{ $langg->order_text }}
                                    </p>
                                    <a href="{{ route('front.index') }}" class="link">{{ $langg->lang170 }}</a>
                                  </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">

                                    <div class="product__header">
                                        <div class="row reorder-xs">
                                            <!-- <div class="col-lg-12">
                                                <div class="product-header-title">
                                                    <h2>{{ $langg->lang285 }} {{$order->order_number}}</h2>
                                        </div>   
                                    </div> -->
                                        @include('includes.form-success')
                                            <div class="col-md-12" id="tempview">
                                                <div class="dashboard-content">
                                                    <div class="view-order-page" id="print">
                                                        <p class="order-date">{{ $langg->lang301 }} {{date('d-M-Y',strtotime($order->created_at))}}</p>


@if($order->dp == 1)

                                                        <div class="billing-add-area">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h5>{{ $langg->lang302 }}</h5>
                                                                    <div>
                                                                        <p class="mb-0">{{ $langg->lang288 }} {{$order->shipping_name}}</p>
                                                                        <!--{{ $langg->lang289 }} {{$order->shipping_email}}<br>-->
                                                                        <p class="mb-0">{{ $langg->lang290 }} {{$order->shipping_phone}}</p>
                                                                        <p class="mb-0">{{ $langg->lang291 }} {{$order->shipping_address}}</p>
                                                                        <p class="mb-0">City: {{$order->shipping_city}}-{{$order->shipping_zip}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5>{{ $langg->lang292 }}</h5>
                                                                    <p>{{ $langg->lang293 }} {{$final_price}}</p>
                                                                    <p>{{ $langg->lang294 }} {{$order->method}}</p>
                                                                </div>
                                                            </div>
                                                        </div>

@else

                                                        <div class="billing-add-area">
                                                            <div class="row">
                                                                <div class="col-md-6 shipping-address">
                                                                    <h5>{{ $langg->lang302 }}</h5>
                                                                    <div>
                                                                        <p class="mb-0"><img src="{{ asset('assets/front/images/user-success.png') }}" alt=""> {{$order->shipping_name}}</p>
                                                                        <!--{{ $langg->lang289 }} {{$order->shipping_email}}<br>-->
                                                                        <p class="mb-0"><img src="{{ asset('assets/front/images/phone.png') }}" alt=""> {{$order->shipping_phone}}</p>
                                                                        <p class="mb-0"><img src="{{ asset('assets/front/images/address.png') }}" alt=""> {{$order->shipping_address}}</p>
                                                                        <p class="mb-0"><img src="{{ asset('assets/front/images/city.png') }}" alt=""> {{$order->shipping_city}}-{{$order->shipping_zip}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5>{{ $langg->lang292 }}</h5>
                                                                    <p class="mb-0">{{ $langg->lang293 }} {{$final_price}}</p>
                                                                    <p class="mb-0">{{ $langg->lang294 }} {{$order->method}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
@endif
                                                        <br>
                                                        <div class="table-responsive">
@foreach($final_results as $vendor_id => $products) 
                            <div class="row">
                                <div class="col-lg-12 text-center success-shop-name">
                                    <h4>{{ App\Models\User::where('id', '=', $vendor_id)->first()->shop_name }}</h4>
                                </div>
                                <div class="order-number" style="position:absolute;right:15px">
                                    <h5>Order Number: {{ $order_infos[$vendor_id]['order_number'] }}</h5>
                                </div>
                            </div>
                            <table  class="table" style="margin-bottom: 16px !important">
                                <!-- <h4 class="text-center">{{ $langg->lang308 }}</h4> -->
                                <thead>
                                <tr>

                                    <th width="40%">{{ $langg->lang310 }}</th>
                                    <th width="20%">{{ $langg->lang539 }}</th>
                                    <th width="20%">{{ $langg->lang314 }}</th>
                                    <th width="20%">{{ $langg->lang315 }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                        @foreach($products as $product)
                                            <tr>

                                                    <td>{{ $product['item']['name'] }}</td>
                                                    <td>
                                                        {{ $langg->lang311 }}: {{$product['qty']}} <br>
                                                        @if(!empty($product['size']))
                                                        {{ $langg->lang312 }}: {{ $product['item']['measure'] }}{{str_replace('-',' ',$product['size'])}} <br>
                                                        @endif
                                                        @if(!empty($product['color']))
                                                        <div class="d-flex mt-2">
                                                        {{ $langg->lang313 }}:  <span id="color-bar" style="border: 10px solid #{{$product['color'] == "" ? "white" : $product['color']}};"></span>
                                                        </div>
                                                        @endif

                                                            @if(!empty($product['keys']))

                                                            @foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values']))  as $key => $value)

                                                                <b>{{ ucwords(str_replace('_', ' ', $key))  }} : </b> {{ $value }} <br>
                                                            @endforeach

                                                            @endif

                                                        </td>
                                                    <td>{{App\Classes\Common::formatPrice($product['item']['price'])}}</td>
                                                    <td>{{App\Classes\Common::formatPrice($product['price'])}}</td>

                                            </tr>
                                        @endforeach 

                                </tbody>
                            </table>
@endforeach

                                                        </div>
                                                        <div class="text-right" style="margin-bottom: 25px !important">
                                                            <p class="delivery-cost">Delivery Cost: {{ App\Classes\Common::formatPrice($total_delivery_fee) }}</p>
                                                            <p>Total Cost: {{ $final_price }}</p>
                                                        </div>

                                                        <div class="text-right">
                                                            <a href="{{ route('front.index') }}" class="btn btn-primary ezy-order-btn">Home</a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
                <!-- Ending of Dashboard data-table area -->
            </div>

@endif

  </section>

@endsection
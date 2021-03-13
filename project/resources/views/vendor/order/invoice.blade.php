@extends('layouts.vendor')

@section('content')
<div class="content-area">
                    <div class="mr-breadcrumb">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="heading">{{ $langg->lang586 }} <a class="add-btn" href="{{ route('vendor-order-show',$order->order_number) }}"><i class="fas fa-arrow-left"></i> {{ $langg->lang550 }}</a></h4>
                                <ul class="links">
                                    <li>
                                        <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">{{ $langg->lang443 }}</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">{{ $langg->lang586 }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
    <div class="order-table-wrap">
        <div class="invoice-wrap">
            <div class="invoice__title">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="invoice__logo text-left">
                           <img src="{{ asset('assets/images/'.$gs->invoice_logo) }}" alt="woo commerce logo">
                        </div>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a class="btn  add-newProduct-btn print" href="{{route('vendor-order-print',$order->order_number)}}"
                        target="_blank"><i class="fa fa-print"></i> {{ $langg->lang607 }}</a>
                    </div>
                </div>
            </div>
            <br>
            <div class="row invoice__metaInfo mb-4">
                <div class="col-lg-6">
                    <div class="invoice__orderDetails">
                        
                        <p><strong>{{ $langg->lang601 }} </strong></p>
                        <span><strong>{{ $langg->lang588 }} :</strong> {{ sprintf("%'.08d", $order->id) }}</span><br>
                        <span><strong>{{ $langg->lang589 }} :</strong> {{ date('d-M-Y',strtotime($order->created_at)) }}</span><br>
                        <span><strong>{{  $langg->lang590 }} :</strong> {{ $order->order_number }}</span><br>
                        @if($order->dp == 0)
                        <span> <strong>{{ $langg->lang602 }} :</strong>
                            @if($order->shipping == "pickup")
                            {{ $langg->lang603 }}
                            @else
                            {{ $langg->lang604 }}
                            @endif
                        </span><br>
                        @endif
                        <span> <strong>{{ $langg->lang605 }} :</strong> {{$order->method}}</span>
                    </div>
                </div>
            </div>
            <div class="row invoice__metaInfo">
           @if($order->dp == 0)
                <div class="col-lg-6">
                        <div class="invoice__shipping">
                            <p><strong>{{ $langg->lang606 }}</strong></p>
                           <span><strong>{{ $langg->lang557 }}</strong>: {{ $order->shipping_name == null ? $order->customer_name : $order->shipping_name}}</span><br>
                           <span><strong>{{ $langg->lang560 }}</strong>: {{ $order->shipping_address == null ? $order->customer_address : $order->shipping_address }}</span><br>
                           <span><strong>{{ $langg->lang562 }}</strong>: {{ $order->shipping_city == null ? $order->customer_city : $order->shipping_city }}</span><br>
                           <span><strong>{{ $langg->lang561 }}</strong>: {{ $order->shipping_country == null ? $order->customer_country : $order->shipping_country }}</span>

                        </div>
                </div>

            @endif

                <div class="col-lg-6">
                        <div class="buyer">
                            <p><strong>{{ $langg->lang587 }}</strong></p>
                            <span><strong>{{ $langg->lang557 }}</strong>: {{ $order->customer_name}}</span><br>
                            <span><strong>{{ $langg->lang560 }}</strong>: {{ $order->customer_address }}</span><br>
                            <span><strong>{{ $langg->lang562 }}</strong>: {{ $order->customer_city }}</span><br>
                            <span><strong>{{ $langg->lang561 }}</strong>: {{ $order->customer_country }}</span>
                        </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="invoice_table">
                        <div class="mr-table">
                            <div class="table-responsive">
                                <table id="example2" class="table table-hover dt-responsive" cellspacing="0"
                                    width="100%" >
                                    <thead>
                                        <tr>
                                            <th>{{ $langg->lang591 }}</th>
                                            <th>{{ $langg->lang539 }}</th>
                                            <th>{{ $langg->lang600 }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $subtotal = 0;
                                        $data = 0;
                                        $tax = 0;
                                        @endphp
                                        @foreach($cart->items as $product)
                                        
                                @if($product['item']['user_id'] != 0)
                                    @if($product['item']['user_id'] == $user->id)
                                        <tr>
                                            <td width="50%">
                                                @if($product['item']['user_id'] != 0)
                                                @php
                                                $user = App\Models\User::find($product['item']['user_id']);
                                                @endphp
                                                @if(isset($user))
                                                <a target="_blank"
                                                    href="{{ route('front.product', $product['item']['slug']) }}">{{ $product['item']['name']}}</a>
                                                @else
                                                <a href="javascript:;">{{$product['item']['name']}}</a>
                                                @endif

                                                @else
                                                <a href="javascript:;">{{ $product['item']['name']}}</a>

                                                @endif
                                            </td>


                                            <td>
                                                @if($product['size'])
                                               <p>
                                                    <strong>{{ $langg->lang312 }} :</strong> {{str_replace('-',' ',$product['size'])}}
                                               </p>
                                               @endif
                                               @if($product['color'])
                                                <p>
                                                        <strong>{{ $langg->lang313 }} :</strong> <span
                                                        style="width: 40px; height: 20px; display: block; background: #{{$product['color']}};"></span>
                                                </p>
                                                @endif
                                                <p>
                                                        <strong>{{ $langg->lang754 }} :</strong> {{$order->currency_sign}} {{ round($product['item']['price'] * $order->currency_value , 2) }}
                                                </p>
                                               <p>
                                                    <strong>{{ $langg->lang595 }} :</strong> {{$product['qty']}} {{ $product['item']['measure'] }}
                                               </p>
                                                    @if(!empty($product['keys']))

                                                    @foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values']))  as $key => $value)
                                                    <p>

                                                        <b>{{ ucwords(str_replace('_', ' ', $key))  }} : </b> {{ $value }} 

                                                    </p>
                                                    @endforeach

                                                    @endif

                                            </td>

                                      
                                            <td>{{App\Classes\Common::formatPrice($product['price']) }}</td>
                                            @php
                                            $subtotal += round($product['price'] * $order->currency_value, 2);
                                            @endphp

                                        </tr>

                                    @endif
                                @endif
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="2">{{ $langg->lang597 }}</td>
                                            <td>{{App\Classes\Common::formatPrice($subtotal) }}</td>
                                        </tr>
                                        @if(Auth::user()->id == $order->vendor_shipping_id)
                                        @if($order->shipping_cost != 0)
                                            @php 
                                            $price = round(($order->shipping_cost / $order->currency_value),2);
                                            @endphp
                                            @if(DB::table('shippings')->where('price','=',$price)->count() > 0)
                                            <tr>
                                                <td colspan="2">{{ DB::table('shippings')->where('price','=',$price)->first()->title }}({{$order->currency_sign}})</td>
                                                <td>{{ round($order->shipping_cost , 2) }}</td>
                                            </tr>
                                            @endif
                                        @endif
                                        @endif
                                        @if(Auth::user()->id == $order->vendor_packing_id)
                                        @if($order->packing_cost != 0)
                                            @php 
                                            $pprice = round(($order->packing_cost / $order->currency_value),2);
                                            @endphp
                                            @if(DB::table('packages')->where('price','=',$pprice)->count() > 0)
                                            <tr>
                                                <td colspan="2">{{ DB::table('packages')->where('price','=',$pprice)->first()->title }}({{$order->currency_sign}})</td>
                                                <td>{{ round($order->packing_cost , 2) }}</td>
                                            </tr>
                                            @endif
                                        @endif
                                        @endif

                                        @if($order->tax != 0)
                                        <tr>
                                            <td colspan="2">{{ $langg->lang599 }}({{$order->currency_sign}})</td>
                                            @php
                                                $tax = ($subtotal / 100) * $order->tax;
                                                $subtotal =  $subtotal + $tax;
                                            @endphp
                                            <td>{{round($tax, 2)}}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="1"></td>
                                            <td>{{ __('Delivery Fee') }}</td>
                                            <td>{{App\Classes\Common::formatPrice($delivery_fee) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"></td>
                                            <td>{{ $langg->lang600 }}</td>
                                            <td>{{App\Classes\Common::formatPrice($subtotal + $delivery_fee) }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content Area End -->
</div>
</div>
</div>

@endsection
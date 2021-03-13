<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="{{$seo->meta_keys}}">
        <meta name="author" content="GeniusOcean">

        <title>{{$gs->title}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('assets/print/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/print/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('assets/print/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/print/css/style.css')}}">
  <link href="{{asset('assets/print/css/print.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="icon" type="image/png" href="{{asset('assets/images/'.$gs->favicon)}}"> 
  <style type="text/css">
@page { size: auto;  margin: 0mm; }
@page {
  size: A4;
  margin: 0;
}
@media print {
  html, body {
    width: 210mm;
    height: 287mm;
  }

html {

}
::-webkit-scrollbar {
    width: 0px;  /* remove scrollbar space */
    background: transparent;  /* optional: just make scrollbar invisible */
}
  </style>
</head>
<body onload="window.print();">
    <div class="invoice-wrap">
            <div class="invoice__title">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="invoice__logo text-left">
                           <img src="{{ asset('assets/images/'.$gs->invoice_logo) }}" alt="woo commerce logo">
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="invoice__metaInfo">
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

            <div class="invoice__metaInfo" style="margin-top:0px;">
                @if($order->dp == 0)
                <div class="col-lg-6">
                        <div class="invoice__orderDetails" style="margin-top:5px;">
                            <p><strong>{{ $langg->lang606 }}</strong></p>
                           <span><strong>{{ $langg->lang557 }}</strong>: {{ $order->shipping_name == null ? $order->customer_name : $order->shipping_name}}</span><br>
                           <span><strong>{{ $langg->lang560 }}</strong>: {{ $order->shipping_address == null ? $order->customer_address : $order->shipping_address }}</span><br>
                           <span><strong>{{ $langg->lang562 }}</strong>: {{ $order->shipping_city == null ? $order->customer_city : $order->shipping_city }}</span><br>
                           <span><strong>{{ $langg->lang561 }}</strong>: {{ $order->shipping_country == null ? $order->customer_country : $order->shipping_country }}</span>

                        </div>
                </div>
                @endif
                <div class="col-lg-6" style="width:50%;">
                        <div class="invoice__orderDetails" style="margin-top:5px;">
                            <p><strong>{{ $langg->lang587 }}</strong></p>
                            <span><strong>{{ $langg->lang557 }}</strong>: {{ $order->customer_name}}</span><br>
                            <span><strong>{{ $langg->lang560 }}</strong>: {{ $order->customer_address }}</span><br>
                            <span><strong>{{ $langg->lang562 }}</strong>: {{ $order->customer_city }}</span><br>
                            <span><strong>{{ $langg->lang561 }}</strong>: {{ $order->customer_country }}</span>
                        </div>
                </div>
            </div>

                <div class="col-lg-12">
                    <div class="invoice_table">
                        <div class="mr-table">
                            <div class="table-responsive">
                                <table id="example2" class="table table-hover dt-responsive" cellspacing="0"
                                    width="100%">
                                    <thead style="border-top:1px solid rgba(0, 0, 0, 0.1) !important;">
                                        <tr>
                                            <th>{{ $langg->lang591 }}</th>
                                            <th>{{ $langg->lang539 }}</th>
                                            <th>{{ $langg->lang600 }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $subtotal = 0;
                                        $tax = 0;
                                        $data = 0;
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
                                                {{ $product['item']['name']}}
                                                @else
                                                {{$product['item']['name']}}
                                                @endif

                                                @else
                                                {{ $product['item']['name']}}
                                                @endif
                                            </td>

                                            <td>
                                                @if($product['size'])
                                               <p>
                                                    <strong>{{ $langg->lang312 }} :</strong> {{$product['size']}}
                                               </p>
                                               @endif
                                                @if($product['color'])
                                                <p>
                                                        <strong>{{ __('color') }} :</strong> <span style="width: 20px; height: 5px; display: block; border: 10px solid {{$product['color'] == "" ? "white" : '#'.$product['color']}};"></span>
                                                </p>
                                                @endif
                                                <p>
                                                        <strong>{{ $langg->lang754 }} :</strong> {{App\Classes\Common::formatPrice($product['item']['price'])  }}
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

                                            <td>{{$order->currency_sign}}{{ round($product['price'] * $order->currency_value , 2) }}
                                            </td>
                                            @php
                                            $subtotal += round($product['price'] * $order->currency_value, 2);
                                            @endphp

                                        </tr>

                                        @endif
                                    @endif

                                        @endforeach

                                        <tr class="semi-border">
                                            <td colspan="1"></td>
                                            <td><strong>{{ $langg->lang597 }}</strong></td>
                                            <td>{{App\Classes\Common::formatPrice($subtotal)}}</td>

                                        </tr>
                                        @if(Auth::user()->id == $order->vendor_shipping_id)
                                        @if($order->shipping_cost != 0)
                                            @php 
                                            $price = round(($order->shipping_cost / $order->currency_value),2);
                                            @endphp
                                            @if(DB::table('shippings')->where('price','=',$price)->count() > 0)
                                            <tr class="no-border">
                                                <td colspan="1"></td>
                                                <td><strong>{{ DB::table('shippings')->where('price','=',$price)->first()->title }}({{$order->currency_sign}})</strong></td>
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
                                            <tr class="no-border">
                                                <td colspan="1"></td>
                                                <td><strong>{{ DB::table('packages')->where('price','=',$pprice)->first()->title }}({{$order->currency_sign}})</strong></td>
                                                <td>{{ round($order->packing_cost , 2) }}</td>
                                            </tr>
                                            @endif
                                        @endif
                                        @endif

                                        @if($order->tax != 0)
                                        <tr class="no-border">
                                            <td colspan="1"></td>
                                            <td><strong>{{ $langg->lang599 }}({{$order->currency_sign}})</strong></td>

                                            @php
                                                $tax = ($subtotal / 100) * $order->tax;
                                                $subtotal =  $subtotal + $tax;
                                            @endphp

                                            <td>{{round($tax, 2)}}</td>
                                        </tr>

                                        @endif

                                        <tr class="final-border">
                                            <td colspan="1"></td>
                                            <td>{{ $langg->lang600 }}</td>
                                            <td>{{App\Classes\Common::formatPrice($subtotal + $data) }}
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
<!-- ./wrapper -->

<script type="text/javascript">
setTimeout(function () {
        window.close();
      }, 500);
</script>

</body>
</html>

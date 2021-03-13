@extends('layouts.front')
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
            <a href="{{ route('front.cart') }}">
              {{ $langg->lang121 }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Area End -->

<!-- Cart Area Start -->
<section class="cartpage">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="left-area">
          <div class="cart-table">
           @if(Session::has('cart'))
            @foreach(Session::get('final_results') as $vendor_id => $products)
            <h3 style="margin:20px 0px !important;">{{ DB::table('users')->where('id', $vendor_id)->first()->shop_name }}</h3> 
            <table class="table">
              @include('includes.form-success')
                  <thead style="background: #f9a531" class="text-white ezy-cart-table">
                    <tr>
                      <th>{{ $langg->lang122 }}</th>
                      <th width="30%">{{ $langg->lang539 }}</th>
                      <th>{{ $langg->lang125 }}</th>
                      <th>{{ $langg->lang126 }}</th>
                      <th class="text-center"><i class="icofont-close-squared-alt"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $every_shop_price = 0;
                    @endphp
                  @foreach($products as $product)
                    <tr class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}">
                      <td class="product-img">
                        <div class="item">
                          <img src="{{ $product['item']['photo'] ? asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" alt="">
                          <p class="name"><a href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 35 ? mb_substr($product['item']['name'],0,35,'utf-8').'...' : $product['item']['name']}}</a></p>
                        </div>
                      </td>
                                            <td>
                                                @if(!empty($product['size']))
                                                <b>{{ $langg->lang312 }}</b>: {{ $product['item']['measure'] }}{{str_replace('-',' ',$product['size'])}} <br>
                                                @endif
                                                @if(!empty($product['color']))
                                                <div class="d-flex mt-2">
                                                <b>{{ $langg->lang313 }}</b>:  <span id="color-bar" style="border: 10px solid #{{$product['color'] == "" ? "white" : $product['color']}};"></span>
                                                </div>
                                                @endif

                                                    @if(!empty($product['keys']))

                                                    @foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values']))  as $key => $value)

                                                        <b>{{ ucwords(str_replace('_', ' ', $key))  }} : </b> {{ $value }} <br>
                                                    @endforeach

                                                    @endif

                                                  </td>




                      <td class="unit-price quantity">
                        <p class="product-unit-price">
                          {{ App\Models\Product::convertPrice($product['item']['price']) }}                        
                        </p>
          @if($product['item']['type'] == 'Physical')

                          <div class="qty">
                              <ul>
              <input type="hidden" class="prodid" value="{{$product['item']['id']}}">  
              <input type="hidden" class="itemid" value="{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">     
              <input type="hidden" class="size_qty" value="{{$product['size_qty']}}">     
              <input type="hidden" class="size_price" value="{{$product['item']['price']}}">   
                                <li>
                                  <span class="qtminus1 reducing" data-value="{{ $vendor_id }}">
                                    <i class="icofont-minus"></i>
                                  </span>
                                </li>
                                <li>
                                  <span class="qttotal1" id="qty{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{ $product['qty'] }}</span>
                                </li>
                                <li>
                                  <span class="qtplus1 adding" data-value="{{ $vendor_id }}">
                                    <i class="icofont-plus"></i>
                                  </span>
                                </li>
                              </ul>
                          </div>
        @endif


                      </td>

                            @if($product['size_qty'])
                            <input type="hidden" id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="{{$product['size_qty']}}">
                            @elseif($product['item']['type'] != 'Physical') 
                            <input type="hidden" id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="1">
                            @else
                            <input type="hidden" id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="{{$product['stock']}}">
                            @endif

                      <td class="total-price">
                        <p id="prc{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">
                          {{ App\Models\Product::convertPrice($product['price']) }}     
                          @php
                            $every_shop_price += $product['price'];
                          @endphp  
                        </p>
                      </td>
                      <td class="text-center">
                        <span class="removecart cart-remove" data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}" data-value="{{ $vendor_id }}"><i class="icofont-ui-delete"></i> </span>
                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                  <tfoot>
                    <tr class="">
                      <td></td>
                      <td></td>
                      <td style="vertical-align:middle!important">Total: </td>
                      <!-- <td style="vertical-align:middle!important" id="{{ 'shop_'.$vendor_id }}">{{ App\Models\Product::convertPrice(Session::get('every_shop_total_price')[$vendor_id]) }}</td> -->
                      <td style="vertical-align:middle!important" id="{{ 'shop_'.$vendor_id }}">{{ App\Models\Product::convertPrice($every_shop_price) }}</td>
                      <!-- <td class="text-center"><a href="{{ route('front.shop.checkout').'?vendor_id='.$vendor_id }}" class="btn btn-primary ezy-order-btn">{{ $langg->lang7 }}</a></td> -->
                    </tr>
                  </tfoot>
            </table>
            @endforeach
                    @endif
          </div>
        </div>
      </div>
      @if(Session::has('cart'))
      <div class="col-lg-4">
        <div class="right-area">
          <div class="order-box">
            <h4 class="title">{{ $langg->lang127 }}</h4>
            <ul class="order-list">
              <li>
                <p>
                  {{ $langg->lang128 }}
                </p>
                <P>
                  <b class="cart-total">{{ Session::has('cart') ? App\Models\Product::convertPrice($totalPrice) : '0.00' }}</b>
                </P>
              </li>
              <li>
                <p>
                  {{ $langg->lang129 }}
                </p>
                <P>
                  <b class="discount">{{ App\Models\Product::convertPrice(0)}}</b>
                  <input type="hidden" id="d-val" value="{{ App\Models\Product::convertPrice(0)}}">
                </P>
              </li>
              <li>
                <p>
                  {{ $langg->lang130 }}
                </p>
                <P>
                  <b>{{$tx}}%</b>
                </P>
              </li>
            </ul>
            <div class="total-price">
              <p>
                  {{ $langg->lang131 }}
              </p>
              <p>
                  <span class="main-total">{{ Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00' }}</span>
              </p>
            </div>
            <!-- <div class="cupon-box">
              <div id="coupon-link">
                  {{ $langg->lang132 }}
              </div>
              <form id="coupon-form" class="coupon">
                <input type="text" placeholder="{{ $langg->lang133 }}" id="code" required="" autocomplete="off">
                <input type="hidden" class="coupon-total" id="grandtotal" value="{{ Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00' }}">
                <button type="submit">{{ $langg->lang134 }}</button>
              </form>
            </div> -->
            <a href="{{ route('front.checkout') }}" class="order-btn" style="background: #f9a531!important;">
              {{ $langg->lang135 }}
            </a>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</section>
<!-- Cart Area End -->
@endsection 

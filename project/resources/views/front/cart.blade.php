@extends('layouts.front')

@section('styles')

<style type="text/css">
	.root.root--in-iframe {
		background: #4682b447 !important;
  }
  
  .qty li span {
      display: inline-block;
      width: 30px;
      height: 30px;
      border: 1px solid rgba(144, 144, 144, 0.4);
      text-align: center;
      line-height: 30px;
      font-size: 14px;
      cursor: pointer;
      font-weight: 500;
  }

  .qty ul li {
    margin-right: -4px;
    display: inline-block;
  }

  .product-total-price {
    margin-bottom: 0px !important;
    font-weight: 700;
    color: red;
    font-size: 18px;
  }

  .product-unit-price {
    margin-bottom: 0px !important;
    font-size: 16px !important;
  }

  .product-name {
    /* margin-bottom: 10px !important; */
    font-weight: 600 !important;
    font-size: 18px;
  }

  .qty {
    margin:5px 0px;
  }
	@media only screen and (max-width: 767px) {  

    .qty li span {
      display: inline-block;
      width: 30px;
      height: 30px;
      border: 1px solid rgba(144, 144, 144, 0.4);
      text-align: center;
      line-height: 30px;
      font-size: 12px;
      cursor: pointer;
      font-weight: 500;
    }

    td.product-img {
      width: 120px !important;
      padding: 5px !important;
    }

    .cart-table h3 {
      font-size: 18px !important;
    }

    .table {
      width: 99% !important;
    }

    .name {
      margin-bottom: 0px !important;
    }

    .total-price {
      font-size: 16px !important;
    }

    .product-unit-price {
      margin-bottom: 0px !important;
      font-weight: 400 !important;
      font-size: 12px !important;
    }

    .product-total-price {
      margin-bottom: 0px !important;
      font-weight: 700;
      color: red;
      font-size: 16px;
    }

    .product-name {
      margin-bottom: 10px !important;
      font-size: 16px !important;
    }

    .order-btn {
      width: 100% !important;
      font-size: 15px !important;
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
                      <!-- <th>{{ $langg->lang122 }}</th>
                      <th width="30%">{{ $langg->lang539 }}</th>
                      <th>{{ $langg->lang125 }}</th>
                      <th>{{ $langg->lang126 }}</th>
                      <th class="text-center"><i class="icofont-close-squared-alt"></i></th> -->
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $every_shop_price = 0;
                    @endphp
                  @foreach($products as $product)
                    <tr class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}">
                      <td class="product-img">
                        <!-- product image  -->
                        <div class="item">
                          <img src="{{ $product['item']['photo'] ? asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" alt="">
                          <!-- <p class="name text-capitalize">{{mb_strlen($product['item']['name'],'utf-8') > 35 ? mb_substr($product['item']['name'],0,35,'utf-8').'...' : $product['item']['name']}}</p> -->
                        </div>
                      </td>
                                            <td>
                                                  <!-- product name  -->
                                                  <div>
                                                    <p class="name product-name text-capitalize">{{mb_strlen($product['item']['name'],'utf-8') > 35 ? mb_substr($product['item']['name'],0,35,'utf-8').'...' : $product['item']['name']}}</p>
                                                  </div>
                                                  <!-- product detail  -->
                                                  <div>
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
                                                  </div>

                                                  <!-- product unit price  -->
                                                  <div>
                                                    <p class="product-unit-price" style="font-weight: 400!important">
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
                                                  </div>

                                                    @if($product['size_qty'])
                                                      <input type="hidden" id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="{{$product['size_qty']}}">
                                                      @elseif($product['item']['type'] != 'Physical') 
                                                      <input type="hidden" id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="1">
                                                      @else
                                                      <input type="hidden" id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="{{$product['stock']}}">
                                                      @endif

                                                  <!-- product total price  -->
                                                  <div>
                                                    <p class="product-total-price" id="prc{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">
                                                      {{ App\Models\Product::convertPrice($product['price']) }}     
                                                      @php
                                                        $every_shop_price += $product['price'];
                                                      @endphp  
                                                    </p>
                                                  </div>

                                                  <!-- product romove btn  -->
                                                  <div>
                                                    <span class="removecart cart-remove" data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}" data-value="{{ $vendor_id }}"><i class="icofont-ui-delete"></i> </span>
                                                  </div>

                                            </td>
                    </tr>
                    @endforeach
                    <tr>
                      <td class="text-right">Message:</td>
                      <td class="text-left"><input class="form-control message" data-value="{{ $vendor_id }}" style="border: 0px solid #ced4da !important;" type="text" name="shipping_zip" placeholder="Leave a message" value="{{ Session::get('message_'.$vendor_id) }}"></td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td class="text-right total-price">Total: </td>
                      <td class="text-left total-price" id="{{ 'shop_'.$vendor_id }}">{{ App\Models\Product::convertPrice($every_shop_price) }}</td>
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
            <a href="{{ route('front.checkout') }}" class="order-btn" style="background: #f9a531!important;">
              <!-- {{ $langg->lang135 }} -->
                Check Out
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

@section('scripts')
<script>
  // function checkout() {
  //   var total = $('.main-total').text()
  //   total = Number(total.replace(/[^0-9\.]+/g, ""))
  //   if(total < 100) {
  //     toastr.error('You should buy product over RM 100')
  //   } else {
  //     location.href = ("{{ route('front.checkout') }}")
  //   }
  //   // {{ route('front.checkout') }}
  // }

$(document).ready(function(){
  $('.message').on('blur', function() {
    var message = $(this).val();
    var vendor_id = $(this).data('value');
    $.ajax({
      type: "GET",
      url:mainurl+"/savemessage",
      data:{message: message, vendor_id:vendor_id},
      success:function(data){
        console.log(data);
      }
    });
  })
})
</script>
@endsection

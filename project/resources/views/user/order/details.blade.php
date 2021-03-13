@extends('layouts.front')
@section('content')
<!-- User Dashbord Area Start -->
<section class="user-dashbord">
    <div class="container">
        <div class="row">
            @include('includes.user-dashboard-sidebar')
            <div class="col-lg-8">
                <div class="user-profile-details">
                    <div class="order-details shadow-no-border">

                        @if($order->status != 'declined')
                        <div class="process-steps-area">
                            @include('includes.order-process')
                        </div>
                        @endif


                        <div class="header-area">
                            <h4 class="title">
                                {{ $langg->lang284 }}
                            </h4>
                        </div>
                        <div class="view-order-page">
                            <h3 class="order-code">{{ $langg->lang285 }} {{$order->order_number}} [{{$order->status}}]
                            </h3>
                            <div class="print-order text-right">
                                <a href="{{route('user-order-print',$order->id)}}" target="_blank"
                                    class="print-order-btn">
                                    <i class="fa fa-print"></i> {{ $langg->lang286 }}
                                </a>
                            </div>
                            <p class="order-date">{{ $langg->lang301 }} {{date('d-M-Y',strtotime($order->created_at))}}
                            </p>

                            @if($order->dp == 1)

                            <div class="billing-add-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>{{ $langg->lang287 }}</h5>
                                        <address>
                                            {{ $langg->lang288 }} {{ $order->customer_name }}<br>
                                            {{ $langg->lang289 }} {{ $order->customer_email }}<br>
                                            {{ $langg->lang290 }} {{ $order->customer_phone }}<br>
                                            {{ $langg->lang291 }} {{ $order->customer_address }}<br>
                                            {{ $langg->lang829 }} {{ $order->customer_country }}<br>
                                            {{ $langg->lang830 }} {{ $order->customer_state }}<br>
                                            {{$order->customer_city}}-{{$order->customer_zip}}
                                        </address>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>{{ $langg->lang292 }}</h5>

                                        <p>{{ $langg->lang798 }}:
                                             {!! $order->payment_status == 'Pending' ? "<span class='badge badge-danger'>". $langg->lang799 ."</span>":"<span class='badge badge-success'>". $langg->lang800 ."</span>" !!}
                                        </p>

                                        <p>{{ $langg->lang293 }}
                                            {{App\Classes\Common::formatPrice($order->pay_amount + $order->wallet_price) }}
                                        </p>
                                        <p>{{ $langg->lang294 }} {{$order->method}}</p>

                                        @if($order->method != "Cash On Delivery")
                                        @if($order->method=="Stripe")
                                        {{$order->method}} {{ $langg->lang295 }} <p>{{$order->charge_id}}</p>
                                        @endif
                                        {{$order->method}} {{ $langg->lang296 }} <p id="ttn">{{$order->txnid}}</p>
                                        <a id="tid" style="cursor: pointer;" class="mybtn2">{{ $langg->lang297 }}</a> 

                                        <form id="tform">
                                            <input style="display: none; width: 100%;" type="text" id="tin" placeholder="{{ $langg->lang299 }}" required="" class="mb-3">
                                            <input type="hidden" id="oid" value="{{$order->id}}">

                                            <button style="display: none; padding: 5px 15px; height: auto; width: auto; line-height: unset;" id="tbtn" type="submit" class="mybtn1">{{ $langg->lang300 }}</button>
                                                
                                                <a style="display: none; cursor: pointer;  padding: 5px 15px; height: auto; width: auto; line-height: unset;" id="tc"  class="mybtn1">{{ $langg->lang298 }}</a>
                                                
                                                {{-- Change 1 --}}
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @else
                            
                            <div class="billing-add-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Shipping Address</h5>
                                        <address>
                                            <p>{{ $langg->lang288 }} {{ $order->shipping_name }}</p>
                                            <!--{{ $langg->lang289 }} {{ $order->customer_email }}<br>-->
                                            <p>{{ $langg->lang290 }} {{ $order->shipping_phone }}</p>
                                            <p>{{ $langg->lang291 }} {{ $order->shipping_address }}</p>
                                            <p>{{ $langg->lang830 }}: {{ $order->shipping_state }}</p>
                                            <p>{{$order->shipping_city}}-{{$order->shipping_zip}}</p>
                                        </address>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>{{ $langg->lang292 }}</h5>

                                        <p>{{ $langg->lang798 }}
                                             {!! $order->payment_status == 'Pending' ? "<span class='badge badge-danger'>". $langg->lang799 ."</span>":"<span class='badge badge-success'>". $langg->lang800 ."</span>" !!}
                                        </p>



                                        <p>{{ $langg->lang293 }}
                                            {{App\Classes\Common::formatPrice($order->pay_amount + $order->wallet_price) }}
                                        </p>
                                        <p>{{ $langg->lang294 }} {{$order->method}}</p>

                                        @if($order->method != "Cash On Delivery")
                                        @if($order->method=="Stripe")
                                        {{$order->method}} {{ $langg->lang295 }} <p>{{$order->charge_id}}</p>
                                        @endif
                                        {{$order->method}} {{ $langg->lang296 }} <p id="ttn"> {{$order->txnid}}</p>

                                        <a id="tid" style="cursor: pointer;" class="mybtn2">{{ $langg->lang297 }}</a> 

                                        <form id="tform">
                                            <input style="display: none; width: 100%;" type="text" id="tin" placeholder="{{ $langg->lang299 }}" required="" class="mb-3">
                                            <input type="hidden" id="oid" value="{{$order->id}}">

                                            <button style="display: none; padding: 5px 15px; height: auto; width: auto; line-height: unset;" id="tbtn" type="submit" class="mybtn1">{{ $langg->lang300 }}</button>
                                                
                                                <a style="display: none; cursor: pointer;  padding: 5px 15px; height: auto; width: auto; line-height: unset;" id="tc"  class="mybtn1">{{ $langg->lang298 }}</a>
                                                
                                                {{-- Change 1 --}}
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                            <br>




                            <div class="table-responsive">
                                <h5>{{ $langg->lang308 }}</h5>
                                <table class="table table-bordered veiw-details-table">
                                    <thead>
                                        <tr>
                                            <th width="5%">{{ $langg->lang309 }}</th>
                                            <th width="35%">{{ $langg->lang310 }}</th>
                                            <th width="20%">{{ $langg->lang539 }}</th>
                                            <th>{{ $langg->lang314 }}</th>
                                            <th>{{ $langg->lang315 }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart->items as $product)
                                        <tr>
                                            <td>{{ $product['item']['id'] }}</td>
                                            <td>
                                                <input type="hidden" value="{{ $product['license'] }}">

                                                @if($product['item']['user_id'] != 0)
                                                @php
                                                $user = App\Models\User::find($product['item']['user_id']);
                                                @endphp
                                                @if(isset($user))
                                                <a target="_blank"
                                                    href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>
                                                @else
                                                <a target="_blank"
                                                    href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>
                                                @endif
                                                @else

                                                <a target="_blank"
                                                    href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>

                                                @endif
                                                @if($product['item']['type'] != 'Physical')
                                                @if($order->payment_status == 'Completed')
                                                @if($product['item']['file'] != null)
                                                <a href="{{ route('user-order-download',['slug' => $order->order_number , 'id' => $product['item']['id']]) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fa fa-download"></i> {{ $langg->lang316 }}
                                                </a>
                                                @else
                                                <a target="_blank" href="{{ $product['item']['link'] }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fa fa-download"></i> {{ $langg->lang316 }}
                                                </a>
                                                @endif
                                                @if($product['license'] != '')
                                                <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete"
                                                    class="btn btn-sm btn-info product-btn" id="license"><i
                                                        class="fa fa-eye"></i> {{ $langg->lang317 }}</a>
                                                @endif
                                                @endif
                                                @endif
                                            </td>
                                            <td>
                                                <b>{{ $langg->lang311 }}</b>: {{$product['qty']}} <br>
                                                @if(!empty($product['size']))
                                                <b>{{ $langg->lang312 }}</b>: {{ $product['item']['measure'] }}{{str_replace('-',' ',$product['size'])}} <br>
                                                @endif
                                                @if(!empty($product['color']))
                                                <div class="d-flex mt-2">
                                                <b>{{ $langg->lang313 }}</b>:  <span id="color-bar" style="border: 10px solid {{$product['color'] == "" ? "white" : '#'.$product['color']}};"></span>
                                                </div>
                                                @endif

                                                    @if(!empty($product['keys']))

                                                    @foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values']))  as $key => $value)

                                                        <b>{{ ucwords(str_replace('_', ' ', $key))  }} : </b> {{ $value }} <br>
                                                    @endforeach

                                                    @endif

                                                  </td>
                                            <td>{{App\Classes\Common::formatPrice($product['item']['price'])}}
                                            </td>
                                            <td>{{App\Classes\Common::formatPrice($product['price'])}}
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-right" style="margin-bottom: 48px !important">
                                    <p><b>Delivery Cost:</b> {{ App\Classes\Common::formatPrice($order->delivery_cost) }}</p>
                                </div>
                                <div class="edit-account-info-div">
                                    <div class="form-group">
                                        <a class="back-btn" href="{{ route('user-orders') }}">{{ $langg->lang318 }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ $langg->lang319 }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p class="text-center">{{ $langg->lang320 }} <span id="key"></span></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ $langg->lang321 }}</button>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

<script type="text/javascript">
    $('#example').dataTable({
        "ordering": false,
        'paging': false,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': false,
        'responsive': true
    });
</script>
<script>

    $(document).on("click", "#tid", function (e) {
        $(this).hide();
        $("#tc").show();
        $("#tin").show();
        $("#tbtn").show();
    });
    $(document).on("click", "#tc", function (e) {
        $(this).hide();
        $("#tid").show();
        $("#tin").hide();
        $("#tbtn").hide();
    });
    $(document).on("submit", "#tform", function (e) {
        var oid = $("#oid").val();
        var tin = $("#tin").val();
        $.ajax({
            type: "GET",
            url: "{{URL::to('user/json/trans')}}",
            data: {
                id: oid,
                tin: tin
            },
            success: function (data) {
                $("#ttn").html(data);
                $("#tin").val("");
                $("#tid").show();
                $("#tin").hide();
                $("#tbtn").hide();
                $("#tc").hide();
            }
        });
        return false;
    });
</script>
<script type="text/javascript">

      $(document).ready(function() {
        if ($(window).width() < 800){
            alert()
          $('#ezy-header').css('display', 'none');
          $('#ezy-footer').css('display', 'none');
          $('#user-profile-mobile-header').css('display', 'flex');
        }
      });
    $(document).on('click', '#license', function (e) {
        var id = $(this).parent().find('input[type=hidden]').val();
        $('#key').html(id);
    });
</script>
@endsection
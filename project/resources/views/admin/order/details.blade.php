@extends('layouts.admin')
     
@section('styles')

<style type="text/css">
    .order-table-wrap table#example2 {
    margin: 10px 20px;
}

</style>

@endsection


@section('content')
    <div class="content-area">
                        <div class="mr-breadcrumb">
                            <div class="row">
                                <div class="col-lg-12">
                                        <h4 class="heading">{{ __('Order Details') }} <a class="add-btn" href="javascript:history.back();"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                                        <ul class="links">
                                            <li>
                                                <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">{{ __('Orders') }}</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">{{ __('Order Details') }}</a>
                                            </li>
                                        </ul>
                                </div>
                            </div>
                        </div>

                        <div class="order-table-wrap">
                            @include('includes.admin.form-both')
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="special-box">
                                        <div class="heading-area">
                                            <h4 class="title">
                                            {{ __('Order Details') }}
                                            </h4>
                                        </div>
                                        <div class="table-responsive-sm">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <th class="45%" width="45%">{{ __('Order ID') }}</th>
                                                    <td width="10%">:</td>
                                                    <td class="45%" width="45%">{{$order->order_number}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="45%">{{ __('Total Product') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$order->totalQty}}</td>
                                                </tr>
                                                @if($order->shipping_title != null)
                                                    <tr>
                                                        <th width="45%">{{ __('Shipping Method') }}</th>
                                                        <td width="10%">:</td>
                                                        <td width="45%">{{ $order->shipping_title }}</td>
                                                    </tr>
                                                @endif

                                                @if($order->shipping_cost != 0)
                                                <tr>
                                                    <th width="45%">{{ __('Shipping Cost') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{ App\Classes\Common::formatPrice($order->shipping_cost) }}</td>
                                                </tr>
                                                @endif

                                                @if($order->packing_title != null)
                                                    <tr>
                                                        <th width="45%">{{ __('Packaging Method') }}</th>
                                                        <td width="10%">:</td>
                                                        <td width="45%">{{ $order->packing_title }}</td>
                                                    </tr>
                                                @endif

                                                @if($order->packing_cost != 0)

                                                <tr>
                                                    <th width="45%">{{ __('Packaging Cost') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{ App\Classes\Common::formatPrice($order->packing_cost) }}</td>
                                                </tr>

                                                @endif


                                                @if($order->wallet_price != 0)
                                                <tr>
                                                    <th width="45%">{{ __('Paid From Wallet') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{App\Classes\Common::formatPrice($order->wallet_price) }}</td>
                                                </tr>
    
                                                    @if($order->method != "Wallet")
                                                    <tr>
                                                        <th width="45%">{{$order->method}}</th>
                                                        <td width="10%">:</td>
                                                        <td width="45%">{{App\Classes\Common::formatPrice($order->pay_amount) }}</td>
                                                    </tr>
                                                    @endif

                                                @endif

                                                <tr>
                                                    <th width="45%">{{ __('Total Cost') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{App\Classes\Common::formatPrice($order->pay_amount + $order->wallet_price) }}</td>
                                                </tr>
                                                <tr>
                                                    <th width="45%">{{ __('Ordered Date') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{date('d-M-Y H:i:s a',strtotime($order->created_at))}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="45%">{{ __('Payment Method') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$order->method}}</td>
                                                </tr>
                
                                                @if($order->method != "Cash On Delivery" && $order->method != "Wallet")
                                                @if($order->method=="Stripe")
                                                <tr>
                                                    <th width="45%">{{$order->method}} {{ __('Charge ID') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$order->charge_id}}</td>
                                                </tr>                        
                                                @endif
                                                <tr>
                                                    <th width="45%">{{$order->method}} {{ __('Transaction ID') }}</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$order->txnid}}</td>
                                                </tr>                         
                                                @endif


                                                    <th width="45%">{{ __('Payment Status') }}</th>
                                                    <th width="10%">:</th>
                                                    <td width="45%">{!! $order->payment_status == 'Pending' ? "<span class='badge badge-danger'>Unpaid</span>":"<span class='badge badge-success'>Paid</span>" !!}</td>

                                                @if(!empty($order->order_note))
                                                    <th width="45%">{{ __('Order Note') }}</th>
                                                    <th width="10%">:</th>
                                                    <td width="45%">{{$order->order_note}}</td>
                                                @endif

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="footer-area">
                                            <a href="{{ route('admin-order-invoice',$order->id) }}" class="mybtn1"><i class="fas fa-eye"></i> {{ __('View Invoice') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="special-box">
                                        <div class="heading-area">
                                            <h4 class="title">
                                            {{ __('Billing Details') }}
                                            </h4>
                                        </div>
                                        <div class="table-responsive-sm">
                                            <table class="table">
                                                <tbody>
                                                        <tr>
                                                            <th width="45%">{{ __('Name') }}</th>
                                                            <th width="10%">:</th>
                                                            <td width="45%">{{$order->customer_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="45%">{{ __('Email') }}</th>
                                                            <th width="10%">:</th>
                                                            <td width="45%">{{$order->customer_email}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="45%">{{ __('Phone') }}</th>
                                                            <th width="10%">:</th>
                                                            <td width="45%">{{$order->customer_phone}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="45%">{{ __('Address') }}</th>
                                                            <th width="10%">:</th>
                                                            <td width="45%">{{$order->customer_address}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="45%">{{ __('Country') }}</th>
                                                            <th width="10%">:</th>
                                                            <td width="45%">{{$order->customer_country}}</td>
                                                        </tr>
                                                        @if($order->customer_state != null)
                                                        <tr>
                                                            <th width="45%">{{ __('State') }}</th>
                                                            <th width="10%">:</th>
                                                            <td width="45%">{{$order->customer_state}}</td>
                                                        </tr>
                                                        @endif
                                                        <tr>
                                                            <th width="45%">{{ __('City') }}</th>
                                                            <th width="10%">:</th>
                                                            <td width="45%">{{$order->customer_city}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="45%">{{ __('Postal Code') }}</th>
                                                            <th width="10%">:</th>
                                                            <td width="45%">{{$order->customer_zip}}</td>
                                                        </tr>
                                                        @if($order->coupon_code != null)
                                                        <tr>
                                                            <th width="45%">{{ __('Coupon Code') }}</th>
                                                            <th width="10%">:</th>
                                                            <td width="45%">{{$order->coupon_code}}</td>
                                                        </tr>
                                                        @endif
                                                        @if($order->coupon_discount != null)
                                                        <tr>
                                                            <th width="45%">{{ __('Coupon Discount') }}</th>
                                                            <th width="10%">:</th>
                                                            <td width="45%">{{ App\Classes\Common::formatPrice($order->coupon_discount) }}</td>
                                                        </tr>
                                                        @endif
                                                        @if($order->affilate_user != null)
                                                        <tr>
                                                            <th width="45%">{{ __('Affilate User') }}</th>
                                                            <th width="10%">:</th>
                                                            <td width="45%">
                                                                @if( App\Models\User::where('id', $order->affilate_user)->exists() )
                                                                {{  App\Models\User::where('id', $order->affilate_user)->first()->name  }}
                                                                @else 
                                                                {{ __('Deleted') }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @if($order->affilate_charge != null)
                                                        <tr>
                                                            <th width="45%">{{ __('Affilate Charge') }}</th>
                                                            <th width="10%">:</th>
                                                            <td width="45%">{{ App\Classes\Common::formatPrice($order->affilate_charge)}}</td>
                                                        </tr>
                                                        @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                @if($order->dp == 0)
                                <div class="col-lg-6">
                                    <div class="special-box">
                                        <div class="heading-area">
                                            <h4 class="title">
                                            {{ __('Shipping Details') }}
                                            </h4>
                                        </div>
                                        <div class="table-responsive-sm">
                                            <table class="table">
                                                <tbody>
                            @if($order->shipping == "pickup")
                        <tr>
                                    <th width="45%"><strong>{{ __('Pickup Location') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->pickup_location}}</td>
                                </tr>
                            @else
                                <tr>
                                    <th width="45%"><strong>{{ __('Name') }}:</strong></th>
                                    <th width="10%">:</th>
                <td>{{$order->shipping_name == null ? $order->customer_name : $order->shipping_name}}</td>
                                </tr>
                                <tr>
                                    <th width="45%"><strong>{{ __('Email') }}:</strong></th>
                                    <th width="10%">:</th>
                <td width="45%">{{$order->shipping_email == null ? $order->customer_email : $order->shipping_email}}</td>
                                </tr>
                                <tr>
                                    <th width="45%"><strong>{{ __('Phone') }}:</strong></th>
                                    <th width="10%">:</th>
                <td width="45%">{{$order->shipping_phone == null ? $order->customer_phone : $order->shipping_phone}}</td>
                                </tr>
                                <tr>
                                    <th width="45%"><strong>{{ __('Address') }}:</strong></th>
                                    <th width="10%">:</th>
                <td width="45%">{{$order->shipping_address == null ? $order->customer_address : $order->shipping_address}}</td>
                                </tr>
                                <tr>
                                    <th width="45%"><strong>{{ __('Country') }}:</strong></th>
                                    <th width="10%">:</th>
                <td width="45%">{{$order->shipping_country == null ? $order->customer_country : $order->shipping_country}}</td>
                                </tr>


                                <tr>
                                    <th width="45%">{{ __('State') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{$order->shipping_state == null ?  $order->customer_state: $order->shipping_state }}</td>
                                </tr>



                                <tr>
                                    <th width="45%"><strong>{{ __('City') }}:</strong></th>
                                    <th width="10%">:</th>
                <td width="45%">{{$order->shipping_city == null ? $order->customer_city : $order->shipping_city}}</td>
                                </tr>
                                <tr>
                                    <th width="45%"><strong>{{ __('Postal Code') }}:</strong></th>
                                    <th width="10%">:</th>
                <td width="45%">{{$order->shipping_zip == null ? $order->customer_zip : $order->shipping_zip}}</td>
                                </tr>


                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>



                            <div class="row">
                                    <div class="col-lg-12 order-details-table">
                                        <div class="mr-table">
                                            <h4 class="title">{{ __('Products Ordered') }}</h4>
                                            <div class="table-responsiv">
                                                    <table id="example2" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                <tr>
                                    <th width="10%">{{ __('Product ID#') }}</th>
                                    <th>{{ __('Shop Name') }}</th>
                                    <th>{{ __('Vendor Status') }}</th>
                                    <th>{{ __('Product Title') }}</th>
                                    <th width="20%">{{ __('Details') }}</th>
                                    <th width="10%">{{ __('Total Price') }}</th>
                                </tr>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                @foreach($cart->items as $key => $product)
                                    <tr>
                                        
                                            <td><input type="hidden" value="{{$key}}">{{ $product['item']['id'] }}</td>

                                            <td>
                                                @if($product['item']['user_id'] != 0)
                                                @php
                                                $user = App\Models\User::find($product['item']['user_id']);
                                                @endphp
                                                @if(isset($user))
                                                <a target="_blank" href="{{route('admin-vendor-show',$user->id)}}">{{$user->shop_name}}</a>
                                                @else
                                                {{ __('Vendor Removed') }}
                                                @endif
                                                @else 
                                                <a  href="javascript:;">{{ App\Models\Admin::find(1)->shop_name }}</a>
                                                @endif

                                            </td>
                                            <td>
                                                @if($product['item']['user_id'] != 0)
                                                @php
                                                $user = App\Models\VendorOrder::where('order_id','=',$order->id)->where('user_id','=',$product['item']['user_id'])->first();
                                                @endphp

                                                    @if($order->dp == 1 && $order->payment_status == 'Completed')

                                                    <span class="badge badge-success">{{ __('Completed') }}</span>

                                                    @else
                                                        @if($user->status == 'pending')
                                                        <span class="badge badge-warning">{{ucwords($user->status)}}</span>
                                                        @elseif($user->status == 'processing')
                                                        <span class="badge badge-info">{{ucwords($user->status)}}</span>
                                                       @elseif($user->status == 'on delivery')
                                                        <span class="badge badge-primary">{{ucwords($user->status)}}</span>
                                                       @elseif($user->status == 'completed')
                                                        <span class="badge badge-success">{{ucwords($user->status)}}</span>
                                                       @elseif($user->status == 'declined')
                                                        <span class="badge badge-danger">{{ucwords($user->status)}}</span>
                                                       @endif
                                                    @endif

                                            @endif
                                            </td>


                                            <td>
                                                <input type="hidden" value="{{ $product['license'] }}">

                                                @if($product['item']['user_id'] != 0)
                                                @php
                                                $user = App\Models\User::find($product['item']['user_id']);
                                                @endphp
                                                @if(isset($user))
                                              <a target="_blank" href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>
                                                @else
                                                <a target="_blank" href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>
                                                @endif
                                                @else 

                                                <a target="_blank" href="{{ route('front.product', $product['item']['slug']) }}">{{mb_strlen($product['item']['name'],'utf-8') > 30 ? mb_substr($product['item']['name'],0,30,'utf-8').'...' : $product['item']['name']}}</a>
                                            
                                                @endif


                                                @if($product['license'] != '')
                              <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete" class="btn btn-info product-btn" id="license" style="padding: 5px 12px;"><i class="fa fa-eye"></i> {{ __('View License') }}</a>
                                                @endif

                                            </td>
                                            <td>
                                                @if($product['size'])
                                               <p>
                                                    <strong>{{ __('Size') }} :</strong> {{str_replace('-',' ',$product['size'])}}
                                               </p>
                                               @endif
                                               @if($product['color'])
                                                <p>
                                                        <strong>{{ __('color') }} :</strong> <span
                                                        style="width: 40px; height: 20px; display: block; background: #{{$product['color']}};"></span>
                                                </p>
                                                @endif
                                                <p>
                                                        <strong>{{ __('Price') }} :</strong> {{App\Classes\Common::formatPrice($product['item']['price']) }}
                                                </p>
                                               <p>
                                                    <strong>{{ __('Qty') }} :</strong> {{$product['qty']}} {{ $product['item']['measure'] }}
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

                                    </tr>
                                @endforeach
                                                        </tbody>
                                                    </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-center mt-2">
                                        <a class="btn sendEmail send" href="javascript:;" class="send" data-email="{{ $order->customer_email }}" data-toggle="modal" data-target="#vendorform">
                                                <i class="fa fa-send"></i> {{ __('Send Email') }}
                                        </a>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- Main Content Area End -->
                </div>
            </div>


    </div>

{{-- LICENSE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <div class="modal-header d-block text-center">
        <h4 class="modal-title d-inline-block">{{ __('License Key') }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>

                <div class="modal-body">
                    <p class="text-center">{{ __('The Licenes Key is') }} :  <span id="key"></span> <a href="javascript:;" id="license-edit">{{ __('Edit License') }}</a><a href="javascript:;" id="license-cancel" class="showbox">{{ __('Cancel') }}</a></p>
                    <form method="POST" action="{{route('admin-order-license',$order->id)}}" id="edit-license" style="display: none;">
                        {{csrf_field()}}
                        <input type="hidden" name="license_key" id="license-key" value="">
                        <div class="form-group text-center">
                    <input type="text" name="license" placeholder="{{ __('Enter New License Key') }}" style="width: 40%; border: none;" required=""><input type="submit" name="submit" class="btn btn-primary" style="border-radius: 0; padding: 2px; margin-bottom: 2px;">
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>


{{-- LICENSE MODAL ENDS --}}

{{-- MESSAGE MODAL --}}
<div class="sub-categori">
    <div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vendorformLabel">{{ __('Send Email') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            <div class="modal-body">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contact-form">
                                <form id="emailreply">
                                    {{csrf_field()}}
                                    <ul>
                                        <li>
                                            <input type="email" class="input-field eml-val" id="eml" name="to" placeholder="{{ __('Email') }} *" value="" required="">
                                        </li>
                                        <li>
                                            <input type="text" class="input-field" id="subj" name="subject" placeholder="{{ __('Subject') }} *" required="">
                                        </li>
                                        <li>
                                            <textarea class="input-field textarea" name="message" id="msg" placeholder="{{ __('Your Message') }} *" required=""></textarea>
                                        </li>
                                    </ul>
                                    <button class="submit-btn" id="emlsub" type="submit">{{ __('Send Email') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

{{-- MESSAGE MODAL ENDS --}}

{{-- ORDER MODAL --}}

<div class="modal fade" id="confirm-delete2" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="submit-loader">
            <img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
        </div>
    <div class="modal-header d-block text-center">
        <h4 class="modal-title d-inline-block">{{ __('Update Status') }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p class="text-center">{{ __("You are about to update the order's status.") }}</p>
        <p class="text-center">{{ __('Do you want to proceed?') }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
            <a class="btn btn-success btn-ok order-btn">{{ __('Proceed') }}</a>
      </div>

    </div>
  </div>
</div>

{{-- ORDER MODAL ENDS --}}


@endsection


@section('scripts')

<script type="text/javascript">
$('#example2').dataTable( {
  "ordering": false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false,
      'responsive'  : true
} );
</script>

    <script type="text/javascript">
        $(document).on('click','#license' , function(e){
            var id = $(this).parent().find('input[type=hidden]').val();
            var key = $(this).parent().parent().find('input[type=hidden]').val();
            $('#key').html(id);  
            $('#license-key').val(key);    
    });
        $(document).on('click','#license-edit' , function(e){
            $(this).hide();
            $('#edit-license').show();
            $('#license-cancel').show();
        });
        $(document).on('click','#license-cancel' , function(e){
            $(this).hide();
            $('#edit-license').hide();
            $('#license-edit').show();
        });

        $(document).on('submit','#edit-license' , function(e){
            e.preventDefault();
          $('button#license-btn').prop('disabled',true);
              $.ajax({
               method:"POST",
               url:$(this).prop('action'),
               data:new FormData(this),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
               success:function(data)
               {
                  if ((data.errors)) {
                    for(var error in data.errors)
                    {
                        $.notify('<li>'+ data.errors[error] +'</li>','error');
                    }
                  }
                  else
                  {
                    $.notify(data,'success');
                    $('button#license-btn').prop('disabled',false);
                    $('#confirm-delete').modal('toggle');

                   }
               }
                });
        });
    </script>

@endsection
@extends('layouts.front')
@section('content')


<section class="user-dashbord">
    <div class="container">
        <div class="row">
        <div class="col-lg-12">
          <div class="user-profile-details">
            <div class="account-info wallet shadow-no-border">
              <div class="header-area">
                <h4 class="title text-capitalize">
                  <!-- {{ $langg->lang836 }} -->
                  {{$order_status}} orders
                </h4>
              </div>
              <div class="main-info">
                <div class="mr-table allproduct mt-4">
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ $langg->lang278 }}</th>
														<th>{{ $langg->lang279 }}</th>
														<th>{{ $langg->lang280 }}</th>
														<th>{{ $langg->lang281 }}</th>
														<th>{{ $langg->lang282 }}</th>
													</tr>
												</thead>
												<tbody>
													 @foreach($order_infos as $order)
													<tr>
														<td>
																{{$order->order_number}}
														</td>
														<td>
																{{date('d M Y',strtotime($order->created_at))}}
														</td>
														<td>
																{{App\Classes\Common::formatPrice($order->pay_amount+$order->wallet_price) }}
														</td>
														<td>
															<div class="order-status {{ $order->status }}">
																	{{ucwords($order->status)}}
															</div>
														</td>
														<td>
															<a class="mybtn1 sm sm1" href="{{route('user-order',$order->id)}}">
																	{{ $langg->lang283 }}
															</a>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
									</div>
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

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
      if ($(window).width() < 800){
        $('#ezy-header').css('display', 'none');
        $('#ezy-footer').css('display', 'none');
        $('#user-profile-mobile-header').css('display', 'flex');
      }
    });
</script>
@endsection
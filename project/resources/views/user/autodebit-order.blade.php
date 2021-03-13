@extends('layouts.front')
@section('content')


<section class="user-dashbord">
    <div class="container">
        <div class="row">
		@include('includes.user-dashboard-sidebar')
        <div class="col-lg-8">
          <div class="user-profile-details">
            <div class="account-info wallet shadow-no-border">
              <div class="header-area">
                <h4 class="title text-capitalize">
                  <!-- {{ $langg->lang836 }} -->
                  Autodebit orders
                </h4>
              </div>
              <div class="main-info">
                <div class="mr-table allproduct mt-4">
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>Shop Name</th>
														<th>Date</th>
														<th>Title</th>
														<th>Method</th>
														<th>Cost</th>
														<th>Term</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
												@if(count($ordered_autodebits) != 0)
													 @foreach($ordered_autodebits as $ordered_autodebit)
													<!-- <tr>
														<td class="text-capitalize">
																{{ App\Models\User::where('id', $ordered_autodebit->vendor_id)->first()->shop_name }}
														</td>
														<td>
																{{date('d M Y',strtotime($ordered_autodebit->created_at))}}
														</td>
														<td>
																{{ App\Models\AutodebitSubscription::where('id', $ordered_autodebit->subscription_id)->first()->title }}
														</td>
														<td class="text-capitalize">
																{{ App\Models\AutodebitSubscription::where('id', $ordered_autodebit->subscription_id)->first()->method }}
														</td>
														<td>
																{{ App\Classes\Common::formatPrice(App\Models\AutodebitSubscription::where('id', $ordered_autodebit->subscription_id)->first()->cost) }}
														</td>
														<td>
																{{ $ordered_autodebit->terms.' years' }}
														</td>
														<td>
														@switch($ordered_autodebit->status)
															@case(0)
																<div class="autodebit-status" style="background: orange">Pending</div>
																@break
															@case(1)
																<div class="autodebit-status" style="background: #02abff">Approve</div>
																@break
															@case(2)
																<div class="autodebit-status" style="background: #ff0000">Decline</div>
																@break
															@case(3)
																<div class="autodebit-status" style="background: #02abff">Canceled</div>
																@break
															@case(4)
																<div class="autodebit-status" style="background: green">Expired</div>
																@break
														@endswitch
														</td>
													</tr> -->
													@endforeach
												@endif
												@if(count($ordered_insurrances) != 0)
													 @foreach($ordered_insurrances as $ordered_insurrance)
													<!-- <tr>
														<td class="text-capitalize">
																{{ App\Models\User::where('id', $ordered_insurrance->vendor_id)->first()->shop_name }}
														</td>
														<td>
																{{ $ordered_insurrance->title }}
														</td>
														<td class="text-capitalize">
																{{ $ordered_insurrance->method == 'half_year'?'Half Year':$ordered_insurrance->method}}
														</td>
														<td>
																{{ App\Classes\Common::formatPrice($ordered_insurrance->amount) }}
														</td>
														<td>
																{{ $ordered_insurrance->terms.' years' }}
														</td>
														<td>
														@switch($ordered_insurrance->status)
															@case(0)
																<div class="autodebit-status" style="background: orange">Pending</div>
																@break
															@case(1)
																<div class="autodebit-status" style="background: #02abff">Approve</div>
																@break
															@case(2)
																<div class="autodebit-status" style="background: #ff0000">Decline</div>
																@break
															@case(3)
																<div class="autodebit-status" style="background: #02abff">Canceled</div>
																@break
															@case(4)
																<div class="autodebit-status" style="background: green">Expired</div>
																@break
														@endswitch
														</td>
													</tr> -->
													@endforeach
												@endif
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
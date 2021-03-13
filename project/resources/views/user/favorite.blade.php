@extends('layouts.front')
@section('content')


<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
        <div class="col-lg-8">
					<div class="user-profile-details">
						<div class="order-history shadow-no-border">
							<div class="header-area d-flex align-items-center">
								<h4 class="title">{{ $langg->lang252 }}</h4>          
							</div>
							<div class="mr-table allproduct message-area  mt-4">
								@include('includes.form-success')
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ $langg->lang253 }}</th>
														<th>{{ $langg->lang254 }}</th>
														<th>{{ $langg->lang255 }}</th>
														<th>{{ $langg->lang256 }}</th>
													</tr>
												</thead>
												<tbody>
                        @foreach($favorites as $vendor)
                          @php
                            $seller = App\Models\User::findOrFail($vendor->vendor_id);
                          @endphp

                          <tr class="conv">
                            
                              <td>{{$seller->shop_name}}</td>
                              <td>{{$seller->owner_name}}</td>
                              <td>{{$seller->shop_address}}</td>

                            <td>
                              <a target="_blank" href="{{route('front.vendor', [str_replace(' ', '-', $seller->shop_name), $seller->id, $vendor->store_type])}}" class="link view"><i class="fa fa-eye"></i></a>
                              <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete" data-href="{{route('user-favorite-delete',$vendor->id)}}" class="link remove"><i class="fa fa-trash"></i></a>
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
	</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <div class="modal-header d-block text-center">
        <h4 class="modal-title d-inline-block">{{ $langg->lang257 }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>

                <div class="modal-body">
            <p class="text-center">{{ $langg->lang258 }}</p>
            <p class="text-center">{{ $langg->lang259 }}</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ $langg->lang260 }}</button>
                    <a class="btn btn-danger btn-ok">{{ $langg->lang261 }}</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

<script type="text/javascript">

      $('#confirm-delete').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });
      
     $(document).ready(function() {
        if ($(window).width() < 800){
          $('#ezy-header').css('display', 'none');
          $('#ezy-footer').css('display', 'none');
          $('#user-profile-mobile-header').css('display', 'flex');
        }
     });

</script>

@endsection
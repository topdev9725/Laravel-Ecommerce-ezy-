@extends('layouts.vendor') 
@section('styles')
<style>
	.status_canceled{
		padding: 5px 10px;
    	border-radius: 50px;
    	color: #fff;
		background-color: #d9534f !important;
	}	
	.approved{background-color: green;}
</style>
@endsection
@section('content')

					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __('Autodebit Orders') }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
											</li>
											<li>
												<a href="{{ route('vendor-autodebit-order-index') }}">{{ __('Autodebit Orders') }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">
										@include('includes.form-success')
										<div class="table-responsiv">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
						                                <th>{{ __('Order ID') }}</th>
														<th>{{ __('User Name') }}</th>
														<th>{{ __('Email') }}</th>
														<th>{{ __('Method') }}</th>
						                                <th>{{ __('Cost') }}</th>
														<th>{{ __('Terms(Years)') }}</th>
						                                <th>{{ __('Order Date') }}</th>
						                                <th>{{ __('Action') }}</th>						                                
														</tr>
													</thead>
													<tbody>														
													</tbody>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

{{-- ORDER MODAL --}}

<div class="modal fade" id="confirm-delete2" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="submit-loader">
        <img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
    </div>
    <div class="modal-header d-block text-center">
        <h4 class="modal-title d-inline-block">{{ $langg->lang544 }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p class="text-center">{{ $langg->lang545 }}</p>
        <p class="text-center">{{ $langg->lang546 }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ $langg->lang547 }}</button>
            <a class="btn btn-success btn-ok order-btn">{{ $langg->lang548 }}</a>
      </div>

    </div>
  </div>
</div>

{{-- ORDER MODAL ENDS --}}

@endsection    



@section('scripts')

{{-- DATA TABLE --}}


    <script type="text/javascript">
		$(document).on('change', '.vendor-btn', function(){
			$('#confirm-delete2').modal('show');
			$('#confirm-delete2').find('.btn-ok').attr('href', $(this).val());
		});

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('vendor-autodebit-insurrrance-order-datatables') }}',
               columns: [
						{ data: 'id', name: 'id' },
						{ data: 'user_name', name: 'user_name' },
						{ data: 'email', name: 'email' },
						{ data: 'title', name: 'title' },
						{ data: 'cost', name: 'cost' },
						{ data: 'terms', name: 'terms' },
						{ data: 'created_at', name: 'created_at' },
            			{ data: 'action', searchable: false, orderable: false }
                     ],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
				drawCallback : function( settings ) {
	    				$('.select').niceSelect();	
				}
            });										
									
    </script>

{{-- DATA TABLE --}}
    
@endsection   
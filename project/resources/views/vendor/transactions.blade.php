@extends('layouts.vendor') 
@section('content')
					<div class="content-area">
                        <div class="mr-breadcrumb">
                            <div class="row">
                                <div class="col-lg-12">
                                        <h4 class="heading">{{ __('Notifications') }}</h4>
                                        <ul class="links">
                                            <li>
                                                <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
                                            </li>                                            
                                            <li>
                                                <a href="{{ route('vendor-notifications') }}">{{ __('Notifications') }}</a>
                                            </li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-area">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mr-table allproduct">
                                        <div class="table-responsiv">
                                          	<div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
												<table id="example1" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
															<th>{{ $langg->lang840 }}</th>
															<th>{{ $langg->lang334 }}</th>
															<th>{{ $langg->lang827 }}</th>
															<th>{{ $langg->lang828 }}</th>
															<th>{{ $langg->lang282 }}</th>
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
					</div>

<!-- Order Tracking modal Start-->
<div class="modal fade" id="trans-modal" tabindex="-1" role="dialog" aria-labelledby="trans-modal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body" id="trans">

		</div>
		</div>
	</div>
</div>
<!-- Order Tracking modal End -->

@endsection


@section('scripts')

<script type="text/javascript">
	var table = $('#example1').DataTable({
		ordering: false,
		processing: true,
		serverSide: true,
		ajax: '{{ route('vendor-transaction-datatables') }}',
		columns: [
				{ data: 'txn_number', name: 'txn_number' },
				{ data: 'amount', name: 'amount' },
				{ data: 'created_at', name: 'created_at' },
				{ data: 'details', name: 'details' },
				{ data: 'action', searchable: false, orderable: false }
		],
		language : {
			processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
		},
		drawCallback : function( settings ) {
				$('.select').niceSelect();	
		}
	});
    $(document).on('click', '.txn-show', function(e){
        var url = $(this).data('href');
        $('#trans').load(url);
        $('#trans-modal').modal('show');
    });


</script>

@endsection
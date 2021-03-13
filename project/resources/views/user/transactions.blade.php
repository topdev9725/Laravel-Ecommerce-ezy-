@extends('layouts.front')
@section('styles')
<style>
	.mybtn1.sm{color: #ffffff !important;}
	.mybtn1.sm:hover{color: rgb(72, 166, 66) !important;}
</style>
@endsection
@section('content')
<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
        <div class="col-lg-8">
					<div class="user-profile-details">
						<div class="order-history shadow-no-border">
							<div class="header-area">
								<h4 class="title" >
									{{ $langg->lang826 }}
								</h4>
							</div>
							<div class="mr-table allproduct mt-4">
									<div class="table-responsiv">
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
	</section>


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
		ajax: '{{ route('user-transaction-datatables') }}',
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

  $(document).ready(function() {
    if ($(window).width() < 800){
      $('#ezy-header').css('display', 'none');
      $('#ezy-footer').css('display', 'none');
	  $('#user-profile-mobile-header').css('display', 'flex');
    }
  });
</script>

@endsection
@extends('layouts.admin') 
@section('styles')
<style>
.deposit-status{
	padding: 5px 10px;
    border-radius: 50px;
    color: #fff;
}
.left-area h4{font-size: 16px;}
#edit-modal .row{margin-bottom: 20px;}
</style>
@endsection
@section('content')  
					<input type="hidden" id="headerdata" value="{{ __('Bank Deposit') }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __('Bank Deposit Requests') }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
											</li>
											<li>
												<a href="javascript:;">{{ __('Deposit') }} </a>
											</li>
											<li>
												<a href="{{ route('admin-deposit-bank') }}">{{ __('Bank Request') }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">

                        @include('includes.admin.form-success')  

										<div class="table-responsiv">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
															<th>{{ __('Request Number') }}</th>
									                        <th>{{ __('Reference ID') }}</th>
									                        <th>{{ __('Email') }}</th>
									                        <th>{{ __('Amount') }}</th>
									                        <th>{{ __('Photo') }}</th>
									                        <th>{{ __('Deposit Date') }}</th>
									                        <th>{{ __('Status') }}</th>
															<th>{{ __('Complete Date') }}</th>
									                        <th>{{ __('Options') }}</th>
														</tr>
													</thead>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>



{{-- ADD / EDIT MODAL --}}

<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal" aria-hidden="true">

	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="submit-loader">
					<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
			</div>
			<div class="modal-header">
				<h5 class="modal-title">{{ __('Bank Deposit Request') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">				
				{{csrf_field()}}		
				<input type="hidden" name="deposit_id"/>
				<div class="row">
					<div class="col-lg-4">
						<div class="left-area">
							<h4 class="heading">{{ __('Request Number') }}</h4>                                
						</div>
					</div>
					<div class="col-lg-7">
						<p class="txnid"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<div class="left-area">
							<h4 class="heading">{{ __('User Name') }}</h4>
						</div>
					</div>
					<div class="col-lg-7">
						<p class="user_name"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<div class="left-area">
							<h4 class="heading">{{ __('Reference ID') }}</h4>
						</div>
					</div>
					<div class="col-lg-7">
						<p class="reference_id"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<div class="left-area">
							<h4 class="heading">{{ __('Amount')}} *</h4>
						</div>
					</div>
					<div class="col-lg-7">
						<div class="input-group mb-3">
							<input type="number" min="0" id="deposit_amount" name="amount" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text" id="currency_code"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4">                            
					</div>
					<div class="col-lg-7">
						<button class="btn-update-deposit btn btn-secondary" id="btn-update" type="button">{{ __('Save') }}</button>
					</div>
				</div>				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
			</div>
		</div>
	</div>
</div>

{{-- ADD / EDIT MODAL ENDS --}}


{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-complete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="submit-loader" style="display: none">
				<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
		</div>
	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">{{ __('Confirm Complete') }}</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __('You are about to complete this Request.') }}</p>
            <p class="text-center">{{ __('Do you want to proceed?') }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
            <button class="btn btn-success btn-ok">{{ __('Complete') }}</button>
      </div>

    </div>
  </div>
</div>

{{-- DELETE MODAL ENDS --}}

@endsection    



@section('scripts')


{{-- DATA TABLE --}}

    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-deposit-bank-datatables') }}',
               columns: [
						{ data: 'txnid', name: 'txnid' },
						{ data: 'reference_id', name: 'reference_id' },
						{ data: 'email', name: 'email' },
						{ data: 'amount', name: 'amount' },
						{ data: 'photo', name: 'photo' },
						{ data: 'created_at', name: 'created_at' },
						{ data: 'status', searchable: false, orderable: false},
						{ data: 'updated_at', name: 'updated_at' },
						{ data: 'action', searchable: false, orderable: false }
					],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
				drawCallback : function( settings ) {
	    			$('.select').niceSelect();	
				}
			});
			
		$('#confirm-complete').on('show.bs.modal', function(e) {
          	$(this).find('.btn-ok').attr('data-href', $(e.relatedTarget).data('href'));
		});

		$(document).on('click', '.btn-ok', function() {
			$(".submit-loader").css("display", "unset");
			var url = $(this).data('href');
			$.ajax({
				url: url,
				type:'GET',				
				dataType: 'json',
				success: function(msg) {					
					$(".submit-loader").css("display", "none");
					$('#confirm-complete').modal('hide');
					$('p.text-left', $('.alert-success')).text(msg);
					$('.alert-success').show();
					table.ajax.reload(undefined, false);					
				},
				error: function() {
					$('#confirm-complete').modal('hide');
					alert('Something went wrong. Try again later.');
				}
			});
		});

		$('#edit-modal').on('show.bs.modal', function(e) {
			var modal = $(this);
			var url = $(e.relatedTarget).data('href');
			$('input[name="deposit_id"]').val($(e.relatedTarget).data('id'));
			$.ajax({
				url: url,
				data:{_token: $('input[name="_token"]').val(), id:$('input[name="deposit_id"]').val()},
				type: 'POST',
				dataType: 'json',
				success: function(result) {
					$('p.txnid', modal).text(result.txnid);
					$('p.user_name', modal).text(result.user_name);
					$('p.reference_id', modal).text(result.reference_id);
					$('#deposit_amount').val(result.amount);
					$('#currency_code').text(result.currency_code);
				}
			})  
		});

		$('.btn-update-deposit').on('click', function() {
			var modal = $('#edit-modal');
			var amount = $('#deposit_amount').val(),
				id = $('input[name="deposit_id"]').val();
			$.ajax({
				url: "{{route('admin-deposit-update')}}",
				data:{_token: $('input[name="_token"]').val(), id:id, amount:amount},
				type: 'POST',
				dataType: 'json',
				success: function(msg) {
					modal.modal('hide');
					$('p.text-left', $('.alert-success')).text(msg);
					$('.alert-success').show();
					table.ajax.reload(undefined, false);
				},
				error: function() {
					modal.modal('hide');
					alert('Something went wrong. Try again later.');
				}
			})  
		});

{{-- DATA TABLE ENDS--}}


</script>

@endsection   
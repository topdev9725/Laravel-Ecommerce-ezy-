@extends('layouts.admin') 

@section('content')  
					<input type="hidden" id="headerdata" value="{{ __('COMMENT') }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __('Comments') }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
											</li>
											<li>
												<a href="javascript:;">{{ __('Product Discussion') }} </a>
											</li>
											<li>
												<a href="{{ route('admin-comment-index') }}">{{ __('Comments') }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
								<div class="heading-area">
									<h4 class="title">
										{{ __('Product Comment') }} :
									</h4>
	                                <div class="action-list">
	                                    <select class="process select droplinks {{ $gs->is_comment == 1 ? 'drop-success' : 'drop-danger' }}">
	                                      <option data-val="1" value="{{route('admin-gs-iscomment',1)}}" {{ $gs->is_comment == 1 ? 'selected' : '' }}>{{ __('Activated') }}</option>
	                                      <option data-val="0" value="{{route('admin-gs-iscomment',0)}}" {{ $gs->is_comment == 0 ? 'selected' : '' }}>{{ __('Deactivated') }}</option>
	                                    </select>
	                                  </div>
								</div>
									<div class="mr-table allproduct">
										@include('includes.admin.form-success') 
										<div class="table-responsiv">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
									                        <th width="20%">{{ __('Product') }}</th>
									                        <th width="20%">{{ __('Commenter') }}</th>
									                        <th width="40%">{{ __('Comment') }}</th>
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

				<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
										
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
												<div class="submit-loader">
														<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
												</div>
											<div class="modal-header">
											<h5 class="modal-title"></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											</div>
											<div class="modal-body">

											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
											</div>
						</div>
					</div>

				</div>

{{-- ADD / EDIT MODAL ENDS --}}


{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header text-center">
        <h4 class="modal-title w-100">{{ __('Confirm Delete') }}</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __('You are about to delete this Comment.') }}</p>
            <p class="text-center">{{ __('Do you want to proceed?') }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
            <a class="btn btn-danger btn-ok">{{ __('Delete') }}</a>
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
               ajax: '{{ route('admin-comment-datatables') }}',
               columns: [
                        { data: 'product', name: 'product', searchable: false, orderable: false },
                        { data: 'commenter', name: 'commenter' },
                        { data: 'text', name: 'text' },
            			{ data: 'action', searchable: false, orderable: false }

                     ],
               language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });											
									
    </script>

{{-- DATA TABLE --}}
    
@endsection   
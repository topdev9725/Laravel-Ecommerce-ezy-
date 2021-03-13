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
                                        @include('includes.vendor.form-success') 

                                        <div class="table-responsiv">
                                          <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                                          <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                                            <thead>
                                              <tr>														
                                                <th>{{ $langg->lang359 }}</th>
                                                <th>{{ $langg->lang360 }}</th>
                                                <th>{{ $langg->lang361 }}</th>
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
		

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __('You are about to delete this Notification.') }}</p>
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
@endsection

@section('scripts')

<script type="text/javascript">
  var table = $('#geniustable').DataTable({
      ordering: false,
      processing: true,
      serverSide: true,
      ajax: '{{ route('vendor-notifications-datatables') }}',
      columns: [
        { data: 'message', name: 'message' },
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

@endsection
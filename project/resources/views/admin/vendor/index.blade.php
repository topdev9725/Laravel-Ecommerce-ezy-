@extends('layouts.admin') 
@section('styles')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<style>
.pac-container {
    background-color: #FFF;
    z-index: 20;
    position: fixed;
    display: inline-block;
    float: left;
}
.modal, .godropdown .action-list{
    z-index: 20;   
}
.modal-backdrop{z-index:10;}
a.ui-corner-all{color: #000 !important;}
.ui-timepicker-container{z-index:20 !important;}
</style>
@endsection
@section('content')  
					<input type="hidden" id="headerdata" value="{{ __("VENDOR") }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __("Vendors") }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
											</li>
											<li>
												<a href="javascript:;">{{ __("Vendors") }}</a>
											</li>
											<li>
												<a href="{{ route('admin-vendor-index') }}">{{ __("Vendors List") }}</a>
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
										{{ __("Vendor Registration") }} :
									</h4>
	                                <div class="action-list">
	                                    <select class="process select1 vdroplinks {{ $gs->reg_vendor == 1 ? 'drop-success' : 'drop-danger' }}">
	                                      <option data-val="1" value="{{route('admin-gs-regvendor',1)}}" {{ $gs->reg_vendor == 1 ? 'selected' : '' }}>{{ __("Activated") }}</option>
	                                      <option data-val="0" value="{{route('admin-gs-regvendor',0)}}" {{ $gs->reg_vendor == 0 ? 'selected' : '' }}>{{ __("Deactivated") }}</option>
	                                    </select>
	                                  </div>
								</div>


									<div class="mr-table allproduct">
										@include('includes.admin.form-success') 
										<div class="table-responsiv">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
		                                                  <th>{{ __("Store Name") }}</th>
		                                                  <th>{{ __("Vendor Email") }}</th>
		                                                  <th>{{ __("Shop Number") }}</th>
		                                                  <th>{{ __("Status") }}</th>
		                                                  <th>{{ __("Options") }}</th>
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
											<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
											</div>
						</div>
					</div>

			</div>

{{-- ADD / EDIT MODAL ENDS --}}


{{-- VERIFICATION MODAL --}}

<div class="modal fade" id="verify-modal" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
										
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="submit-loader">
					<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
				</div>
				<div class="modal-header">
					<h5 class="modal-title">ASK FOR VERIFICATION</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
				</div>
			</div>
		</div>

</div>

{{-- VERIFICATION MODAL ENDS --}}


{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">{{ __("Confirm Delete") }}</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{__("You are about to delete this Vendor. Every informtation under this vendor will be deleted.")}}</p>
            <p class="text-center">{{ __("Do you want to proceed?") }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
            <a class="btn btn-danger btn-ok">{{ __("Delete") }}</a>
      </div>

    </div>
  </div>
</div>

{{-- DELETE MODAL ENDS --}}


{{-- STATUS MODAL --}}

<div class="modal fade" id="confirm-delete1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <div class="modal-header d-block text-center">
        <h4 class="modal-title d-inline-block">{{ __("Update Status") }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __("You are about to change the status.") }}</p>
            <p class="text-center">{{ __("Do you want to proceed?") }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
            <a class="btn btn-success btn-ok">{{ __("Update") }}</a>
      </div>

    </div>
  </div>
</div>

{{-- STATUS MODAL ENDS --}}

{{-- MESSAGE MODAL --}}

<div class="sub-categori">
	<div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="vendorformLabel">{{ __("Send Message") }}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
				</div>
			<div class="modal-body">
				<div class="container-fluid p-0">
					<div class="row">
						<div class="col-md-12">
							<div class="contact-form">
								<form id="emailreply1">
									{{csrf_field()}}
									<ul>
										<li>
											<input type="email" class="input-field eml-val" id="eml1" name="to" placeholder="{{ __("Email") }} *" value="" required="">
										</li>
										<li>
											<input type="text" class="input-field" id="subj1" name="subject" placeholder="{{ __("Subject") }} *" required="">
										</li>
										<li>
											<textarea class="input-field textarea" name="message" id="msg1" placeholder="{{ __("Your Message") }} *" required=""></textarea>
										</li>
									</ul>
									<button class="submit-btn" id="emlsub1" type="submit">{{ __("Send Message") }}</button>
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

@endsection    

@section('scripts')

{{-- DATA TABLE --}}

    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-vendor-datatables') }}',
               columns: [
                        { data: 'shop_name', name: 'shop_name' },
                        { data: 'email', name: 'email' },
                        { data: 'shop_number', name: 'shop_number' },
                        { data: 'status', searchable: false, orderable: false},
            			{ data: 'action', searchable: false, orderable: false }
                     ],
               language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
				drawCallback : function( settings ) {
	    				$('.select').niceSelect();	
				}
            });

	    				$('.select1').niceSelect();	
																
    </script>


<script type="text/javascript">

$(document).on('click','.verify',function(){
if(admin_loader == 1)
  {
  $('.submit-loader').show();
}
  $('#verify-modal .modal-content .modal-body').html('').load($(this).attr('data-href'),function(response, status, xhr){
      if(status == "success")
      {
        if(admin_loader == 1)
          {
            $('.submit-loader').hide();
          }
      }
    });
});


</script>

{{-- DATA TABLE --}}
<script type="text/javascript">
	var isInitGeoLocate = false;
	var isFullAddress = true;
	$(document).ready(function() {
		$(document).on('shown.bs.modal', '#modal1', function() {
			setTimeout(() => {
				initAutocomplete();				
			}, 500);	
		});		
		$(document).on('click', '#btnSave', function(e) {   
			var latitude = $('#latitude').val();
			var longitude = $('#longitude').val();			
			if(latitude=='' || longitude=='' || latitude=='0' || longitude=='0') {
				showError("Please enter address correctly to get getlocation.<br/>That vendor might not be supported Nearby Service.");
				$('.modal-body').animate({
					scrollTop: 0
				}, 'slow');
				return false;
			}
			return true;			
		});
	});
</script>
<script src="{{asset('assets/front/js/geocoder.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{$gs->map_api_key}}&libraries=places&callback=initAutocomplete" async defer></script>
@endsection   
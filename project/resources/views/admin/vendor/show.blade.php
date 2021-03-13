@extends('layouts.admin')

@section('styles')

<style type="text/css">
    .table-responsive {
    overflow: hidden;
}
table#example2 {
    margin-left: 10px;
}

</style>

@endsection

@section('content')

                    <div class="content-area">
                        <div class="mr-breadcrumb">
                            <div class="row">
                                <div class="col-lg-12">
                                        <h4 class="heading">{{ __("Vendor Details") }} <a class="add-btn" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> {{ __("Back") }}</a></h4>
                                        <ul class="links">
                                            <li>
                                                <a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin-vendor-index') }}">{{ __("Vendors") }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin-vendor-show',$data->id) }}">{{ __("Details") }}</a>
                                            </li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                            <div class="add-product-content customar-details-area">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="product-description">
                                            <div class="body-area" id="modalEdit">
                                            <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="user-image">
                                                            @if($data->is_provider == 1)
                                                            <img src="{{ $data->photo ? asset($data->photo):asset('assets/images/noimage.png')}}" alt="No Image">
                                                            @else
                                                            <img src="{{ $data->photo ? asset('assets/images/users/'.$data->photo):asset('assets/images/noimage.png')}}" alt="{{ __("No Image") }}">                                            
                                                            @endif
                                                        <a href="javascript:;" class="mybtn1 send" data-email="{{ $data->email }}" data-toggle="modal" data-target="#vendorform">{{ __("Send Message") }}</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <div class="table-responsive show-table">
                                                        <table class="table">
                                                        <tr>
                                                            <th>{{ __("Vendor ID#") }}</th>
                                                            <td>{{$data->id}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>{{ __("Store Name") }}</th>
                                                            <td>{{ $data->shop_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>{{ __("Owner Name") }}</th>
                                                            <td>{{ $data->owner_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>{{ __("Email") }}</th>
                                                            <td>{{ $data->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>{{ __("Shop Number") }}</th>
                                                            <td>{{ $data->shop_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>{{ __("Registration Number") }}</th>
                                                            <td>{{ $data->reg_number }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th>{{ __("Shop Address") }}</th>
                                                            <td>{{ $data->shop_address }}</td>
                                                        </tr>
                                                        
                                                        </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <div class="table-responsive show-table">
                                                    <table class="table">

                                                        <tr>
                                                            <th>{{ __("Message") }}</th>
                                                            <td>{{ $data->shop_message }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>{{ __("Total Product(s)") }}</th>
                                                            <td>{{ $data->products()->count() }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>{{ __("Joined") }}</th>
                                                            <td>{{ $data->created_at->diffForHumans() }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>{{ __("Current Balance") }}</th>
                                                            <td>{{ App\Models\Product::vendorConvertPrice(Auth::user()->current_balance) }}</td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th width="35%">{{ __("Shop Details") }}</th>
                                                            <td>{!! $data->shop_details !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                    @if($data->checkStatus())
                                                                    <a class="badge badge-success verify-link" href="javascript:;">Verified</a>
                                                                    <a class="set-gallery1" href="javascript:;" data-toggle="modal" data-target="#setgallery"><input type="hidden" value="{{ $data->verifies()->where('status','=','Verified')->first()->id }}">(View)</a>
                                                                    @else 
                                                                    <a class="badge badge-danger verify-link" href="javascript:;">Unverified</a>
                                                                    @endif
                                                            </td>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                        </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="order-table-wrap">
                                                <div class="order-details-table">
                                                    <div class="mr-table">
                                                        <h4 class="title">{{ __("Products Added") }}</h4>
                                                        <div class="table-responsive">
                                                                <table id="example2" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>{{ __("Product ID") }}</th>
                                                                            <th>{{ __("Type") }}</th>
                                                                            <th>{{ __("Stock") }}</th>
                                                                            <th>{{ __("Price") }}</th>
                                                                            <th>{{ __("Status") }}</th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($data->products as $dt)
                                                                        <tr>
                                                                        <td><a href="{{ route('front.product', $dt->slug) }}" target="_blank">{{ sprintf("%'.08d",$dt->id) }}</a></td>
                                                                            <td>{{ $dt->type }}</td>
                                                                            @php 
                                                                            $stck = (string)$dt->stock;
                                                                            if($stck == "0")
                                                                            $stck = "Out Of Stock";
                                                                            elseif($stck == null)
                                                                            $stck = "Unlimited";
                                                                            @endphp
                                                                            <td>{{ $stck  }}</td>
                                                                            <td>{{  App\Models\Product::convertPrice($dt->price) }}</td>
                                                                            <td>
                                                                                <div class="action-list">
                                                                                <select class="process select droplinks {{ $dt->status == 1 ? 'drop-success' : 'drop-danger' }}">
                                                                                    <option data-val="1" value="{{ route('admin-prod-status',['id1' => $data->id, 'id2' => 1]) }}" {{ $dt->status == 1 ? 'selected' : '' }}>{{ __("Activated") }}</option>
                                                                                    <<option data-val="0" value="{{ route('admin-prod-status',['id1' => $data->id, 'id2' => 0]) }}" {{ $dt->status == 0 ? 'selected' : '' }}>{{ __("Deactivated") }}</option>
                                                                                </select>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <a href=" {{ route('admin-prod-edit',$dt->id) }}" class="view-details">
                                                                                    <i class="fas fa-eye"></i>{{ __("Details") }}
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


{{-- GALLERY MODAL --}}

<div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Attachments') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">

                    <div class="top-area">
                            <div class="row">
                                <div class="col-sm-12 d-inline-block">

                                        <h5> Details: <small id="detail"></small></h5>
                                </div>

                            </div>
                        </div>

				<div class="gallery-images">
					<div class="selected-image">
						<div class="row">


						</div>
					</div>
				</div>
			</div>


			</div>
		</div>
	</div>


{{-- GALLERY MODAL ENDS --}}


@endsection

@section('scripts')

<script type="text/javascript">
$('#example2').dataTable( {
  "ordering": false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false,
      'responsive'  : true
} );
</script>

<script type="text/javascript">
	
	// Gallery Section Update
	
	
		$(document).on("click", ".set-gallery1" , function(){
			var pid = $(this).find('input[type=hidden]').val();
			$('#pid').val(pid);
			$('.selected-image .row').html('');
				$.ajax({
						type: "GET",
						url:"{{ route('admin-vr-show') }}",
						data:{id:pid},
						success:function(data){
                        $('#detail').html(data[2]);
						  if(data[0] == 0)
						  {
							$('.selected-image .row').addClass('justify-content-center');
							  $('.selected-image .row').html('<h3>{{ __("No Images Found.") }}</h3>');
						   }
						  else {
							$('.selected-image .row').removeClass('justify-content-center');
							  $('.selected-image .row h3').remove();      
							  var arr = $.map(data[1], function(el) {
							  return el });
	
							  for(var k in arr)
							  {
							$('.selected-image .row').append('<div class="col-sm-6">'+
											'<div class="img gallery-img">'+
												'<a class="img-popup" href="'+'{{asset('assets/images/attachments').'/'}}'+arr[k]+'">'+
												'<img  src="'+'{{asset('assets/images/attachments').'/'}}'+arr[k]+'" alt="gallery image">'+
												'</a>'+
											'</div>'+
										  '</div>');
							  }                         
						   }
	 
							$('.img-popup').magnificPopup({
							type: 'image'
						  });
	
						 $(document).off('focusin');
	
						}
	
	
					  });
		  });
	
	

	
	// Gallery Section Update Ends	
	
	</script>

@endsection

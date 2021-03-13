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
								<h4 class="title">{{ $langg->lang900 }}</h4>
							</div>
							<div class="mr-table allproduct message-area  mt-4">
								@include('includes.form-success')
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>														
														<th>{{ $langg->lang359 }}</th>
														<th>{{ $langg->lang360 }}</th>
														<th>{{ $langg->lang361 }}</th>
													</tr>
												</thead>
												<tbody>
                        @foreach($notifs as $notif)
                          <tr class="conv">
                            
                            <input type="hidden" value="{{$notif->id}}">                            
                            <td>{!!$notif->message!!}</td>
                            <td>{{$notif->created_at->diffForHumans()}}</td>
                            <td>                              
                              <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete" data-href="{{route('user.notif.remove',$notif->id)}}" class="link remove"><i class="fa fa-trash"></i></a>
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
        <h4 class="modal-title d-inline-block">{{ $langg->lang367 }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
                <div class="modal-body">
            <p class="text-center">{{ $langg->lang901 }}</p>
            <p class="text-center">{{ $langg->lang369 }}</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ $langg->lang370 }}</button>
                    <button type="button" class="btn btn-danger btn-ok">{{ $langg->lang371 }}</button>
                </div>
            </div>
        </div>
    </div>
 
@endsection

@section('scripts')

<script type="text/javascript">
  var sel_tr = null;
      $(document).on('click', 'a[data-href]', function() {
        sel_tr = $(this).parents('tr');
      });
      $(document).on('click', '.btn-ok', function() {
        $.get( $(this).data('href') , function( data ) {
          if(data == 1) {
            if(example_datatable)
              example_datatable.row( sel_tr ).remove().draw();            
          } else {
            alert('Invalid Token');
          }
          $('#confirm-delete').modal('hide');
        });
      });
      $('#confirm-delete').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').data('href', $(e.relatedTarget).data('href'));          
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
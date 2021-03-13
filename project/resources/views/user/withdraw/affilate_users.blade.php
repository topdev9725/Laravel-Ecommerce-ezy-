@extends('layouts.front')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/plugins/jstree/dist/themes/default/style.min.css')}}"/>
<style>
    .edit-info-area h5{
        font-size: 20px;
        line-height: 25px;
        font-weight: 600;
        color: #143250;
        margin-top: 15px;
    }
    .edit-info-area label{font-weight: 600;}

    @media only screen and (max-width: 767px) { 
        .user-dashbord .user-profile-details .account-info {
            padding: 10px;
        }

        .jstree-default-responsive .jstree-last .jstree-node {
            margin-left: 24px !important;
        }

        .jstree-default-responsive .jstree-icon, .jstree-default-responsive .jstree-icon:empty {
            width: 26px !important;
        }
    }
</style>
@endsection
@section('content')      

<section class="user-dashbord">
    <div class="container">
        <div class="row">
            @include('includes.user-dashboard-sidebar')
            <div class="col-lg-8">
                <div class="user-profile-details">
                    <div class="account-info shadow-no-border">
                        <div class="header-area">
                            <h4 class="title">
                                {{ __('Affiliate Users') }}
                            </h4>
                        </div>
                        <div class="edit-info-area">       
                            <h5>{{__('Super User')}}</h5>
                            @if(isset($sup_user))
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-3"><label>{{__('Name')}}</label></div>
                                <div class="col-lg-9 col-md-9 col-9">{{$sup_user->name}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-3"><label>{{__('Email')}}</label></div>
                                <div class="col-lg-9 col-md-9 col-9">{{$sup_user->email}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-3"><label>{{__('Affiliate Link')}}</label></div>
                                <div class="col-lg-9 col-md-9 col-9" style="word-break: break-all">{{url('/').'/?reff='.$sup_user->affilate_code}}</div>
                            </div>
                            @else
                            <p><b>{{__('System')}}</b></p>
                            @endif
                            <h5>{{__('Sub Users')}}</h5>
                            <div class="table-responsiv">
                                <div id="tree" class="p-3"><div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="{{asset('assets/admin/plugins/jstree/dist/jstree.min.js')}}"></script>
<script type="text/javascript">

  $(document).ready(function() {
    if ($(window).width() < 800){
      $('#ezy-header').css('display', 'none');
      $('#ezy-footer').css('display', 'none');
      $('#user-profile-mobile-header').css('display', 'flex');
    }
  });
  
    $("#tree").jstree({
		"core" : {
			"themes" : {
				"responsive": true
			}, 
			// so that create works
			"check_callback" : true,
			'data' : {
				'url' : function (node) {
					return "{{route('user-affilate-get-users')}}";
				},
				'data' : function (node) {
					return { 'parent' : node.id };
				}
			}
		},
		"types" : {
			"default" : {
				"icon" : "fas fa-users icon-lg"
			},
			"file" : {
				"icon" : "fas fa-user icon-lg"
			}
		},
		"state" : { "key" : "demo3" },
		"plugins" : [ "state", "types" ]
	});
</script>


@endsection
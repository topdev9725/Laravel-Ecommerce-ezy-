@extends('layouts.admin') 
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/plugins/jstree/dist/themes/default/style.min.css')}}"/>
@endsection
@section('content')  
					<input type="hidden" id="headerdata" value="{{ __('Affiliate Users') }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __('Affiliate Users') }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
											</li>											
											<li>
												<a href="{{ route('affiliate-users-index') }}">{{ __('Affiliate Users') }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div id="tree" class="p-3"><div>
						</div>
					</div>

@endsection    



@section('scripts')
<script src="{{asset('assets/admin/plugins/jstree/dist/jstree.min.js')}}"></script>
<script type="text/javascript">
	$("#tree").jstree({
		"core" : {
			"themes" : {
				"responsive": true
			}, 
			// so that create works
			"check_callback" : true,
			'data' : {
				'url' : function (node) {
					return "{{route('get-affiliate-users')}}";
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
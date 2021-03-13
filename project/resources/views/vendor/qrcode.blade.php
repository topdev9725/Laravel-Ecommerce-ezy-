@extends('layouts.vendor')
@section('styles')
	<style>
		.social-links-area svg{max-width: 100%;}
	</style>
@endsection
@section('content')

<div class="content-area">
	<div class="mr-breadcrumb">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="heading">{{  __('QR Code for Pay') }}</h4>
				<ul class="links">
					<li>
						<a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
					</li>
					<li>
						<a href="javascript:;">{{ $langg->lang452 }}</a>
					</li>
					<li>
						<a href="{{ route('vendor-qrcode') }}">{{ __('QR Code for Pay') }}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="social-links-area">
		@php
		$file_name = 'img-'.$time.'.png';
		$path = public_path('assets/images/qrcode/'.$file_name);
		$assets_path = asset('assets/images/qrcode/'.$file_name);
		@endphp
		{!! QrCode::size(300)->format('png')->generate(route('user-scanpay-index', $vendor->id), $path) !!}
		<img src="{{$assets_path}}"/>
	</div>
	<div class="text-right" style="margin:20px 10px;">
		<a href="{{$assets_path}}" class="btn btn-primary ezy-order-btn" style="background-color: #1f224f;border-color: #1f224f;" download>Download</a>
	</div>
</div>

@endsection

	<option value="">
		<!-- {{ $langg->lang157 }} -->
		Select States
	</option>
	@if(Auth::check())
		@foreach (DB::table('provinces')->get() as $data)
			@if(Session::has('shipping_state'))
				<option value="{{ $data->province_name }}" {{ Session::get('shipping_state') == $data->province_name ? 'selected' : '' }}>{{ $data->province_name }}</option>	
			@else
				<option value="{{ $data->province_name }}" {{ Auth::user()->state == $data->province_name ? 'selected' : '' }}>{{ $data->province_name }}</option>	
			@endif
		@endforeach
	@else
		@foreach (DB::table('provinces')->get() as $data)
			<option value="{{ $data->province_name }}">{{ $data->province_name }}</option>		
		@endforeach
	@endif
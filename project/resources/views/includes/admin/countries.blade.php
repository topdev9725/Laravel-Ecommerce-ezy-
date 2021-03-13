
	<option value="">{{ __('Select Country') }}</option>

	@foreach (DB::table('countries')->get() as $cdata)
		<option value="{{ $cdata->country_name }}" {{ $data->country == $cdata->country_name ? 'selected' : '' }}>{{ $cdata->country_name }}</option>		
	@endforeach
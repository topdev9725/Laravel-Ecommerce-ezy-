		<a class="clear">{{ __('Low Quantity Product(s).') }}
			@if(count($datas) > 0)
			<span id="product-notf-clear" class="clear-notf" data-href="{{ route('product-notf-clear') }}">
				{{ __('Clear All') }}
			</span>
			@endif
		</a>
		@if(count($datas) > 0)
		<ul>
		@foreach($datas as $data)
			<li>
				<a href="{{ route('admin-prod-edit',$data->product->id) }}"> <i class="icofont-cart"></i> {{mb_strlen($data->product->name,'utf-8') > 30 ? mb_substr($data->product->name,0,30,'utf-8') : $data->product->name}}
					<small class="d-block notf-stock">{{ __('Stock') }} : {{$data->product->stock}}</small>
					<small class="d-block notf-time ">{{ $data->created_at->diffForHumans() }}</small>
				</a>
			</li>
		@endforeach

		</ul>

		@else 

		<a class="clear" href="javascript:;">
			{{ __('No New Notifications.') }}
		</a>

		@endif
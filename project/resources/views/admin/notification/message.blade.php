		<a class="clear">{{ __('New Conversation(s).') }}
			@if(count($datas) > 0)
			<span id="conv-notf-clear" class="clear-notf" data-href="{{ route('conv-notf-clear') }}">
				{{ __('Clear All') }}
			</span>
			@endif
		</a>
		@if(count($datas) > 0)

		<ul>
		@foreach($datas as $data)
			<li>
				<a href="{{ route('admin-message-show',$data->conversation_id) }}">
					 <i class="fas fa-envelope"></i> {{ __('You Have a New Message.') }}
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
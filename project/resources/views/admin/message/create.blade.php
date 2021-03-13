@extends('layouts.admin')

@section('content')

<div class="content-area">
<div class="mr-breadcrumb">
    <div class="row">
        <div class="col-lg-12">
            @if($conv->order_number != null)
            <h4 class="heading">{{ __('Order Number') }}: {{$conv->order_number}}</h4>
            @endif
            <h4 class="heading">{{ __('Conversation with') }} {{$conv->user->name}} <a class="add-btn" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-message-index') }}">{{ __('Messages') }}</a>
                    </li>
                    <li>
                        <a href="javascript:;">{{ __('Conversations Details') }}</a>
                    </li>
                </ul>
        </div>
    </div>
</div>

<div class="order-table-wrap support-ticket-wrapper ">
                        <div class="panel panel-primary">
                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                        @include('includes.admin.form-both')  
                            <div class="panel-body" id="messages">
                                @foreach($conv->messages as $message)
                                    @if($message->user_id != null)
                                <div class="single-reply-area user">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="reply-area">
                                                <div class="left">
                                                    <p>{{ $message->message }}</p>
                                                </div>
                                                <div class="right">
                                            @if($message->conversation->user->is_provider == 1)
                                            <img class="img-circle" src="{{$message->conversation->user->photo != null ? $message->conversation->user->photo : asset('assets/images/noimage.png')}}" alt="">
                                            @else 

                                            <img class="img-circle" src="{{$message->conversation->user->photo != null ? asset('assets/images/users/'.$message->conversation->user->photo) : asset('assets/images/noimage.png')}}" alt="">

                                            @endif
                                                    <a target="_blank" class="d-block profile-btn" href="{{ route('admin-user-show',$message->conversation->user->id) }}" class="d-block">{{ __('View Profile') }}</a>
                                                    <p class="ticket-date">{{ $message->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                @else

                                <div class="single-reply-area admin">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="reply-area">
                                                <div class="left">
                                                    <img class="img-circle" src="{{ Auth::guard('admin')->user()->photo ? asset('assets/images/admins/'.Auth::guard('admin')->user()->photo ):asset('assets/images/noimage.png') }}" alt="">
                                                    <p class="ticket-date">{{ $message->created_at->diffForHumans() }}</p>
                                                </div>
                                                <div class="right">
                                                    <p>{{ $message->message }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                @endif

                                @endforeach
                            </div>
                            <div class="panel-footer">
                                <form id="messageform" action="{{route('admin-message-store')}}" data-href="{{ route('admin-message-load',$conv->id) }}" method="POST">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <input type="hidden" name="conversation_id" value="{{$conv->id}}">
                                        <textarea class="form-control" name="message" id="wrong-invoice" rows="5" required="" placeholder="{{ __('Message') }}"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="mybtn1">
                                            {{ __('Add Reply') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

</div>
@endsection

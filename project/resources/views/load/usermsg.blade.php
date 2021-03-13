                      @foreach($conv->messages as $message)
                        @if($message->sent_user != null)

                        <div class="single-reply-area admin">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="reply-area">
                                        <div class="left">
                                            @if($message->conversation->sent->is_provider == 1 )
                                            <img class="img-circle" src="{{ $message->conversation->sent->photo != null ? $message->conversation->sent->photo : asset('assets/images/noimage.png') }}" alt="">
                                            @else 
                                            <img class="img-circle" src="{{ $message->conversation->sent->photo != null ? asset('assets/images/users/'.$message->conversation->sent->photo) : asset('assets/images/noimage.png') }}" alt="">
                                            @endif
                                            <p class="ticket-date">{{ $message->conversation->sent->name }}</p>
                                        </div>
                                        <div class="right">
                                            <p>{{ $message->message }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <br>
                        @else

                        <div class="single-reply-area user">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="reply-area">
                                        <div class="left">
                                            <p>{{ $message->message }}</p>
                                        </div>
                                        <div class="right">
                                            @if($message->conversation->recieved->is_provider == 1 )
                                            <img class="img-circle" src="{{ $message->conversation->recieved->photo != null ? $message->conversation->recieved->photo : asset('assets/images/noimage.png') }}" alt="">
                                            @else 
                                            <img class="img-circle" src="{{ $message->conversation->recieved->photo != null ? asset('assets/images/users/'.$message->conversation->recieved->photo) : asset('assets/images/noimage.png') }}" alt="">
                                            @endif
                                            <p class="ticket-date">{{$message->conversation->recieved->name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <br>
                        @endif
                        @endforeach
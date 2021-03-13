                  <ul class="all-replay" id="product-reviews">
                    @foreach($productt->ratings as $review)
                    <li>
                      <div class="single-review">
                        <div class="left-area">
                          <img src="{{ $review->user->photo ? asset('assets/images/users/'.$review->user->photo):asset('assets/images/noimage.png') }}" alt="">
                          <h5 class="name">{{$review->user->name}}</h5>
                          <p class="date">{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $review->review_date)->diffForHumans()}}</p>
                        </div>
                        <div class="right-area">
                          <div class="header-area">
                            <div class="stars-area">
                              <ul class="stars">
                                <div class="ratings">
                                  <div class="empty-stars"></div>
                                  <div class="full-stars" style="width:{{$review->rating*20}}%"></div>
                                </div>
                              </ul>
                            </div>
                          </div>
                          <div class="review-body">
                            <p>
                              {{$review->review}}
                            </p>
                          </div>
                        </div>
                      </div>
                  </li>
                    @endforeach
                  </ul>
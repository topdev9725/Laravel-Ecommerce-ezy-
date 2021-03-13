@extends('layouts.front')

@section('content')

<div class="breadcrumb-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="pages">

          <li><a href="{{route('front.index')}}">{{ $langg->lang17 }}</a></li>
          <li><a href="{{route('front.category',$productt->category->slug)}}">{{$productt->category->name}}</a></li>
          @if($productt->subcategory_id != null)
          <li><a
              href="{{ route('front.subcat',['slug1' => $productt->category->slug, 'slug2' => $productt->subcategory->slug]) }}">{{$productt->subcategory->name}}</a>
          </li>
          @endif
          @if($productt->childcategory_id != null)
          <li><a
              href="{{ route('front.childcat',['slug1' => $productt->category->slug, 'slug2' => $productt->subcategory->slug, 'slug3' => $productt->childcategory->slug]) }}">{{$productt->childcategory->name}}</a>
          </li>
          @endif
          <li><a href="{{ route('front.product', $productt->slug) }}">{{ $productt->name }}</a>

        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Product Details Area Start -->
<section class="product-details-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-9">
          <div class="row">
              <div class="col-lg-5 col-md-12">
                <div class="xzoom-container">
                    <img class="xzoom5" id="xzoom-magnific" src="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}" xoriginal="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}" />
                    <div class="xzoom-thumbs">

                      <div class="all-slider">

                          <a href="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}">
                        <img class="xzoom-gallery5" width="80" src="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}" title="The description goes here">
                          </a>

                      @foreach($productt->galleries as $gal)


                          <a href="{{asset('assets/images/galleries/'.$gal->photo)}}">
                        <img class="xzoom-gallery5" width="80" src="{{asset('assets/images/galleries/'.$gal->photo)}}" title="The description goes here">
                          </a>

                      @endforeach

                      </div>

                    </div>
                </div>
              </div>

              <div class="col-lg-7">
                <div class="right-area">
                  <div class="product-info">
                    <h4 class="product-name">{{ $productt->name }}</h4>
                    <div class="info-meta-1">
                      <ul>

                        @if($productt->type == 'Physical')
                          @if($productt->emptyStock())
                          <li class="product-outstook">
                            <p>
                              <i class="icofont-close-circled"></i>
                              {{ $langg->lang78 }}
                            </p>
                          </li>
                          @else
                          <li class="product-isstook">
                            <p>
                              <i class="icofont-check-circled"></i>
                              {{ $gs->show_stock == 0 ? '' : $productt->stock }} {{ $langg->lang79 }}
                            </p>
                          </li>
                          @endif
                        @endif
                        <li>
                          <div class="ratings">
                            <div class="empty-stars"></div>
                            <div class="full-stars" style="width:{{App\Models\Rating::ratings($productt->id)}}%"></div>
                          </div>
                        </li>
                        <li class="review-count">
                          <p>{{count($productt->ratings)}} {{ $langg->lang80 }}</p>
                        </li>
                      @if($productt->product_condition != 0)
                        <li>
                          <div class="{{ $productt->product_condition == 2 ? 'mybadge' : 'mybadge1' }}">
                            {{ $productt->product_condition == 2 ? 'New' : 'Used' }}
                          </div>
                        </li>
                      @endif
                      </ul>
                    </div>



              <div class="product-price">
                <p class="title">{{ $langg->lang87 }} :</p>
                      <p class="price"><span id="sizeprice">{{ $productt->showPrice() }}</span>
                        <small><del>{{ $productt->showPreviousPrice() }}</del></small></p>
                        <!-- @if($productt->youtube != null)
                          <a href="{{ $productt->youtube }}" class="video-play-btn mfp-iframe">
                            <i class="fas fa-play"></i>
                          </a>
                        @endif -->
                    </div>

                    <div class="info-meta-2">
                      <ul>

                        @if($productt->type == 'License')

                        @if($productt->platform != null)
                        <li>
                          <p>{{ $langg->lang82 }}: <b>{{ $productt->platform }}</b></p>
                        </li>
                        @endif

                        @if($productt->region != null)
                        <li>
                          <p>{{ $langg->lang83 }}: <b>{{ $productt->region }}</b></p>
                        </li>
                        @endif

                        @if($productt->licence_type != null)
                        <li>
                          <p>{{ $langg->lang84 }}: <b>{{ $productt->licence_type }}</b></p>
                        </li>
                        @endif

                        @endif

                      </ul>
                    </div>


                    @if(!empty($productt->size))
                    <div class="product-size">
                      <p class="title">{{ $langg->lang88 }} :</p>
                      <ul class="siz-list">
                        @php
                        $is_first = true;
                        @endphp
                        @foreach($productt->size as $key => $data1)
                        <li class="{{ $is_first ? 'active' : '' }}">
                          <span class="box">{{ $data1 }}
                            <input type="hidden" class="size" value="{{ $data1 }}">
                            <input type="hidden" class="size_qty" value="{{ $productt->size_qty[$key] }}">
                            <input type="hidden" class="size_key" value="{{$key}}">
                            <input type="hidden" class="size_price"
                              value="{{ round($productt->size_price[$key] * $curr->value,2) }}">
                          </span>
                        </li>
                        @php
                        $is_first = false;
                        @endphp
                        @endforeach
                        <li>
                      </ul>
                    </div>
                    @endif

                    <!-- @if(!empty($productt->color))
                    <div class="product-color">
                      <p class="title">{{ $langg->lang89 }} :</p>
                      <ul class="color-list">
                        @php
                        $is_first = true;
                        @endphp
                        @foreach($productt->color as $key => $data1)
                        <li class="{{ $is_first ? 'active' : '' }}">
                          <span class="box" data-color="{{ $productt->color[$key] }}" style="background-color: {{ $productt->color[$key] }}"></span>
                        </li>
                        @php
                        $is_first = false;
                        @endphp
                        @endforeach

                      </ul>
                    </div>
                    @endif -->

                    @if(!empty($productt->size))

                    <input type="hidden" id="stock" value="{{ $productt->size_qty[0] }}">
                    @else
                    @php
                    $stck = (string)$productt->stock;
                    @endphp
                    @if($stck != null)
                    <input type="hidden" id="stock" value="{{ $stck }}">
                    @elseif($productt->type != 'Physical')
                    <input type="hidden" id="stock" value="0">
                    @else
                    <input type="hidden" id="stock" value="">
                    @endif

                    @endif
                    <input type="hidden" id="product_price" value="{{ round($productt->vendorPrice() * $curr->value,2) }}">

                    <input type="hidden" id="product_id" value="{{ $productt->id }}">
                    <input type="hidden" id="curr_pos" value="{{ $gs->currency_format }}">
                    <input type="hidden" id="curr_sign" value="{{ $curr->sign }}">
                    <div class="info-meta-3">
                      <ul class="meta-list">
                        @if($productt->product_type != "affiliate")
                        <li class="d-block count {{ $productt->type == 'Physical' ? '' : 'd-none' }}">
                          <div class="qty">
                            <ul>
                              <li>
                                <span class="qtminus">
                                  <i class="icofont-minus"></i>
                                </span>
                              </li>
                              <li>
                                <span class="qttotal">1</span>
                              </li>
                              <li>
                                <span class="qtplus">
                                  <i class="icofont-plus"></i>
                                </span>
                              </li>
                            </ul>
                          </div>
                        </li>
                        @endif

                        @if (!empty($productt->attributes))
                          @php
                            $attrArr = json_decode($productt->attributes, true);
                          @endphp
                        @endif
                        @if (!empty($attrArr))
                          <div class="product-attributes my-4">
                            <div class="row">
                            @foreach ($attrArr as $attrKey => $attrVal)
                              @if (array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1)

                            <div class="col-lg-6">
                                <div class="form-group mb-2">
                                  <strong for="" class="text-capitalize">{{ str_replace("_", " ", $attrKey) }} :</strong>
                                  <div class="">
                                  @foreach ($attrVal['values'] as $optionKey => $optionVal)
                                    <div class="custom-control custom-radio">
                                      <input type="hidden" class="keys" value="">
                                      <input type="hidden" class="values" value="">
                                      <input type="radio" id="{{$attrKey}}{{ $optionKey }}" name="{{ $attrKey }}" class="custom-control-input product-attr"  data-key="{{ $attrKey }}" data-price = "{{ $attrVal['prices'][$optionKey] * $curr->value }}" value="{{ $optionVal }}" {{ $loop->first ? 'checked' : '' }}>
                                      <label class="custom-control-label" for="{{$attrKey}}{{ $optionKey }}">{{ $optionVal }}

                                      @if (!empty($attrVal['prices'][$optionKey]))
                                        +
                                        {{App\Classes\Common::formatPrice($attrVal['prices'][$optionKey])}}
                                      @endif
                                      </label>
                                    </div>
                                  @endforeach
                                  </div>
                                </div>
                            </div>
                              @endif
                            @endforeach
                            </div>
                          </div>
                        @endif

                        @if($productt->product_type == "affiliate")

                        <li class="addtocart">
                          <a href="{{ route('affiliate.product', $productt->slug) }}" target="_blank"><i
                              class="icofont-cart"></i> {{ $langg->lang251 }}</a>
                        </li>
                        @else
                        @if($productt->emptyStock())
                        <li class="addtocart">
                          <a href="javascript:;" class="cart-out-of-stock">
                            <i class="icofont-close-circled"></i>
                            {{ $langg->lang78 }}</a>
                        </li>
                        @else
                        <li class="addtocart">
                          <a href="javascript:;" id="addcrt"><i class="icofont-cart"></i>{{ $langg->lang90 }}</a>
                        </li>
                            @if($gs->is_buy_now == 1)
                            <li class="addtocart">
                              <a id="qaddcrt" href="javascript:;">
                                <i class="icofont-cart"></i>{{ $langg->lang251 }}
                              </a>
                            </li>
                            @endif
                        @endif

                        @endif

                        @if(Auth::guard('web')->check())
                        <li class="favorite">
                          <a href="javascript:;" class="add-to-wish"
                            data-href="{{ route('user-wishlist-add',$productt->id) }}"><i class="icofont-heart-alt"></i></a>
                        </li>
                        @else
                        <li class="favorite">
                          <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"><i
                              class="icofont-heart-alt"></i></a>
                        </li>
                        @endif
                        <!-- <li class="compare">
                          <a href="javascript:;" class="add-to-compare"
                            data-href="{{ route('product.compare.add',$productt->id) }}"><i class="icofont-exchange"></i></a>
                        </li> -->
                      </ul>
                    </div>
                    <div class="social-links social-sharing a2a_kit a2a_kit_size_32">
                      <ul class="link-list social-links">
                        <li>
                          <a class="facebook a2a_button_facebook" href="">
                            <i class="fab fa-facebook-f"></i>
                          </a>
                        </li>
                        <li>
                          <a class="twitter a2a_button_twitter" href="">
                            <i class="fab fa-twitter"></i>
                          </a>
                        </li>
                        <li>
                          <a class="linkedin a2a_button_linkedin" href="">
                            <i class="fab fa-linkedin-in"></i>
                          </a>
                        </li>
                        <li>
                          <a class="pinterest a2a_button_pinterest" href="">
                            <i class="fab fa-pinterest-p"></i>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <script async src="https://static.addtoany.com/menu/page.js"></script>


                    @if($productt->ship != null)
                      <p class="estimate-time">{{ $langg->lang86 }}: <b> {{ $productt->ship }}</b></p>
                    @endif
                    @if( $productt->sku != null )
                    <p class="p-sku">
                      {{ $langg->lang77 }}: <span class="idno">{{ $productt->sku }}</span>
                    </p>
                    @endif
        @if($gs->is_report)

        {{-- PRODUCT REPORT SECTION --}}

                      @if(Auth::guard('web')->check())

                      <div class="report-area">
                          <a href="javascript:;" data-toggle="modal" data-target="#report-modal"><i class="fas fa-flag"></i> {{ $langg->lang776 }}</a>
                      </div>

                      @else

                      <div class="report-area">
                          <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"><i class="fas fa-flag"></i> {{ $langg->lang776 }}</a>
                      </div>
                      @endif

        {{-- PRODUCT REPORT SECTION ENDS --}}

        @endif



                  </div>
                </div>
              </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="product-details-tab">
                      <div class="top-menu-area">
                        <ul class="tab-menu">
                          <li><a href="#tabs-1">{{ $langg->lang92 }}</a></li>
                          <li><a href="#tabs-2">{{ $langg->lang93 }}</a></li>
                          <li><a href="#tabs-3">{{ $langg->lang94 }}({{ count($productt->ratings) }})</a></li>
                          @if($gs->is_comment == 1)
                          <li><a href="#tabs-4">{{ $langg->lang95 }}(<span
                                id="comment_count">{{ count($productt->comments) }}</span>)</a></li>
                          @endif
                        </ul>
                      </div>
                      <div class="tab-content-wrapper">
                        <div id="tabs-1" class="tab-content-area">
                          <p>{!! $productt->details !!}</p>
                        </div>
                        <div id="tabs-2" class="tab-content-area">
                          <p>{!! $productt->policy !!}</p>
                        </div>
                        <div id="tabs-3" class="tab-content-area">
                          <div class="heading-area">
                            <h4 class="title">
                              {{ $langg->lang96 }}
                            </h4>
                            <div class="reating-area">
                              <div class="stars"><span id="star-rating">{{App\Models\Rating::rating($productt->id)}}</span> <i
                                  class="fas fa-star"></i></div>
                            </div>
                          </div>
                          <div id="replay-area">
                            <div id="reviews-section">
                              @if(count($productt->ratings) > 0)
                              <ul class="all-replay">
                                @foreach($productt->ratings as $review)
                                <li>
                                  <div class="single-review">
                                    <div class="left-area">
                                      <img
                                        src="{{ $review->user->photo ? asset('assets/images/users/'.$review->user->photo):asset('assets/images/noimage.png') }}"
                                        alt="">
                                      <h5 class="name">{{ $review->user->name }}</h5>
                                      <p class="date">
                                        {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$review->review_date)->diffForHumans() }}
                                      </p>
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
                                  @endforeach
                                </li>
                              </ul>
                              @else
                              <p>{{ $langg->lang97 }}</p>
                              @endif
                            </div>
                            @if(Auth::guard('web')->check())
                            <div class="review-area">
                              <h4 class="title">{{ $langg->lang98 }}</h4>
                              <div class="star-area">
                                <ul class="star-list">
                                  <li class="stars" data-val="1">
                                    <i class="fas fa-star"></i>
                                  </li>
                                  <li class="stars" data-val="2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                  </li>
                                  <li class="stars" data-val="3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                  </li>
                                  <li class="stars" data-val="4">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                  </li>
                                  <li class="stars active" data-val="5">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                  </li>
                                </ul>
                              </div>
                            </div>
                            <div class="write-comment-area">
                              <div class="gocover"
                                style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                              </div>
                              <form id="reviewform" action="{{route('front.review.submit')}}"
                                data-href="{{ route('front.reviews',$productt->id) }}" method="POST">
                                @include('includes.admin.form-both')
                                {{ csrf_field() }}
                                <input type="hidden" id="rating" name="rating" value="5">
                                <input type="hidden" name="user_id" value="{{Auth::guard('web')->user()->id}}">
                                <input type="hidden" name="product_id" value="{{$productt->id}}">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <textarea name="review" placeholder="{{ $langg->lang99 }}" required=""></textarea>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-12">
                                    <button class="submit-btn" type="submit">{{ $langg->lang100 }}</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                            @else
                            <div class="row">
                              <div class="col-lg-12">
                                <br>
                                <h5 class="text-center"><a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"
                                    class="btn login-btn mr-1">{{ $langg->lang101 }}</a> {{ $langg->lang102 }}</h5>
                                <br>
                              </div>
                            </div>
                            @endif
                          </div>
                        </div>
                        @if($gs->is_comment == 1)
                        <div id="tabs-4" class="tab-content-area">
                          <div id="comment-area">

                            @include('includes.comment-replies')

                          </div>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
            </div>
      </div>
      <div class="col-lg-3">

        @if(!empty($productt->whole_sell_qty))
        <div class="table-area wholesell-details-page">
          <h3>{{ $langg->lang770 }}</h3>
          <table class="table">
            <tr>
              <th>{{ $langg->lang768 }}</th>
              <th>{{ $langg->lang769 }}</th>
            </tr>
            @foreach($productt->whole_sell_qty as $key => $data1)
            <tr>
              <td>{{ $productt->whole_sell_qty[$key] }}+</td>
              <td>{{ $productt->whole_sell_discount[$key] }}% {{ $langg->lang771 }}</td>
            </tr>
            @endforeach
          </table>
        </div>
        @endif


        <div class="seller-info mt-3">
          <div class="content">
            <h4 class="title">
              {{ $langg->lang246 }}
            </h4>

            <p class="stor-name">
            @if( $productt->user_id  != 0)
                @if(isset($productt->user))
                  {{ $productt->user->shop_name }}

                  @if($productt->user->checkStatus())
                  <br>
                  <a class="verify-link" href="javascript:;"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang783 }}">
                    {{--  {{ $langg->lang783 }}  --}}
                    <i class="fas fa-check-circle"></i>
                  
                  </a>
                  @endif

                @else
                  {{ $langg->lang247 }}
                @endif
            @else
                {{ App\Models\Admin::find(1)->shop_name }}
            @endif
            </p>

            <div class="total-product">

            @if( $productt->user_id  != 0)
                <p>{{ App\Models\Product::where('user_id','=',$productt->user_id)->get()->count() }}</p>
            @else
                <p>{{ App\Models\Product::where('user_id','=',0)->get()->count() }}</p>
            @endif
              <span>{{ $langg->lang248 }}</span>
            </div>
          </div>
        @if( $productt->user_id  != 0)
            <a href="{{ route('front.vendor', [str_replace(' ', '-', $productt->user->shop_name), $productt->user->id, $store_type]) }}" class="view-stor">{{ $langg->lang249 }}</a>
        @endif

                    {{-- CONTACT SELLER --}}



                    <div class="contact-seller">

                      {{-- If The Product Belongs To A Vendor --}}

                      @if($productt->user_id != 0)


                      <ul class="list">


                        @if(Auth::guard('web')->check())

                        <li>

                          @if(
                          Auth::guard('web')->user()->favorites()->where('vendor_id','=',$productt->user->id)->get()->count() >
                          0)

                          <a  class="view-stor" href="javascript:;">
                            <i class="icofont-check"></i>
                            {{ $langg->lang225 }}
                          </a>

                          @else

                          <a class="favorite-prod view-stor"
                            data-href="{{ route('user-favorite',['data1' => Auth::guard('web')->user()->id, 'data2' => $productt->user->id, $store_type]) }}"
                            href="javascript:;">
                            <i class="icofont-plus"></i>
                            {{ $langg->lang224 }}
                          </a>


                          @endif

                        </li>

                        <li>
                          <a  class="view-stor" href="javascript:;" data-toggle="modal" data-target="#vendorform1">
                            <i class="icofont-ui-chat"></i>
                            {{ $langg->lang81 }}
                          </a>
                        </li>
                        @else

                        <li>

                          <a  class="view-stor" href="javascript:;" data-toggle="modal" data-target="#comment-log-reg">
                            <i class="icofont-plus"></i>
                            {{ $langg->lang224 }}
                          </a>


                        </li>

                        <li>

                          <a  class="view-stor" href="javascript:;" data-toggle="modal" data-target="#comment-log-reg">
                            <i class="icofont-ui-chat"></i>
                            {{ $langg->lang81 }}
                          </a>
                        </li>

                        @endif

                      </ul>


                      {{-- VENDOR PART ENDS HERE :) --}}
                      @else


                      {{-- If The Product Belongs To Admin  --}}

                      <ul class="list">
                        @if(Auth::guard('web')->check())
                        <li>
                          <a class="view-stor"  href="javascript:;" data-toggle="modal" data-target="#vendorform">
                            <i class="icofont-ui-chat"></i>
                            {{ $langg->lang81 }}
                          </a>
                        </li>
                        @else
                        <li>
                          <a class="view-stor" href="javascript:;" data-toggle="modal" data-target="#comment-log-reg">
                            <i class="icofont-ui-chat"></i>
                            {{ $langg->lang81 }}
                          </a>
                        </li>

                        @endif

                      </ul>

                      @endif

                    </div>

                    {{-- CONTACT SELLER ENDS --}}

        </div>








        <div class="categori  mt-30">
          <div class="section-top">
              <h2 class="section-title">
                  {{ $langg->lang245 }}
              </h2>
          </div>
                          <div class="hot-and-new-item-slider">

                            @foreach($vendors->chunk(3) as $chunk)
                              <div class="item-slide">
                                <ul class="item-list">
                                  @foreach($chunk as $prod)
                                    @include('includes.product.sellers-product')
                                  @endforeach
                                </ul>
                              </div>
                            @endforeach

                          </div>

      </div>
    </div>
  </div>

  <!-- Trending Item Area Start -->
  <div class="trending">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 remove-padding">
          <div class="section-top">
            <h2 class="section-title">
              {{ $langg->lang216 }}
            </h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 remove-padding">
          <div class="trending-item-slider">
            @foreach($productt->category->products()->where('status','=',1)->where('id','!=',$productt->id)->take(8)->get()
            as $prod)
            @include('includes.product.slider-product')
            @endforeach
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- Tranding Item Area End -->
</section>
<!-- Product Details Area End -->



{{-- MESSAGE MODAL --}}
<div class="message-modal">
  <div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="vendorformLabel">{{ $langg->lang118 }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid p-0">
            <div class="row">
              <div class="col-md-12">
                <div class="contact-form">
                  <form id="emailreply1">
                    {{csrf_field()}}
                    <ul>
                      <li>
                        <input type="text" class="input-field" id="subj1" name="subject"
                          placeholder="{{ $langg->lang119}}" required="">
                      </li>
                      <li>
                        <textarea class="input-field textarea" name="message" id="msg1"
                          placeholder="{{ $langg->lang120 }}" required=""></textarea>
                      </li>
                      <input type="hidden"  name="type" value="Ticket">
                    </ul>
                    <button class="submit-btn" id="emlsub" type="submit">{{ $langg->lang118 }}</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- MESSAGE MODAL ENDS --}}


  @if(Auth::guard('web')->check())

  @if($productt->user_id != 0)

  {{-- MESSAGE VENDOR MODAL --}}


  <div class="modal" id="vendorform1" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="vendorformLabel1">{{ $langg->lang118 }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid p-0">
            <div class="row">
              <div class="col-md-12">
                <div class="contact-form">
                  <form id="emailreply">
                    {{csrf_field()}}
                    <ul>

                      <li>
                        <input type="text" class="input-field" readonly=""
                          placeholder="Send To {{ $productt->user->shop_name }}" readonly="">
                      </li>

                      <li>
                        <input type="text" class="input-field" id="subj" name="subject"
                          placeholder="{{ $langg->lang119}}" required="">
                      </li>

                      <li>
                        <textarea class="input-field textarea" name="message" id="msg"
                          placeholder="{{ $langg->lang120 }}" required=""></textarea>
                      </li>

                      <input type="hidden" name="email" value="{{ Auth::guard('web')->user()->email }}">
                      <input type="hidden" name="name" value="{{ Auth::guard('web')->user()->name }}">
                      <input type="hidden" name="user_id" value="{{ Auth::guard('web')->user()->id }}">
                      <input type="hidden" name="vendor_id" value="{{ $productt->user->id }}">

                    </ul>
                    <button class="submit-btn" id="emlsub1" type="submit">{{ $langg->lang118 }}</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  {{-- MESSAGE VENDOR MODAL ENDS --}}


  @endif

  @endif

</div>


@if($gs->is_report)

@if(Auth::check())

{{-- REPORT MODAL SECTION --}}

<div class="modal fade" id="report-modal" tabindex="-1" role="dialog" aria-labelledby="report-modal-Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

 <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>

                    <div class="login-area">
                        <div class="header-area forgot-passwor-area">
                            <h4 class="title">{{ $langg->lang777 }}</h4>
                            <p class="text">{{ $langg->lang778 }}</p>
                        </div>
                        <div class="login-form">

                            <form id="reportform" action="{{ route('product.report') }}" method="POST">

                              @include('includes.admin.form-login')

                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="product_id" value="{{ $productt->id }}">
                                <div class="form-input">
                                    <input type="text" name="title" class="User Name" placeholder="{{ $langg->lang779 }}" required="">
                                    <i class="icofont-notepad"></i>
                                </div>

                                <div class="form-input">
                                  <textarea name="note" class="User Name" placeholder="{{ $langg->lang780 }}" required=""></textarea>
                                </div>

                                <button type="submit" class="submit-btn">{{ $langg->lang196 }}</button>
                            </form>
                        </div>
                    </div>
      </div>
    </div>
  </div>
</div>

{{-- REPORT MODAL SECTION ENDS --}}

@endif

@endif

@endsection


@section('scripts')

<script type="text/javascript">

  $(document).on("submit", "#emailreply1", function () {
    var token = $(this).find('input[name=_token]').val();
    var subject = $(this).find('input[name=subject]').val();
    var message = $(this).find('textarea[name=message]').val();
    var $type  = $(this).find('input[name=type]').val();
    $('#subj1').prop('disabled', true);
    $('#msg1').prop('disabled', true);
    $('#emlsub').prop('disabled', true);
    $.ajax({
      type: 'post',
      url: "{{URL::to('/user/admin/user/send/message')}}",
      data: {
        '_token': token,
        'subject': subject,
        'message': message,
        'type'   : $type
      },
      success: function (data) {
        $('#subj1').prop('disabled', false);
        $('#msg1').prop('disabled', false);
        $('#subj1').val('');
        $('#msg1').val('');
        $('#emlsub').prop('disabled', false);
        if(data == 0)
          toastr.error("Oops Something Goes Wrong !!");
        else
          toastr.success("Message Sent !!");
        $('.close').click();
      }

    });
    return false;
  });

</script>


<script type="text/javascript">

  $(document).on("submit", "#emailreply", function () {
    var token = $(this).find('input[name=_token]').val();
    var subject = $(this).find('input[name=subject]').val();
    var message = $(this).find('textarea[name=message]').val();
    var email = $(this).find('input[name=email]').val();
    var name = $(this).find('input[name=name]').val();
    var user_id = $(this).find('input[name=user_id]').val();
    var vendor_id = $(this).find('input[name=vendor_id]').val();
    $('#subj').prop('disabled', true);
    $('#msg').prop('disabled', true);
    $('#emlsub').prop('disabled', true);
    $.ajax({
      type: 'post',
      url: "{{URL::to('/vendor/contact')}}",
      data: {
        '_token': token,
        'subject': subject,
        'message': message,
        'email': email,
        'name': name,
        'user_id': user_id,
        'vendor_id': vendor_id
      },
      success: function () {
        $('#subj').prop('disabled', false);
        $('#msg').prop('disabled', false);
        $('#subj').val('');
        $('#msg').val('');
        $('#emlsub').prop('disabled', false);
        toastr.success("{{ $langg->message_sent }}");
        $('.ti-close').click();
      }
    });
    return false;
  });

</script>

@endsection

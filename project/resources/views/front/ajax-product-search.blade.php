            @if(count($search_results) != 0)
                @foreach($search_results as $search_result)
                <div class="col-lg-3 col-md-6 decrease-padding">
                    <div class="single-box" style="padding:15px">
                        <div class="left-area">
                            <img src="{{ $search_result->thumbnail ? asset('assets/images/thumbnails/'.$search_result->thumbnail):asset('assets/images/noimage.png') }}" alt="">
                        </div>
                        <div class="right-area">
                            @php
                                $category_id = App\Models\Product::where('id', '=', $search_result->id)->first()->category_id;
                                $store_type = App\Models\Category::where('id', '=', $category_id)->first()->store_type;
                            @endphp
                            <h4 class="text-capitalize" style="font-size:16px!important"><a href="{{ route('front.product1',$search_result->slug).'?store_type='.$store_type }}">{{ strlen($search_result->name) > 65 ? substr($search_result->name,0,65).'...' : $search_result->name }}</a></h4>
                            <h4 class="price">{{ App\Models\Product::convertPrice($search_result->price) }} <del>{{ App\Models\Product::convertPrice($search_result->previous_price) }}</del> </h4>
                            <div class="stars">
                                <div class="ratings">
                                    <div class="empty-stars"></div>
                                    <div class="full-stars" style="width:{{App\Models\Rating::ratings($search_result->id)}}%"></div>
                                </div>
                            </div>
                            @php
                                $shop_name = App\Models\User::where('id', '=', $search_result->user_id)->first()->shop_name;
                            @endphp
                            <p class="text" style="margin:12px 0px!important"><a href="{{ route('front.vendor',str_replace(' ', '-', $shop_name)).'?vendor_id='.$search_result->user_id.'&&store_type='.$store_type }}">Shop Name: {{ strlen($shop_name) > 65 ? substr($shop_name,0,65).'...' : $shop_name }}</a></p>

                            <ul class="action-meta">
                                <li>
                                    <span href="javascript:;" class="cart-btn quick-view add-to-cart1"  id="addcrt1" data-toggle="tooltip"
                                        data-placement="top" data-value="{{ $search_result->id }}" title="Add To Cart" style="background:#ff7024!important">
                                        <i class="icofont-cart"></i>
                                    </span>
                                    <input type="hidden" name="price" value="{{ $search_result->price }}">
                                </li>
                                <li>
                                    <span  class="cart-btn quick-view" rel-toggle="tooltip" title="{{ $langg->lang55 }}" href="javascript:;" data-href="{{ route('product.quick',$search_result->id) }}" data-toggle="modal" data-target="#quickview" data-placement="top" style="background:#ff7024!important">
                                            <i class="fas fa-shopping-basket"></i>
                                    </span>
                                </li>
                                <li>
                                    @if(Auth::guard('web')->check())
        
                                    <span href="javascript:;" class="wish add-to-wish"
                                        data-href="{{ route('user-wishlist-add',$search_result->id) }}" data-toggle="tooltip"
                                        data-placement="top" title="{{ $langg->lang54 }}" style="background:#ff7024!important"><i class="far fa-heart"></i>
                                    </span>
        
                                    @else
        
                                    <span href="javascript:;" class="wish" rel-toggle="tooltip" title="{{ $langg->lang54 }}"
                                        data-toggle="modal" id="wish-btn" data-target="#comment-log-reg"
                                        data-placement="top" style="background:#ff7024!important">
                                        <i class="far fa-heart"></i>
                                    </span>
        
                                    @endif
                                </li>
                            </ul>	
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p style="margin-left:20px!important">No products found</p>
            @endif
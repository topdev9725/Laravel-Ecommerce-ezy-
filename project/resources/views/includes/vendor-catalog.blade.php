<div class="col-lg-3 col-md-6 ezy-product-category">
          <div class="left-area">
            <div class="filter-result-area ezy-desktop-product-category-list">
            <div class="header-area">
              <h4 class="title">
                <!-- {{$langg->lang61}} -->
                Category
              </h4>
            </div>
            <div class="body-area">
                <ul class="filter-list">
                  @foreach ($product_categories as $element)
                  <li>
                    <div class="content">
                      <a href="javascript:product_show('{{$vendor->id}}', '{{$element->id}}', {{$store_type}})" class="category-link"> <i class="fa fa-link"></i> {{$element->name}}</a>
                      <div id="{{$vendor->id.'_'.$element->id}}" style="display: none">

                        @foreach ($sub_categories as $sub_element)
                          @if($sub_element->category_id == $element->id && !empty(App\Models\Product::where('category_id', $element->id)->where('subcategory_id', $sub_element->id)->first()))
                          <div class="sub-content open">
                            <a href="javascript:subproduct_show('{{$vendor->id}}', '{{$element->id}}', '{{$sub_element->id}}', {{$store_type}})" class="subcategory-link"><i class="fas fa-angle-right"></i>{{$sub_element->name}}</a>
                            <div id="{{$vendor->id.'_'.$element->id.'_'.$sub_element->id}}" style="display: none">
                              @foreach ($child_categories as $child_element)
                                @if($child_element->subcategory_id == $sub_element->id)
                                  <div class="child-content open">
                                    <a href="javascript:childproduct_show('{{$vendor->id}}', '{{$element->id}}', '{{$sub_element->id}}', '{{$child_element->id}}', {{$store_type}})" class="subcategory-link"><i class="fas fa-caret-right"></i>{{$child_element->name}}</a>
                                  </div>
                                @endif
                              @endforeach
                            </div>
                          </div>
                          @endif
                        @endforeach

                      </div>
                    </div>
                  </li>
                  @endforeach

                  <!-- @foreach ($categories as $element)
                  <li>
                    <div class="content">
                        <a href="{{route('front.category', $element->slug)}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="category-link"> <i class="fas fa-angle-double-right"></i> {{$element->name}}</a>
                        @if(!empty($cat) && $cat->id == $element->id && !empty($cat->subs))
                            @foreach ($cat->subs as $key => $subelement)
                            <div class="sub-content open">
                              <a href="{{route('front.category', [$cat->slug, $subelement->slug])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="subcategory-link"><i class="fas fa-angle-right"></i>{{$subelement->name}}</a>
                              @if(!empty($subcat) && $subcat->id == $subelement->id && !empty($subcat->childs))
                                @foreach ($subcat->childs as $key => $childcat)
                                <div class="child-content open">
                                  <a href="{{route('front.category', [$cat->slug, $subcat->slug, $childcat->slug])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="subcategory-link"><i class="fas fa-caret-right"></i>{{$childcat->name}}</a>
                                </div>
                                @endforeach
                              @endif
                            </div>
                            @endforeach

                          </div>
                        @endif
                  </li>
                  @endforeach -->
                </ul>

              <form class="price-range-block" id="priceForm">
                @if (!empty(request()->input('sort')))
                  <input type="hidden" name="sort" value="{{ request()->input('sort') }}" />0
                @endif
                <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                <div class="livecount">
                  <input type="number" min=0  name="min"  id="min_price" class="price-range-field" />
                  <span>{{$langg->lang62}}</span>
                  <input type="number" min=0  name="max" id="max_price" class="price-range-field" />
                  <input type="hidden" name="category_id" id="category_id" value="">
                  <input type="hidden" name="subcategory_id" id="subcategory_id" value="">
                  <input type="hidden" name="childcategory_id" id="childcategory_id" value="">
                  <input type="hidden" name="store_type" id="store_type" value="{{ $store_type }}">
                  <input type="hidden" name="vendor_id" id="vendor_id" value="{{ $vendor->id }}">
                </div>
              </form>

                <button class="filter-btn btn btn-primary" type="submit" onclick="filter_product_show()">{{$langg->lang58}}</button>
            </div>
            </div>


            @if ((!empty($cat) && !empty(json_decode($cat->attributes, true))) || (!empty($subcat) && !empty(json_decode($subcat->attributes, true))) || (!empty($childcat) && !empty(json_decode($childcat->attributes, true))))

              <div class="tags-area">
                <div class="header-area">
                  <h4 class="title">
                      Filters
                  </h4>
                </div>
                <div class="body-area">
                  <form id="attrForm" action="{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}" method="post">
                    <ul class="filter">
                      <div class="single-filter">
                        @if (!empty($cat) && !empty(json_decode($cat->attributes, true)))
                          @foreach ($cat->attributes as $key => $attr)
                            <div>
                              <strong>{{$attr->name}}</strong>
                            </div>
                            @if (!empty($attr->attribute_options))
                              @foreach ($attr->attribute_options as $key => $option)
                                <div class="form-check">
                                  <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                                  <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                                </div>
                              @endforeach
                            @endif
                          @endforeach
                        @endif

                        @if (!empty($subcat) && !empty(json_decode($subcat->attributes, true)))
                          @foreach ($subcat->attributes as $key => $attr)
                            <div>
                              <strong>{{$attr->name}}</strong>
                            </div>
                            @if (!empty($attr->attribute_options))
                              @foreach ($attr->attribute_options as $key => $option)
                                <div class="form-check">
                                  <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                                  <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                                </div>
                              @endforeach
                            @endif
                          @endforeach
                        @endif

                        @if (!empty($childcat) && !empty(json_decode($childcat->attributes, true)))
                          @foreach ($childcat->attributes as $key => $attr)
                            <div>
                              <strong>{{$attr->name}}</strong>
                            </div>
                            @if (!empty($attr->attribute_options))
                              @foreach ($attr->attribute_options as $key => $option)
                                <div class="form-check">
                                  <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                                  <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                                </div>
                              @endforeach
                            @endif
                          @endforeach
                        @endif
                      </div>
                    </ul>
                  </form>
                </div>
              </div>
            @endif


            @if(!isset($vendor))

            {{-- <div class="tags-area">
                <div class="header-area">
                    <h4 class="title">
                        {{$langg->lang63}}
                    </h4>
                  </div>
                  <div class="body-area">
                    <ul class="taglist">
                      @foreach(App\Models\Product::showTags() as $tag)
                      @if(!empty($tag))
                      <li>
                        <a class="{{ isset($tags) ? ($tag == $tags ? 'active' : '') : ''}}" href="{{ route('front.tag',$tag) }}">
                            {{ $tag }}
                        </a>
                      </li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
            </div> --}}


            @else

            <div class="service-center">
              <div class="header-area">
                <h4 class="title">
                    <!-- {{ $langg->lang227 }} -->
                    Contact Us
                </h4>
              </div>
              <div class="body-area">
                <ul class="list">
                  <li style="padding-bottom: 15px;">
                      <a href="javascript:;" data-toggle="modal" data-target="{{ Auth::guard('web')->check() ? '#vendorform1' : '#comment-log-reg' }}">
                          <!-- <i class="icofont-email"></i> <span class="service-text"> {{ $langg->lang228 }}</span> -->
                          <i class="icofont-email"></i> <span class="service-text"> {{$vendor->email}}</span>
                      </a>
                  </li>
                  <li style="padding-bottom: 15px;">
                        <a href="tel:+{{$vendor->shop_number}}">
                          <!-- <i class="icofont-brand-whatsapp"></i> <span class="service-text"> {{$vendor->shop_number}}</span> -->
                          <i class="icofont-brand-whatsapp"></i> <span class="service-text"> {{$vendor->phone}} </span>
                        </a>
                  </li>
                  <li style="padding-bottom: 15px;">
                        <a href="tel:+{{$vendor->shop_number}}">
                          <i class="icofont-clock-time"></i> <span class="service-text"> {{$vendor->opening_hours}}</span>
                        </a>
                  </li>
                  <li style="padding-bottom: 15px;">
                        <a href="tel:+{{$vendor->shop_number}}">
                          <i class="icofont-address-book"></i> <span class="service-text"> {{mb_strlen($vendor->shop_address,'utf-8') > 55 ? mb_substr($vendor->shop_address,0,55,'utf-8').'...' : $vendor->shop_address}}</span>
                        </a>
                  </li>
                  <li style="text-align: center">
                        <a href="tel:+{{$vendor->shop_number}}">
                          <i class="icofont-star" style="color: #fbca39 !important"></i> <span class="service-text"></span>
                          <i class="icofont-star" style="color: #fbca39 !important"></i> <span class="service-text"></span>
                          <i class="icofont-star" style="color: #fbca39 !important"></i> <span class="service-text"></span>
                          <i class="icofont-star" style="color: #fbca39 !important"></i> <span class="service-text"></span>
                          <i class="icofont-star" style="color: #fbca39 !important"></i> <span class="service-text"></span>
                        </a>
                  </li>
                </ul>
              <!-- Modal -->
              </div>

              <div class="footer-area">
                <!-- <p class="title">
                  {{ $langg->lang229 }}
                </p> -->
                <ul class="list">


              @if($vendor->f_check != 0)
              <li><a href="{{$vendor->f_url}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
              @endif
              @if($vendor->g_check != 0)
              <li><a href="{{$vendor->g_url}}" target="_blank"><i class="fab fa-google"></i></a></li>
              @endif
              @if($vendor->t_check != 0)
              <li><a href="{{$vendor->t_url}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
              @endif
              @if($vendor->l_check != 0)
              <li><a href="{{$vendor->l_url}}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
              @endif


                </ul>
              </div>
            </div>


            @endif


          </div>
        </div>

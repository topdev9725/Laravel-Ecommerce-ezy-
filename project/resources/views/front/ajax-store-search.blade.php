			@if(count($search_results) != 0)
                @foreach($search_results as $search_result)
                <div class="col-lg-4 col-md-6 col-12 ezy-custom-responsive">
                    <div class="card ezy-custom-card1" style="margin:12px 0px!important">
                        <div class="row">
                        <div class="col-lg-5 col-md-5 col-5 ezy-responsive-store">
                            @if($search_result->online == 1 || $search_result->nearby == 1)
                            <a href="{{ route('front.vendor',str_replace(' ', '-', $search_result->shop_name)).'?vendor_id='.$search_result->id.'&&store_type=2' }}" class="banner-effect text-center">
                                <img class="ezy-store-img1" src="{{ empty($search_result->shop_logo)?asset('assets/images/vendorlogo/default_logo.jpg'):asset('assets/images/vendorlogo/'.$search_result->shop_logo) }}" alt="">
                            </a>
                            @elseif($search_result->autodebit == 1)
                                @php
                                    Session::put('shop_name', $search_result->shop_name);
                                @endphp
                                <a href="{{ route('front.autodebit') }}" class="banner-effect text-center">
                                    <img class="ezy-store-img1" src="{{ empty($search_result->shop_logo)?asset('assets/images/vendorlogo/default_autodebit_logo.jpg'):asset('assets/images/vendorlogo/'.$search_result->shop_logo) }}" alt="">
                                </a>
                            @endif
                        </div>
                        <div class="col-lg-7 col-md-7 col-7">
							<p class="ezy-store-name1 text-capitalize">{{ $search_result->shop_name }}</p>
                            @if($search_result->autodebit != 1)
                                <p class="ezy-store-product1">Address : {{ $search_result->shop_address }}</p>
                                <p style="font-weight:600;font-size:14px !important">Store Type: {{ $store_type }}</p>
                            @elseif($search_result->autodebit == 1)
                                <p class="ezy-store-product1">{{ $search_result->shop_address }}</p>
                                <p style="font-weight:600;font-size:14px !important">Store Type: Autodebit</p>
                            @endif

                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-4 text-center p-0">
                                    <i class='fas fa-star ezy-review1'>&nbsp; {{isset(Session::get('every_shop_ratings')[$search_result->id])?number_format(Session::get('every_shop_ratings')[$search_result->id],2):'0.00'}}</i>
                                </div>
                                <div class="col-lg-8 col-md-8 col-8 text-center p-0">
                                    <i class="far fa-clock ezy-distance-time1">&nbsp; {{ $search_result->opening_hours }}</i>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p style="margin-left:20px!important">No stores found</p>
            @endif
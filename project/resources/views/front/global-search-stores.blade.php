@extends('layouts.front')

@section('content')

<!-- Breadcrumb Area Start -->
  <div class="breadcrumb-area" style="background: url({{  asset('assets/images/autodebit_banner.jpg') }}) !important;background-repeat: no-repeat; background-size: cover !important;background-position:center ;padding: 0px 0px!important;">
      <div class="row" style="background-color: rgba(0,0,0,0.3)">
        <div class="col-lg-12">
            <label for="" class="text-white text-center ezy-img-letter autodebit-img-text search-img-text">Search Results</label>
        </div>

        <div class="col-lg-12 ezy-breadcrumb">
            <ul class="pages">
              <li>
                  <a href="{{route('front.index')}}" class="ezy-breadcrumb-text">{{ $langg->lang17 }}</a>
              </li>
              <li>
                  <a href="{{ route('front.autodebit') }}" class="text-white">Stores Search</a>
              </li>
            </ul>
        </div>
      </div>
  </div>

<!-- Breadcrumb Area End -->

<!-- AutoDebit Area Start -->
<section class="search-result-block">
   <div class="container">
        <div class="row">
            <div class="col-lg-12 search-result-header">
                <h3 class="text-left search-result-title">Search Results</h3>
                <ul class="filter-list text-right">
                    <li class="item-short-area">
                        <p class="d-inline">{{$langg->lang64}} :</p>
                        <form id="sortForm" class="d-inline-block">
                            <select name="sort" class="short-item" onchange="sort_store_show()" id="sort">
                                <option value="online" {{ Session::get('store_type') == 'online'?'selected':'' }}>Online Store</option>
                                <option value="nearbymerchant" {{ Session::get('store_type') == 'nearbymerchant'?'selected':'' }}>Nearby Merchant</option>
                                <option value="autodebit" {{ Session::get('store_type') == 'autodebit'?'selected':'' }}>Autodebit</option>
                            </select>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="col-lg-12" id="ajaxContent">
                @if(count($global_search_stores) != 0)
                <div class="row">
                    @foreach($global_search_stores as $global_search_store)
                    <div class="col-lg-4 col-md-6 col-12 ezy-custom-responsive">
                        <div class="card ezy-custom-card1" style="margin:12px 0px!important">
                            <div class="row">
                            <div class="col-lg-5 col-md-5 col-5 ezy-responsive-store">
                                @if($global_search_store->online == 1 || $global_search_store->nearby == 1)
                                <a href="{{ route('front.vendor',str_replace(' ', '-', $global_search_store->shop_name)).'?vendor_id='.$global_search_store->id.'&&store_type=2' }}" class="banner-effect text-center">
                                    <img class="ezy-store-img1" src="{{ empty($global_search_store->shop_logo)?asset('assets/images/vendorlogo/default_logo.jpg'):asset('assets/images/vendorlogo/'.$global_search_store->shop_logo) }}" alt="">
                                </a>
                                @elseif($global_search_store->autodebit == 1)
                                    @php
                                        Session::put('shop_name', $global_search_store->shop_name);
                                    @endphp
                                    <a href="{{ route('front.autodebit') }}" class="banner-effect text-center">
                                        <img class="ezy-store-img1" src="{{ empty($global_search_store->shop_logo)?asset('assets/images/vendorlogo/default_autodebit_logo.jpg'):asset('assets/images/vendorlogo/'.$global_search_store->shop_logo) }}" alt="">
                                    </a>
                                @endif
                            </div>
                            <div class="col-lg-7 col-md-7 col-7">
                                <p class="ezy-store-name1 text-capitalize">{{ $global_search_store->shop_name }}</p>
                                @if($global_search_store->online == 1 || $global_search_store->nearby == 1)
                                    <p class="ezy-store-product1">{{ $global_search_store->shop_address }}</p>
                                    <p style="font-weight:600;font-size:14px !important">Store Type: {{ $global_search_store->online == 1?'Online Store':'Nearby Merchant' }}</p>
                                @elseif($global_search_store->autodebit == 1)
                                    <p class="ezy-store-product1">{{ $global_search_store->shop_address }}</p>
                                    <p style="font-weight:600;font-size:14px !important">Store Type: Autodebit</p>
                                @endif

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-4 text-center p-0">
                                        <i class='fas fa-star ezy-review1'>&nbsp; 4.5</i>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-8 text-center p-0">
                                        <i class="far fa-clock ezy-distance-time1">&nbsp; {{ $global_search_store->opening_hours }}</i>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                    <p>No stores found</p>
                @endif
            </div>
        </div>
   </div>
</section>
<!-- AutoDebit Area End -->
@endsection

@section('scripts')
<script>
  function sort_store_show() {
    filter_url = '{{route('front.global.store.search')}}';
    sort = $("#sort option:selected" ).val();
    search = $("#prod_name").val();

    $.ajax({
      method: "GET",
      url: filter_url,
      data: {
        store_type: sort,
        search: search
      },
      contentType : false,
    
      success:function(data)
      {   
        $('#ajaxContent').html(data);
      }
    });
  }
</script>
@endsection
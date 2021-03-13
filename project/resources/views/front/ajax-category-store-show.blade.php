<div class="row">
  <p class="ezy-online-category-note">{{ $category_info->name }} Stores</p>
</div>
<div class="row ezy-row-nopadding" id="category_store">
  @foreach($category_stores as $category_store)
  <div class="col-lg-4 col-md-6 col-12 ezy-custom-responsive">
    <div class="card ezy-custom-card1">
      <div class="row">
        <div class="col-lg-5 col-md-5 col-5 ezy-responsive-store">
          <a href="{{ route('front.vendor', [str_replace(' ', '-', $category_store->shop_name), $category_store->id, 0, $category_info->id]) }}" class="banner-effect text-center">
            <img class="ezy-store-img1" src="{{ empty($category_store->shop_logo)?asset('assets/images/vendorlogo/default_logo.jpg'):asset('assets/images/vendorlogo/'.$category_store->shop_logo) }}" alt="">
          </a>
        </div>
        <div class="col-lg-7 col-md-7 col-7">
          <p class="ezy-store-name1">{{ $category_store->shop_name }}</p>
          <!-- @php
            $products = DB::table('products')->where('user_id', '=', $category_store->id)->take(4)->get();
            $product_names = '';
            if(count($products) != 0) {
              foreach($products as $product) {
                $product_names .= $product->name.', ';
              }
              $product_names = substr($product_names, 0, -2);
            }
          @endphp
          <p class="ezy-store-product1"><b>Products</b> : {{$product_names}}</p> -->
          <p class="ezy-store-product1">{{ $category_store->shop_address }}</p>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-4 text-center p-0">
              <i class='fas fa-star ezy-review1'>&nbsp; {{isset(Session::get('every_shop_ratings')[$category_store->id])?number_format(Session::get('every_shop_ratings')[$category_store->id],2):'0.00'}}</i>
            </div>
            <div class="col-lg-8 col-md-8 col-8 text-center p-0">
              <i class="far fa-clock ezy-distance-time1">&nbsp; {{ $category_store->opening_hours }}</i>
            </div>
            @php
              $waze = 'll='.$category_store->shop_latitude.','.$category_store->shop_longitude;
            @endphp
            <div class="col-lg-12 text-right waze">
              <a href="{{ 'waze://?'.$waze.'&navigate=yes'}}" class="waze-btn" target="_blank"><img class="waze-img" src="{{asset('assets/images/waze.png')}}" alt=""></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</divs>
        
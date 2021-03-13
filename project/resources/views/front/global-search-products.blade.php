@extends('layouts.front')

@section('styles')
<style type="text/css">
.single-box {
    height: 220px;
}

.visit-store {
    color: white !important;
    /* border-radius: 50% !important; */
    /* width: 25% !important; */
    background: #f9a531 !important;
    border-color: #f9a531 !important;
    display: inline-block;
    text-align: center;
    font-size: 12px;
    padding: 4px 12px;
    margin: 0 auto 5px;
    border: 1px solid #ff5500;
    -webkit-transition: all 0.3s ease-in;
    -o-transition: all 0.3s ease-in;
    transition: all 0.3s ease-in;
    font-weight: 600;
}
</style>
@endsection

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
                  <a href="{{ route('front.autodebit') }}" class="text-white">Products Search</a>
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
                            <select name="sort" class="short-item" onchange="sort_product_show()" id="sort">
                                <option value="date_desc">{{$langg->lang65}}</option>
                                <option value="date_asc">{{$langg->lang66}}</option>
                                <option value="price_asc">{{$langg->lang67}}</option>
                                <option value="price_desc">{{$langg->lang68}}</option>
                            </select>
                        </form>
                    </li>
                </ul>
          </div>
          <div class="col-lg-12" id="ajaxContent" style="padding-left:15px;padding-right:15px">
            @if(count($global_search_products) != 0)
            <div class="row">
                @foreach($global_search_products as $global_search_product)
                <div class="col-lg-3 col-md-6 decrease-padding">
                    <div class="single-box" style="padding:15px">
                        <div class="left-area">
                            <img src="{{ $global_search_product->thumbnail ? asset('assets/images/thumbnails/'.$global_search_product->thumbnail):asset('assets/images/noimage.png') }}" alt="">
                        </div>
                        <div class="right-area">
                            @php
                                $category_id = App\Models\Product::where('id', '=', $global_search_product->id)->first()->category_id;
                                $store_type = App\Models\Category::where('id', '=', $category_id)->first()->store_type;
                            @endphp
                            <h4 class="text-capitalize" style="font-size:16px!important"><a href="{{ route('front.product1',$global_search_product->slug).'?store_type='.$store_type }}">{{ strlen($global_search_product->name) > 65 ? substr($global_search_product->name,0,65).'...' : $global_search_product->name }}</a></h4>
                            <h4 class="price">{{ App\Models\Product::convertPrice($global_search_product->price) }} <del>{{ App\Models\Product::convertPrice($global_search_product->previous_price) }}</del> </h4>
                            <div class="stars">
                                <div class="ratings">
                                    <div class="empty-stars"></div>
                                    <div class="full-stars" style="width:{{App\Models\Rating::ratings($global_search_product->id)}}%"></div>
                                </div>
                            </div>
                            @php
                                $shop_name = App\Models\User::where('id', '=', $global_search_product->user_id)->first()->shop_name;
                            @endphp
                            <p style="margin:12px 0px!important"><a href="{{ route('front.vendor',str_replace(' ', '-', $shop_name)).'?vendor_id='.$global_search_product->user_id.'&&store_type='.$store_type }}" class="visit-store">{{ strlen($shop_name) > 65 ? substr($shop_name,0,65).'...' : $shop_name }}</a></p>

                            <ul class="action-meta">
                                <li>
                                    <span href="javascript:;" class="cart-btn quick-view add-to-cart1"  id="addcrt1" data-toggle="tooltip"
                                        data-placement="top" data-value="{{ $global_search_product->id }}" title="Add To Cart" style="background:#ff7024!important">
                                        <i class="icofont-cart"></i>
                                    </span>
                                    <input type="hidden" name="price" value="{{ $global_search_product->price }}">
                                </li>
                                <li>
                                    <span  class="cart-btn quick-view" rel-toggle="tooltip" title="{{ $langg->lang55 }}" href="javascript:;" data-href="{{ route('product.quick',$global_search_product->id) }}" data-toggle="modal" data-target="#quickview" data-placement="top" style="background:#ff7024!important">
                                            <i class="fas fa-shopping-basket"></i>
                                    </span>
                                </li>
                                <li>
                                    @if(Auth::guard('web')->check())
        
                                    <span href="javascript:;" class="wish add-to-wish"
                                        data-href="{{ route('user-wishlist-add',$global_search_product->id) }}" data-toggle="tooltip"
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
            </div>
            @else
                <p style="margin-left:20px!important">No products found</p>
            @endif
          </div>
      </div>
   </div>
</section>
<!-- AutoDebit Area End -->
@endsection

@section('scripts')
<script>
  $(document).on("click", ".add-to-cart1" , function(){
    var qty = 1;
    var pid = $(this).attr('data-value');
   
    $.ajax({
        type: "GET",
        url:mainurl+"/addnumcart",
        data:{id:pid,qty:qty,size:'',color:'',size_qty:'',size_price:'',size_key:'',keys:'',values:'',prices:''},
        success:function(data){

          if(data == 'digital') {
              toastr.error(langg.already_cart);
            }
          else if(data == 0) {
              toastr.error(langg.out_stock);
            }
          else {
            $("#cart-count").text(data[0]);
            $("#cart-items").load(mainurl+'/carts/view');
              toastr.success(langg.add_cart);
            }
        }
    });

  });

  function sort_product_show() {
    filter_url = '{{route('front.global.product.search')}}';
    sort = $("#sort option:selected").val();
    search = $("#prod_name").val();

    $.ajax({
      method: "GET",
      url: filter_url,
      data: {
        sort_type: sort,
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
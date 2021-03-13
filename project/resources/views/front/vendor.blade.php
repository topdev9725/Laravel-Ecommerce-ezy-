@extends('layouts.front')
@section('styles')
<style>
.mobile-contact-us {
  display: none;
}

@media only screen and (max-width: 350px) { 
  .ezy-img-circle {
    max-width: 50%;
  }

  .vendor-banner {
    padding: 35px 0px 25px;
  }
}

@media only screen and (max-width: 767px) { 
  .sub-categori {
    padding-top: 0px !important;
  }

  .mobile-contact-us {
    margin-top: 0px !important;
    display: initial;
  }

  .ezy-product-category {
    display: none;
  }

  .sub-categori .left-area .service-center .header-area .title {
    font-size: 20px !important;
  }

  .sub-categori .left-area .service-center .body-area {
    padding: 12px 0px;
  }

  .sub-categori .left-area .service-center .body-area .list li {
    font-size: 12px;
  }

  .sub-categori .left-area .service-center .body-area .list li i {
    font-size: 18px;
  }

  .sub-categori .left-area .service-center {
    margin-top: 0px;
  }

  .order-lg-last .right-area .page-center h4 {
    font-size: 16px;
  }

  .ezy-best-sellers {
    font-size: 18px;
  }
}
</style>
@endsection
@section('content')

<!-- Vendor Area Start -->
  <div class="vendor-banner" style="background: url({{  $vendor->shop_image != null ? asset('assets/images/vendorbanner/'.$vendor->shop_image) : '' }}); background-repeat: no-repeat; background-size: cover;background-position: center;{!! $vendor->shop_image != null ? '' : 'background-color:'.$gs->vendor_color !!} ">
    <div class="container">
      <div class="row">
        <div class="col-lg-3" style="text-align: center">
          <div class="content">
            <img src="{{ !empty($vendor->shop_logo)?asset('assets/images/vendorlogo/'.$vendor->shop_logo):asset('assets/images/vendorlogo/default_logo.jpg') }}" class="ezy-img-circle" alt="">
            <!-- <p class="sub-title">
                {{ $langg->lang226 }}
            </p> -->
            <h2 class="title">
              {{ $vendor->shop_name }}
            </h2>
          </div>
        </div>
      </div>
    </div>
  </div>


{{-- Info Area Start --}}
<section class="info-area">
  <div class="container">

        @foreach($services->chunk(4) as $chunk)

        <div class="row">

        <div class="col-lg-12 p-0">
          <div class="info-big-box">
              <div class="row">
                @foreach($chunk as $service)
              <div class="col-6 col-xl-3 p-0">
                <div class="info-box">
                  <div class="icon">
                    <img src="{{ asset('assets/images/services/'.$service->photo) }}">
                  </div>
                  <div class="info">
                      <div class="details">
                        <h4 class="title">{{ $service->title }}</h4>
                      <p class="text">
                        {!! $service->details !!}
                      </p>
                      </div>
                  </div>
                </div>
              </div>
              @endforeach
              </div>
          </div>
        </div>

        </div>

          @endforeach


        </div>
</section>
{{-- Info Area End  --}}




<!-- SubCategori Area Start -->
  <section class="sub-categori">
    <div class="container">
          <div class="col-lg-12 left-area mobile-contact-us">
            <div class="service-center">
                <div class="header-area">
                  <h4 class="title">
                      <!-- {{ $langg->lang227 }} -->
                      Contact Us
                  </h4>
                </div>
                <div class="body-area">
                  <ul class="list">
                    <li>
                        <a href="javascript:;" data-toggle="modal" data-target="{{ Auth::guard('web')->check() ? '#vendorform1' : '#comment-log-reg' }}">
                            <!-- <i class="icofont-email"></i> <span class="service-text"> {{ $langg->lang228 }}</span> -->
                            <i class="icofont-email"></i> <span class="service-text"> {{$vendor->email}}</span>
                        </a>
                    </li>
                    <li>
                          <a href="tel:+{{$vendor->shop_number}}">
                            <!-- <i class="icofont-brand-whatsapp"></i> <span class="service-text"> {{$vendor->shop_number}}</span> -->
                            <i class="icofont-brand-whatsapp"></i> <span class="service-text"> {{$vendor->phone}} </span>
                          </a>
                    </li>
                    <li>
                          <a href="tel:+{{$vendor->shop_number}}">
                            <i class="icofont-clock-time"></i> <span class="service-text"> {{$vendor->opening_hours}}</span>
                          </a>
                    </li>
                    <li>
                          <a href="tel:+{{$vendor->shop_number}}">
                            <i class="icofont-address-book"></i> <span class="service-text" style="letter-spacing: -0.5px;"> {{mb_strlen($vendor->shop_address,'utf-8') > 55 ? mb_substr($vendor->shop_address,0,55,'utf-8').'...' : $vendor->shop_address}}</span>
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
          </div>
          <!-- -------------------- responsive product category list start -------------------- -->
          <div class="d-flex align-items-center ezy-mobile-product-category-list" style="margin-bottom: 50px">
            <div class="flex-shrink-0">
                <a href="#" class="btn-left btn-link p-2 toggleLeft1"><i class="fa fa-angle-left"></i></a>
            </div>
            <div class="flex-grow-1 position-relative overflow-hidden" id="outer1">
              <ul class="nav nav-fill text-uppercase position-relative flex-nowrap" id="bar1">
                @foreach ($product_categories as $element)
                  <li class="nav-item" style="padding: 1px 10px;">
                      <a href="javascript:product_show('{{$vendor->id}}', '{{$element->id}}')" class="category-link">{{$element->name}}</a>
                  </li>
                @endforeach
              </ul>
            </div>
            <div class="flex-shrink-0">
                <a href="#" class="btn-right btn-link toggleRight1 p-2"><i class="fa fa-angle-right"></i></a>
            </div>
          </div>

          <div class="d-flex align-items-center ezy-mobile-product-category-list" style="margin-bottom: 50px">
            <div class="flex-shrink-0">
                <a href="#" class="btn-left btn-link p-2 toggleLeft"><i class="fa fa-angle-left"></i></a>
            </div>
            <div class="flex-grow-1 position-relative overflow-hidden" id="outer">
              <ul class="nav nav-fill text-uppercase position-relative flex-nowrap" id="bar">
                @foreach ($product_categories as $element)
                  @php
                    $sub_categories = DB::table('subcategories')->where('category_id', $element->id)->get();
                  @endphp
                  @foreach($sub_categories as $sub_element)
                  <li class="nav-item sub-category-{{ $element->id }}" style="padding: 1px 10px;">
                      <a href="javascript:subproduct_show('{{$vendor->id}}', '{{$element->id}}', '{{$sub_element->id}}', {{$store_type}})" class="subcategory-link">{{$sub_element->name}}</a>
                  </li>
                  @endforeach
                @endforeach
              </ul>
            </div>
            <div class="flex-shrink-0">
                <a href="#" class="btn-right btn-link toggleRight p-2"><i class="fa fa-angle-right"></i></a>
            </div>
          </div>
          <!-- ------------------ responsive product category list end -------------- -->
      <div class="row">
        @include('includes.vendor-catalog')

        <div class="col-lg-9 order-first order-lg-last">
          <div class="right-area">

            @if(count($vprods) > 0)

              @include('includes.vendor-filter')

            <div class="categori-item-area">
              {{-- <div id="ajaxContent"> --}}
                <div class="row" id="ajaxContent">     

                    @include('includes.product.product')

                </div>
                <div class="page-center category">
                  {!! $vprods->appends(['sort' => request()->input('sort'), 'min' => request()->input('min'), 'max' => request()->input('max')])->links() !!}
                </div>

                <p class="ezy-best-sellers">Best sellers you'll like</p>
                <div class="row" id="ajaxContent1">
        
                  @include('includes.product.product')

                </div>
              {{-- </div> --}}
            </div>

            @else
              <div class="page-center">
                <h4 class="text-center">{{ $langg->lang60 }}</h4>
              </div>
            @endif

          </div>
        </div>
      </div>
    </div>
  </section>
<!-- SubCategori Area End -->


@if(Auth::guard('web')->check())

{{-- MESSAGE VENDOR MODAL --}}

<div class="message-modal">
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
                      <input type="text" class="input-field" readonly="" placeholder="Send To {{ $vendor->shop_name }}" readonly="">
                    </li>

                    <li>
                      <input type="text" class="input-field" id="subj" name="subject" placeholder="{{ $langg->lang119}}" required="">
                    </li>

                    <li>
                      <textarea class="input-field textarea" name="message" id="msg" placeholder="{{ $langg->lang120 }}" required=""></textarea>
                    </li>

                    <input type="hidden" name="email" value="{{ Auth::guard('web')->user()->email }}">
                    <input type="hidden" name="name" value="{{ Auth::guard('web')->user()->name }}">
                    <input type="hidden" name="user_id" value="{{ Auth::guard('web')->user()->id }}">
                    <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">

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
</div>

{{-- MESSAGE VENDOR MODAL ENDS --}}


@endif

@endsection

@section('scripts')

<script type="text/javascript">

  function product_show(vendor_id, category_id, store_type) {

      $("#category_id").val(category_id);
      $("#" + vendor_id + '_' + category_id).slideToggle("slow");

    filter_url = '{{route('front.category.products')}}' + '?vendor_id=' + vendor_id + '&&category_id=' + category_id + '&&store_type=' + store_type;

    $.ajax({
      method: "GET",
      url: filter_url,
      contentType : false,
      cache: false,
      processData: false,
      success:function(data)
      {   
        $('#ajaxContent').html(data);   //  best sellers section
        $('#ajaxContent1').html(data);  //  product section
        $('.sub-category-' + category_id).hide();
      }
    });
  }

  function subproduct_show(vendor_id, category_id, subcategory_id, store_type) {

      $("#category_id").val(category_id);
      $("#subcategory_id").val(subcategory_id);
      $("#" + vendor_id + '_' + category_id + '_' + subcategory_id).slideToggle("slow");

    filter_url = '{{route('front.category.products')}}' + '?vendor_id=' + vendor_id + '&&category_id=' + category_id + '&&subcategory_id=' + subcategory_id + '&&store_type=' + store_type;

    $.ajax({
      method: "GET",
      url: filter_url,
      contentType : false,
      cache: false,
      processData: false,
      success:function(data)
      {   
        $('#ajaxContent').html(data);
        $('#ajaxContent1').html(data);
      }
    });
  }

  function childproduct_show(vendor_id, category_id, subcategory_id, childcategory_id, store_type) {

    $("#category_id").val(category_id);
    $("#subcategory_id").val(subcategory_id);
    $("#childcategory_id").val(childcategory_id);
    filter_url = '{{route('front.category.products')}}' + '?vendor_id=' + vendor_id + '&&category_id=' + category_id + '&&subcategory_id=' + subcategory_id + '&&childcategory_id=' + childcategory_id + '&&store_type=' + store_type;

    $.ajax({
    method: "GET",
    url: filter_url,
    contentType : false,
    cache: false,
    processData: false,
    success:function(data)
    {   
      $('#ajaxContent').html(data);
      $('#ajaxContent1').html(data);
    }
    });
  }

  function filter_product_show() {
    filter_url = '{{route('front.category.products')}}';

    $.ajax({
      method: "GET",
      url: filter_url,
      data: $("#priceForm").serialize(),
      contentType : false,
      cache: false,
      processData: false,
      success:function(data)
      {   
        $('#ajaxContent').html(data);
        $('#ajaxContent1').html(data);
      }
    });
  }

  function sort_product_show(vendor_id, store_type) {
    filter_url = '{{route('front.category.products')}}';
    category_id = $("#category_id").val();
    subcategory_id = $("#subcategory_id").val();
    childcategory_id = $("#childcategory_id").val();
    sort = $("#sort option:selected" ).val();

    $.ajax({
      method: "GET",
      url: filter_url,
      data: {
        category_id: category_id,
        subcategory_id: subcategory_id,
        childcategory_id: childcategory_id,
        sort: sort,
        store_type: store_type,
        vendor_id: vendor_id,
      },
      contentType : false,
    
      success:function(data)
      {   
        $('#ajaxContent').html(data);
        $('#ajaxContent1').html(data);
      }
    });
  }

  $(function () {
    $("#slider-range").slider({
    range: true,
    orientation: "horizontal",
    min: 0,
    max: 10000,
    values: [{{ isset($_GET['min']) ? $_GET['min'] : '0' }}, {{ isset($_GET['max']) ? $_GET['max'] : '10000' }}],
    step: 5,

    slide: function (event, ui) {
      if (ui.values[0] == ui.values[1]) {
        return false;
      }

      $("#min_price").val(ui.values[0]);
      $("#max_price").val(ui.values[1]);
    }
    });

    $("#min_price").val($("#slider-range").slider("values", 0));
    $("#max_price").val($("#slider-range").slider("values", 1));

  });
</script>

<script type="text/javascript">
          $(document).on("submit", "#emailreply" , function(){
          var token = $(this).find('input[name=_token]').val();
          var subject = $(this).find('input[name=subject]').val();
          var message =  $(this).find('textarea[name=message]').val();
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
                'subject'   : subject,
                'message'  : message,
                'email'   : email,
                'name'  : name,
                'user_id'   : user_id,
                'vendor_id'  : vendor_id
                  },
            success: function() {
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


<script type="text/javascript">
  $(document).on("click", ".add-to-cart1" , function(){
    var qty = 1;
    var pid = $(this).attr('data-value');
    // var prices = $(this).closest('li').children('input').val();
   
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
</script>
<!-- ---------------------- responsive product category list js start ------------- -->
<script type="text/javascript">
  var metrics = {};
  var scrollOffset = 0;

  var container = document.getElementById("outer");
  var bar = document.getElementById("bar");

  function setMetrics() {
      metrics = {
          bar: bar.scrollWidth||0,
          container: container.clientWidth||0,
          left: parseInt(bar.offsetLeft),
          getHidden() {
              return (this.bar+this.left)-this.container
          }
      }
      
      updateArrows();
  }

  function doSlide(direction){
      setMetrics();
      var pos = metrics.left;
      if (direction==="right") {
          amountToScroll = -(Math.abs(pos) + Math.min(metrics.getHidden(), metrics.container));
      }
      else {
          amountToScroll = Math.min(0, (metrics.container + pos));
      }
      bar.style.left = amountToScroll + "px";
      setTimeout(function(){
          setMetrics();
      },400)
  }

  function updateArrows() {
      if (metrics.getHidden() === 0) {
          document.getElementsByClassName("toggleRight")[0].classList.add("text-light");
      }
      else {
          document.getElementsByClassName("toggleRight")[0].classList.remove("text-light");
      }
      
      if (metrics.left === 0) {
          document.getElementsByClassName("toggleLeft")[0].classList.add("text-light");
      }
      else {
          document.getElementsByClassName("toggleLeft")[0].classList.remove("text-light");
      }
  }

  function adjust(){
      bar.style.left = 0;
      setMetrics();
  }

  document.getElementsByClassName("toggleRight")[0].addEventListener("click", function(e){
      e.preventDefault()
      doSlide("right")
  });

  document.getElementsByClassName("toggleLeft")[0].addEventListener("click", function(e){
      e.preventDefault()
      doSlide("left")
  });

  window.addEventListener("resize",function(){
      // reset to left pos 0 on window resize
      adjust();
  });

  setMetrics();

</script>

<script type="text/javascript">
  var metrics1 = {};
  var scrollOffset1 = 0;

  var container1 = document.getElementById("outer1");
  var bar1 = document.getElementById("bar1");

  function setMetrics1() {
      metrics1 = {
          bar1: bar1.scrollWidth||0,
          container1: container1.clientWidth||0,
          left1: parseInt(bar1.offsetLeft),
          getHidden() {
              return (this.bar1+this.left1)-this.container1
          }
      }
      
      updateArrows1();
  }

  function doSlide1(direction){
      setMetrics1();
      var pos = metrics1.left1;
      if (direction==="right") {
          amountToScroll = -(Math.abs(pos) + Math.min(metrics1.getHidden(), metrics1.container1));
      }
      else {
          amountToScroll = Math.min(0, (metrics1.container1 + pos));
      }
      bar1.style.left = amountToScroll + "px";
      setTimeout(function(){
          setMetrics1();
      },400)
  }

  function updateArrows1() {
      if (metrics1.getHidden() === 0) {
          document.getElementsByClassName("toggleRight1")[0].classList.add("text-light");
      }
      else {
          document.getElementsByClassName("toggleRight1")[0].classList.remove("text-light");
      }
      
      if (metrics1.left1 === 0) {
          document.getElementsByClassName("toggleLeft1")[0].classList.add("text-light");
      }
      else {
          document.getElementsByClassName("toggleLeft1")[0].classList.remove("text-light");
      }
  }

  function adjust1(){
      bar1.style.left = 0;
      setMetrics1();
  }

  document.getElementsByClassName("toggleRight1")[0].addEventListener("click", function(e){
      e.preventDefault()
      doSlide1("right")
  });

  document.getElementsByClassName("toggleLeft1")[0].addEventListener("click", function(e){
      e.preventDefault()
      doSlide1("left")
  });

  window.addEventListener("resize",function(){
      // reset to left pos 0 on window resize
      adjust1();
  });

  setMetrics1();

</script>
<!-- ---------------------- responsive product category list js end ------------- -->

@endsection

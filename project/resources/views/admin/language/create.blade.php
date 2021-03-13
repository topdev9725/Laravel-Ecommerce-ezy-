@extends('layouts.admin')




@section('content')

<div class="content-area">
  <div class="mr-breadcrumb">
    <div class="row">
      <div class="col-lg-12">
        <h4 class="heading">{{ __('Add Language') }} <a class="add-btn" href="{{route('admin-lang-index')}}"><i
              class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
        <ul class="links">
          <li>
            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
          </li>
          <li><a href="javascript:;">{{ __('Language Settings') }}</a></li>
          <li>
            <a href="{{ route('admin-lang-index') }}">{{ __('Website Language') }} </a>
          </li>
          <li>
            <a href="{{ route('admin-lang-create') }}">{{ __('Add Language') }}</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="add-product-content">
    <div class="row">
      <div class="col-lg-12">
        <div class="product-description">
          <div class="body-area" id="modalEdit">
            <div class="gocover"
              style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
            </div>
            <form id="geniusform" action="{{route('admin-lang-create')}}" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
              @include('includes.admin.form-both')

              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                    <h4 class="heading">{{ __('Language') }} *</h4>
                    <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" name="language" placeholder="{{ __('English') }}" required=""
                    value="English">
                </div>
              </div>


              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                    <h4 class="heading">{{ __('Language Direction') }} *</h4>
                    <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                  </div>
                </div>
                <div class="col-lg-7">
                  <select name="rtl" class="input-field" required="">
                    <option value="0">{{ __('Left To Right') }}</option>
                    <option value="1">{{ __('Right To Left') }}</option>
                  </select>
                </div>
              </div>


              <div class="row add_lan_tab justify-content-center">
                <div class="col-lg-10">
                  <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                        role="tab" aria-controls="nav-home" aria-selected="true">{{ __('Website') }}</a>
                      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                        aria-controls="nav-profile" aria-selected="false">{{ __('User Panel') }}</a>
                      <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab"
                        aria-controls="nav-about" aria-selected="false">{{ __('Vendor Panel') }}</a>
                    </div>
                  </nav>
                  <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

                    {{-- FRONTEND STARTS --}}

                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">


                      <hr>

                      <h4 class="text-center">HEADER</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Track Order *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang16" placeholder="Track Order" required=""
                            value="Track Order">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">My Account *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang11" placeholder="My Account" required=""
                            value="My Account">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">User Panel *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang221" placeholder="User Panel" required=""
                            value="User Panel">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Vendor Panel *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang222" placeholder="Profile" required=""
                            value="Vendor Panel">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Logout *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang223" placeholder="Logout" required=""
                            value="Logout">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Sign in *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang12" placeholder="Sign in" required=""
                            value="Sign in">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Join *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang13" placeholder="Join" required=""
                            value="Join">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Sell *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang220" placeholder="Sell" required=""
                            value="Sell">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Featured Links *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang831" placeholder="Featured Links" required=""
                            value="Featured Links">
                        </div>
                      </div>



                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">All Categories *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang1" placeholder="All Categories" required=""
                            value="All Categories">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Search For Product *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang2" placeholder="Search For Product"
                            required="" value="Search For Product">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Cart *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang3" placeholder="Cart" required=""
                            value="Cart">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Item(s) *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang4" placeholder="Item(s)" required=""
                            value="Item(s)">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">View Cart *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang5" placeholder="View Cart" required=""
                            value="View Cart">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Total *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang6" placeholder="Total " required=""
                            value="Total">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Checkout *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang7" placeholder="Checkout" required=""
                            value="Checkout">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Cart is empty. *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang8" placeholder="Cart is empty." required=""
                            value="Cart is empty.">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Wish *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang9" placeholder="Wish" required=""
                            value="Wish">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Compare *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang10" placeholder="Compare" required=""
                            value="Compare">
                        </div>
                      </div>



                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Categories *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang14" placeholder="Categories" required=""
                            value="Categories">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">See All Categories *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang15" placeholder="See All Categories" required=""
                            value="See All Categories">
                        </div>
                      </div>




                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Home *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang17" placeholder="Home" required=""
                            value="Home">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Blog *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang18" placeholder="Blog" required=""
                            value="Blog">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Faq *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang19" placeholder="Faq" required=""
                            value="Faq">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Contact Us *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang20" placeholder="Contact Us" required=""
                            value="Contact Us">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">HOME</h4>

                      <hr>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shop Now *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang25" placeholder="Shop Now" required=""
                            value="Shop Now">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Featured *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang26" placeholder="Featured" required=""
                            value="Featured">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Popular Products *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang832" placeholder="Popular Products" required="" value="Popular Products">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Best Seller *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang27" placeholder="Best Seller" required=""
                            value="Best Seller">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Flash Deal *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang244" placeholder="Flash Deal" required=""
                            value="Flash Deal">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Top Rated *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang28" placeholder="Top Rated" required=""
                            value="Top Rated">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Big Save *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang29" placeholder="Big Save" required=""
                            value="Big Save">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Hot *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang30" placeholder="Hot" required=""
                            value="Hot">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">New *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang31" placeholder="New" required=""
                            value="New">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Trending *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang32" placeholder="Trending" required=""
                            value="Trending">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Sale *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang33" placeholder="Sale" required=""
                            value="Sale">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Read More *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang34" placeholder="Read More" required=""
                            value="Read More">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Brands *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang236" placeholder="Brands" required=""
                            value="Brands">
                        </div>
                      </div>

                      <hr>

                      <h4 class="text-center">BLOG</h4>

                      <hr>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Tag *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang35" placeholder="Tag" required=""
                            value="Tag">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Search *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang36" placeholder="Search" required=""
                            value="Search">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Archive *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang37" placeholder="Archive" required=""
                            value="Archive">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Read More *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang38" placeholder="Read More" required=""
                            value="Read More">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Blog Details *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang39" placeholder="Blog Details" required=""
                            value="Blog Details">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">View(s) *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang40" placeholder="View(s)" required=""
                            value="View(s)">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Source *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang41" placeholder="Source" required=""
                            value="Source">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Search *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang46" placeholder="Search" required=""
                            value="Search">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Categories *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang42" placeholder="Categories" required=""
                            value="Categories">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Recent Post *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang43" placeholder="Recent Post" required=""
                            value="Recent Post">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Archives *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang44" placeholder="Archives" required=""
                            value="Archives">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Tags *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang45" placeholder="Tags" required=""
                            value="Tags">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">CONTACT US</h4>

                      <hr>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang47" placeholder="Name" required=""
                            value="Name">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Phone Number *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang48" placeholder="Phone Number" required=""
                            value="Phone Number">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Email Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang49" placeholder="Email Address" required=""
                            value="Email Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Your Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang50" placeholder="Your Message" required=""
                            value="Your Message">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Enter Code *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang51" placeholder="Enter Code" required=""
                            value="Enter Code">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Send Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang52" placeholder="Send Message" required=""
                            value="Send Message">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Find Us Here *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang53" placeholder="Find Us Here" required=""
                            value="Find Us Here">
                        </div>
                      </div>

                      <hr>

                      <h4 class="text-center">PRODUCT ADD CART</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add To Wishlist *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang54" placeholder="Find Us Here" required=""
                            value="Add To Wishlist">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Quick View *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang55" placeholder="Quick View" required=""
                            value="Quick View">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add To Cart *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang56" placeholder="Add To Cart" required=""
                            value="Add To Cart">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Compare *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang57" placeholder="Compare" required=""
                            value="Compare">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Buy Now *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang251" placeholder="Buy Now" required=""
                            value="Buy Now">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">PRODUCT CATALOG</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Search *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang58" placeholder="Search" required=""
                            value="Search">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Tag *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang59" placeholder="Tag" required=""
                            value="Tag">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">No Product Found *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang60" placeholder="No Product Found"
                            required="" value="No Product Found.">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Filter Results By *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang61" placeholder="Filter Results By"
                            required="" value="Filter Results By">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">To *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang62" placeholder="To" required="" value="To">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Popular Tags *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang63" placeholder="Popular Tags" required=""
                            value="Popular Tags">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Sort By *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang64" placeholder="Sort By" required=""
                            value="Sort By">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Latest Product *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang65" placeholder="Latest Product" required=""
                            value="Latest Product">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Oldest Product *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang66" placeholder="Oldest Product" required=""
                            value="Oldest Product">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Lowest Price *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang67" placeholder="Lowest Price" required=""
                            value="Lowest Price">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Highest Price *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang68" placeholder="Highest Price" required=""
                            value="Highest Price">
                        </div>
                      </div>

                      <hr>

                      <h4 class="text-center">PRODUCT COMPARE</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Compare *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang69" placeholder="Compare" required=""
                            value="Compare">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Product Compare *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang70" placeholder="Product Compare" required=""
                            value="Product Compare">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Product Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang71" placeholder="Product Name" required=""
                            value="Product Name">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Price *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang72" placeholder="Price" required=""
                            value="Price">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Rating *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang73" placeholder="Rating" required=""
                            value="Rating">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Description *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang74" placeholder="Description" required=""
                            value="Description">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add To Cart *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang75" placeholder="Add To Cart" required=""
                            value="Add To Cart">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Remove *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang76" placeholder="Remove" required=""
                            value="Remove">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">PRODUCT DETAILS</h4>

                      <hr>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Product SKU *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang77" placeholder="Product SKU" required=""
                            value="Product SKU">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Out Of Stock *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang78" placeholder="Out Of Stock" required=""
                            value="Out Of Stock">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">In Stock *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang79" placeholder="In Stock" required=""
                            value="In Stock">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Review(s) *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang80" placeholder="Review(s)" required=""
                            value="Review(s)">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add To Favorite Seller *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang224" placeholder="Add To Favorite Seller"
                            required="" value="Add To Favorite Seller">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Favorite *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang225" placeholder="Favorite" required=""
                            value="Favorite">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Contact Seller *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang81" placeholder="Contact Seller" required=""
                            value="Contact Seller">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Platform *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang82" placeholder="Platform" required=""
                            value="Platform">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Region *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang83" placeholder="Region" required=""
                            value="Region">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">License Type *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang84" placeholder="License Type" required=""
                            value="License Type">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Product Condition *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang85" placeholder="Product Condition"
                            required="" value="Product Condition">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Watch Video *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang219" placeholder="Watch Video" required=""
                            value="Watch Video">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Estimated Shipping Time *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang86" placeholder="Estimated Shipping Time"
                            required="" value="Estimated Shipping Time">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Price *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang87" placeholder="Price" required=""
                            value="Price">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Size *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang88" placeholder="Size" required=""
                            value="Size">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Color *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang89" placeholder="Color" required=""
                            value="Color">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add to Cart *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang90" placeholder="Add to Cart" required=""
                            value="Add to Cart">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">SHARE *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang91" placeholder="SHARE" required=""
                            value="SHARE">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">DESCRIPTION *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang92" placeholder="DESCRIPTION" required=""
                            value="DESCRIPTION">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">BUY & RETURN POLICY *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang93" placeholder="BUY & RETURN POLICY"
                            required="" value="BUY & RETURN POLICY">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Reviews *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang94" placeholder="Reviews" required=""
                            value="Reviews">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Comment *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang95" placeholder="Comment" required=""
                            value="Comment">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Ratings & Reviews *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang96" placeholder="Ratings & Reviews"
                            required="" value="Ratings & Reviews">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">No Review Found. *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang97" placeholder="No Review Found."
                            required="" value="No Review Found.">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Review *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang98" placeholder="Review" required=""
                            value="Review">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Your Review *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang99" placeholder="Your Review" required=""
                            value="Your Review">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">SUBMIT *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang100" placeholder="SUBMIT" required=""
                            value="SUBMIT">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Login *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang101" placeholder="Login" required=""
                            value="Login">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">To Review *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang102" placeholder="To Review" required=""
                            value="To Review">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">To Comment *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang103" placeholder="To Comment" required=""
                            value="To Comment">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Write Comment *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang104" placeholder="Write Comment" required=""
                            value="Write Comment">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Write Your Comments Here... *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang105"
                            placeholder="Write Your Comments Here..." required="" value="Write Your Comments Here...">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Post Comment *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang106" placeholder="Post Comment" required=""
                            value="Post Comment">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Reply *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang107" placeholder="Reply" required=""
                            value="Reply">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">View *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang108" placeholder="View" required=""
                            value="View">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Reply *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang109" placeholder="Reply" required=""
                            value="Reply">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Replies *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang110" placeholder="Replies" required=""
                            value="Replies">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Edit *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang111" placeholder="Edit" required=""
                            value="Edit">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Delete *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang112" placeholder="Delete" required=""
                            value="Delete">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Edit Your Comment *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang113" placeholder="Edit Your Comment"
                            required="" value="Edit Your Comment">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Submit *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang114" placeholder="Submit" required=""
                            value="Submit">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Cancel *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang115" placeholder="Cancel" required=""
                            value="Cancel">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Edit Your Reply *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang116" placeholder="Edit Your Reply"
                            required="" value="Edit Your Reply">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Write your reply *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang117" placeholder="Write your reply"
                            required="" value="Write your reply">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Send Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang118" placeholder="Send Message" required=""
                            value="Send Message">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Subject *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang119" placeholder="Subject *" required=""
                            value="Subject *">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Your Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang120" placeholder="Your Message " required=""
                            value="Your Message ">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Product Quick View *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang199" placeholder="Product Quick View"
                            required="" value="Product Quick View">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Related Products *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang216" placeholder="Related Products"
                            required="" value="Related Products">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Seller's Products *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang245" placeholder="Seller's Products"
                            required="" value="Seller's Products">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Sold By *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang246" placeholder="Sold By" required=""
                            value="Sold By">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">No Vendor Found *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang247" placeholder="No Vendor Found"
                            required="" value="No Vendor Found">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Total Item *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang248" placeholder="Total Item" required=""
                            value="Total Item">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Visit Store *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang249" placeholder="Visit Store" required=""
                            value="Visit Store">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Wholesell *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang770" placeholder="Wholesell" required=""
                            value="Wholesell">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Quantity *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang768" placeholder="Quantity" required=""
                            value="Quantity">
                        </div>
                      </div>




                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Discount *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang769" placeholder="Discount" required=""
                            value="Discount">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Off *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang771" placeholder="Off" required=""
                            value="Off">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Report This Item *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang776" placeholder="Report This Item" required=""
                            value="Report This Item">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">REPORT PRODUCT *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang777" placeholder="REPORT PRODUCT" required=""
                            value="REPORT PRODUCT">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Please give the following details *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang778" placeholder="Please give the following details" required="" value="Please give the following details">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Enter Report Title *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang779" placeholder="Enter Report Title" required=""
                            value="Enter Report Title">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Enter Report Note *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang780" placeholder="Enter Report Note" required=""
                            value="Enter Report Note">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Verified *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang783" placeholder="Verified" required="" value="Verified">
                        </div>
                      </div>



                      <hr>

                      <h4 class="text-center">CART</h4>

                      <hr>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Cart *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang121" placeholder="Cart " required=""
                            value="Cart">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Product Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang122" placeholder="Product Name " required=""
                            value="Product Name">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Size & Color *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang123" placeholder="Size & Color" required=""
                            value="Size & Color">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Quantity *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang124" placeholder="Quantity " required=""
                            value="Quantity">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Unit Price *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang125" placeholder="Unit Price " required=""
                            value="Unit Price">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Sub Total *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang126" placeholder="Sub Total " required=""
                            value="Sub Total">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">PRICE DETAILS *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang127" placeholder="PRICE DETAILS " required=""
                            value="PRICE DETAILS">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Total MRP *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang128" placeholder="Total MRP " required=""
                            value="Total MRP">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Discount *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang129" placeholder="Discount" required=""
                            value="Discount">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Tax *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang130" placeholder="Your Message " required=""
                            value="Tax">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Total *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang131" placeholder="Total " required=""
                            value="Total">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Have a promotion code? *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang132" placeholder="Have a promotion code?"
                            required="" value="Have a promotion code?">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Coupon Code *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang133" placeholder="Coupon Code" required=""
                            value="Coupon Code">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Apply *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang134" placeholder="Apply" required=""
                            value="Apply">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Place Order *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang135" placeholder="Place Order" required=""
                            value="Place Order">
                        </div>
                      </div>

                      <hr>

                      <h4 class="text-center">CHECKOUT</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Checkout *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang136" placeholder="Checkout" required=""
                            value="Checkout">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Product Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang137" placeholder="Product Name" required=""
                            value="Product Name">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Size *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang138" placeholder="Size" required=""
                            value="Size">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Color *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang139" placeholder="Color" required=""
                            value="Color">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Quantity *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang140" placeholder="Quantity" required=""
                            value="Quantity">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Unit Price *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang141" placeholder="Unit Price" required=""
                            value="Unit Price">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Sub Total *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang142" placeholder="Sub Total" required=""
                            value="Sub Total">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shipping Cost *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang143" placeholder="Shipping Cost" required=""
                            value="Shipping Cost">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Tax *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang144" placeholder="Tax" required=""
                            value="Tax">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Discount *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang145" placeholder="Discount" required=""
                            value="Discount">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Total *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang146" placeholder="Total" required=""
                            value="Total">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Billing Details *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang147" placeholder="Billing Details"
                            required="" value="Billing Details">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shipping Details *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang148" placeholder="Shipping Details"
                            required="" value="Shipping Details">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Ship To Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang149" placeholder="Ship To Address"
                            required="" value="Ship To Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Pick Up *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang150" placeholder="Pick Up" required=""
                            value="Pick Up">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Pickup Location *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang151" placeholder="Pickup Location"
                            required="" value="Pickup Location">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Full Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang152" placeholder="Full Name" required=""
                            value="Full Name">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Phone Number *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang153" placeholder="Phone Number" required=""
                            value="Phone Number">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Email *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang154" placeholder="Email" required=""
                            value="Email">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang155" placeholder="Address" required=""
                            value="Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Country *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang156" placeholder="Country" required=""
                            value="Country">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Select Country *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang157" placeholder="Select Country" required=""
                            value="Select Country">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">City *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang158" placeholder="City" required=""
                            value="City">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Postal Code *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang159" placeholder="Postal Code" required=""
                            value="Postal Code">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Ship to a Different Address? *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang160"
                            placeholder="Ship to a Different Address?" required="" value="Ship to a Different Address?">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Payment Information *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang161" placeholder="Payment Information"
                            required="" value="Payment Information">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Order Note *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang217" placeholder="Order Note" required=""
                            value="Order Note">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Optional *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang218" placeholder="Optional" required=""
                            value="Optional">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Order Now *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang162" placeholder="Order Now" required=""
                            value="Order Now">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Card Number *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang163" placeholder="Card Number" required=""
                            value="Card Number">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Cvv *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang164" placeholder="Cvv" required=""
                            value="Cvv">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Month *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang165" placeholder="Month" required=""
                            value="Month">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Year e.g. 19 *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang166" placeholder="Year e.g. 19" required=""
                            value="Year e.g. 19">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Card Code *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang807" placeholder="Card Code" required=""
                            value="Card Code">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Year e.g. 2038 *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang808" placeholder="Year e.g. 2038" required=""
                            value="Year e.g. 2038">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Transaction ID# *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang167" placeholder="Transaction ID#"
                            required="" value="Transaction ID#">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang743" placeholder="Address" required=""
                            value="Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Orders *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang744" placeholder="Orders" required=""
                            value="Orders">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Payment *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang745" placeholder="Payment" required=""
                            value="Payment">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Personal Information *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang746" placeholder="Personal Information"
                            required="" value="Personal Information">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Enter Your Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang747" placeholder="Enter Your Name"
                            required="" value="Enter Your Name">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Enter Your Email *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang748" placeholder="Enter Your Email"
                            required="" value="Enter Your Email">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Create an account ? *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang749" placeholder="Create an account ?"
                            required="" value="Create an account ?">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Enter Your Password *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang750" placeholder="Enter Your Password"
                            required="" value="Enter Your Password">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Confirm Your Password *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang751" placeholder="Confirm Your Password"
                            required="" value="Confirm Your Password">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shipping Details *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang752" placeholder="Shipping Details"
                            required="" value="Shipping Details">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Continue *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang753" placeholder="Continue" required=""
                            value="Continue">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Price *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang754" placeholder="Price" required=""
                            value="Price">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Quantity *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang755" placeholder="Quantity" required=""
                            value="Quantity">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Total Price *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang756" placeholder="Total Price" required=""
                            value="Total Price">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Back *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang757" placeholder="Back" required=""
                            value="Back">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shipping Info *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang758" placeholder="Shipping Info" required=""
                            value="Shipping Info">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Payment Info *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang759" placeholder="Payment Info" required=""
                            value="Payment Info">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">PayPal Express *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang760" placeholder="PayPal Express" required=""
                            value="PayPal Express">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Credit Card *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang761" placeholder="Credit Card" required=""
                            value="Credit Card">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Cash On Delivery *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang762" placeholder="Cash On Delivery"
                            required="" value="Cash On Delivery">
                        </div>
                      </div>



                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Instamojo *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang763" placeholder="Instamojo" required=""
                            value="Instamojo">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Paytm *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="paytm" placeholder="Paytm" required=""
                            value="Paytm">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Razorpay *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="razorpay" placeholder="Razorpay" required=""
                            value="Razorpay">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Paystack *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang764" placeholder="Paystack" required=""
                            value="Paystack">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Mollie Payment *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang802" placeholder="Mollie Payment" required="" value="Mollie Payment">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Authorize.Net *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang809" placeholder="Authorize.Net" required="" value="Authorize.Net">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">MercadoPago *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang810" placeholder="MercadoPago" required="" value="MercadoPago">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Flutter Wave *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang811" placeholder="Flutter Wave" required="" value="Flutter Wave">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">2Checkout *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang812" placeholder="2Checkout" required="" value="2Checkout">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">SSLCommerz *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang813" placeholder="SSLCommerz" required="" value="SSLCommerz">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Voguepay *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang814" placeholder="Voguepay" required="" value="Voguepay">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Wallet Amount: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang815" placeholder="Wallet Amount:" required="" value="Wallet Amount:">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Pay From Your Wallet *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang816" placeholder="Pay From Your Wallet" required="" value="Pay From Your Wallet">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Enter Your Amount *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang817" placeholder="Enter Your Amount" required="" value="Enter Your Amount">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">SUBMIT *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang818" placeholder="SUBMIT" required="" value="SUBMIT">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shipping Method *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang765" placeholder="Shipping Method"
                            required="" value="Shipping Method">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Packaging *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang766" placeholder="Packaging" required=""
                            value="Packaging">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Final Price *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang767" placeholder="Final Price" required=""
                            value="Final Price">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Card number not valid *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang781" placeholder="Card number not valid" required=""
                            value="Card number not valid">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">CVC number not valid *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang782" placeholder="CVC number not valid" required=""
                            value="CVC number not valid">
                        </div>
                      </div>



                      <hr>

                      <h4 class="text-center">Wishlists</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Wishlists *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang168" placeholder="Wishlists" required=""
                            value="Wishlists">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">Success</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Success *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang169" placeholder="Success" required=""
                            value="Success">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Get Back To Our Homepage *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang170" placeholder="Get Back To Our Homepage"
                            required="" value="Get Back To Our Homepage">
                        </div>
                      </div>

                      <hr>

                      <h4 class="text-center">LOGIN</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Login & Register *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang171" placeholder="Login & Register"
                            required="" value="Login & Register">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">LOGIN NOW *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang172" placeholder="LOGIN NOW" required=""
                            value="LOGIN NOW">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Type Email Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang173" placeholder="Type Email Address"
                            required="" value="Type Email Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Get Back To Our Homepage *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang174" placeholder="Type Password" required=""
                            value="Type Password">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Remember Password *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang175" placeholder="Remember Password"
                            required="" value="Remember Password">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Forgot Password? *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang176" placeholder="Forgot Password?"
                            required="" value="Forgot Password?">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Authenticating... *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang177" placeholder="Authenticating..."
                            required="" value="Authenticating...">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Login *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang178" placeholder="Login" required=""
                            value="Login">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Vendor Login *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang234" placeholder="Vendor Login" required=""
                            value="Vendor Login">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Or *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang179" placeholder="Or" required="" value="Or">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Sign In with social media *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang180" placeholder="Sign In with social media"
                            required="" value="Sign In with social media">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Signup Now *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang181" placeholder="Signup Now" required=""
                            value="Signup Now">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Full Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang182" placeholder="Full Name" required=""
                            value="Full Name">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Email Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang183" placeholder="Email Address" required=""
                            value="Email Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Phone Number *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang184" placeholder="Phone Number" required=""
                            value="Phone Number">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang185" placeholder="Address" required=""
                            value="Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Password *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang186" placeholder="Password" required=""
                            value="Password">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Confirm Password *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang187" placeholder="Confirm Password"
                            required="" value="Confirm Password">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Processing... *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang188" placeholder="Processing..."
                            required="" value="Processing...">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Register *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang189" placeholder="Register" required=""
                            value="Register">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Vendor Registration *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang235" placeholder="Vendor Registration"
                            required="" value="Vendor Registration">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Login (Pop Up) *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang197" placeholder="Login" required=""
                            value="Login">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Register (Pop Up) *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang198" placeholder="Register" required=""
                            value="Register">
                        </div>
                      </div>

                      <hr>

                      <h4 class="text-center">FORGOT</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Forgot Password (Header) *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang190" placeholder="Forgot Password (Header)"
                            required="" value="Forgot Password">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Forgot Password (Title) *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang191" placeholder=">Forgot Password (Title)"
                            required="" value="Forgot Password ">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Please Write your Email *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang192" placeholder="Please Write your Email"
                            required="" value="Please Write your Email">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Email Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang193" placeholder="Email Address" required=""
                            value="Email Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Login Now *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang194" placeholder="Login Now" required=""
                            value="Login Now">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Checking... *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang195" placeholder="Checking..." required=""
                            value="Checking...">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">SUBMIT *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang196" placeholder="SUBMIT" required=""
                            value="SUBMIT">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">VENDOR STORE</h4>

                      <hr>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Store Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang226" placeholder="Store Name" required=""
                            value="Store Name">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Service Center *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang227" placeholder="Service Center" required=""
                            value="Service Center">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Contact Now *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang228" placeholder="Contact Now" required=""
                            value="Contact Now">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Follow Us *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang229" placeholder="Follow Us" required=""
                            value="Follow Us">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shop Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang238" placeholder="Shop Name" required=""
                            value="Shop Name">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Owner Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang239" placeholder="Owner Name" required=""
                            value="Owner Name">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shop Number *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang240" placeholder="Shop Number" required=""
                            value="Shop Number">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shop Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang241" placeholder="Shop Address" required=""
                            value="Shop Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Registration Number *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang242" placeholder="Registration Number"
                            required="" value="Registration Number">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang243" placeholder="Message" required=""
                            value="Message">
                        </div>
                      </div>




                      <hr>

                      <h4 class="text-center">FOOTER</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Footer Links *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang21" placeholder="Footer Links" required=""
                            value="Footer Links">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Home *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang22" placeholder="Home" required=""
                            value="Home">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Contact Us *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang23" placeholder="Contact Us" required=""
                            value="Contact Us">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Recent Post *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang24" placeholder="Recent Post" required=""
                            value="Recent Post">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">SUCCESS MESSAGES</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add To Cart Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Add To Cart Message" name="add_cart"
                            value="Successfully Added To Cart" required="">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Already Added To Cart Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Already Added To Cart Message"
                            name="already_cart" value="Already Added To Cart" required="">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Out Of Stock Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Out Of Stock Message" name="out_stock"
                            value="Out Of Stock" required="">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add To Wishlist Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Add To Wishlist Message" name="add_wish"
                            value="Successfully Added To Wishlist" required="">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Already Added To Wishlist Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Already Added To Wishlist Message"
                            name="already_wish" value="Already Added To Wishlist" required="">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Wishlist Remove Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Wishlist Remove Message"
                            name="wish_remove" value="Successfully Removed From The Wishlist" required="">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add To Compare Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Add To Compare Message" name="add_compare"
                            value="Successfully Added To Compare" required="">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Already Added To Compare Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Already Added To Compare Message"
                            name="already_compare" value="Already Added To Compare" required="">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Compare Remove Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Compare Remove Message"
                            name="compare_remove" value="Successfully Removed From The Compare" required="">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Color Change Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Color Change Message" name="color_change"
                            value="Successfully Changed The Color" required="">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Coupon Found Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Coupon Found Message" name="coupon_found"
                            value="Coupon Found" required="">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">No Coupon Found Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="No Coupon Found Message" name="no_coupon"
                            value="No Coupon Found" required="">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Coupon Already Applied Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Coupon Already Applied Message"
                            name="already_coupon" value="Coupon Already Applied" required="">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Email Not Found Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Email Not Found" name="email_not_found"
                            value="Email Not Found" required="">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Oops Something Goes Wrong Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Oops Something Goes Wrong !!"
                            name="something_wrong" value="Oops Something Goes Wrong !!" required="">
                        </div>
                      </div>



                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Message Sent Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Message Sent !!" name="message_sent"
                            value="Message Sent !!" required="">
                        </div>
                      </div>




                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Order Success Title *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <div class="tawk-area">
                            <textarea name="order_title" required="">THANK YOU FOR YOUR PURCHASE.</textarea>
                          </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Order Success Text *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <div class="tawk-area">
                            <textarea name="order_text"
                              required="">We'll email you an order confirmation with details and tracking info.</textarea>
                          </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Subscribe Success Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Subscribe Success Message"
                            name="subscribe_success" value="You have subscribed successfully." required="">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Subscribe Error Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Subscribe Error Message"
                            name="subscribe_error" value="This email has already been taken." required="">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">Subscription Popup</h4>

                      <hr>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Enter Your Email Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Enter Your Email Address" name="lang741"
                            value="Enter Your Email Address" required="">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">SUBSCRIBE *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="SUBSCRIBE" name="lang742"
                            value="SUBSCRIBE" required="">
                        </div>
                      </div>



                      <hr>

                      <h4 class="text-center">ERROR PAGE</h4>

                      <hr>



                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">404 *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="404" name="lang427" value="404"
                            required="">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Oops! You're lost... *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Oops! You're lost..." name="lang428"
                            value="Oops! You're lost..." required="">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">The page you are looking for might have been moved, renamed, or might
                              never existed. *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <div class="tawk-area">
                            <textarea name="lang429"
                              required="">The page you are looking for might have been moved, renamed, or might never existed.</textarea>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Back Home *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" placeholder="Back Home" name="lang430"
                            value="Back Home" required="">
                        </div>
                      </div>




                    </div>


                    {{-- FRONTEND ENDS --}}


                    {{-- USER PANEL STARTS --}}

                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">


                      <hr>

                      <h4 class="text-center">USER DASHBOARD</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Dashboard *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang200" placeholder="Dashboard" required=""
                            value="Dashboard">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Vendor Panel *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang230" placeholder="Vendor Panel" required=""
                            value="Vendor Panel">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Purchased Items *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang201" placeholder="Purchased Items"
                            required="" value="Purchased Items">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Affiliate Code *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang202" placeholder="Affiliate Code" required=""
                            value="Affiliate Code">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Withdraw *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang203" placeholder="Withdraw" required=""
                            value="Withdraw">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Favorite Sellers *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang231" placeholder="Favorite Sellers"
                            required="" value="Favorite Sellers">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Messages *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang232" placeholder="Messages" required=""
                            value="Messages">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Tickets *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang204" placeholder="Tickets" required=""
                            value="Tickets">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Disputes *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang250" placeholder="Disputes" required=""
                            value="Disputes">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Edit Profile *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang205" placeholder="Edit Profile" required=""
                            value="Edit Profile">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Reset Password *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang206" placeholder="Reset Password" required=""
                            value="Reset Password">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Logout *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang207" placeholder="Logout" required=""
                            value="Logout">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Start Selling *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang233" placeholder="Start Selling" required=""
                            value="Start Selling">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Pricing Plans *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang237" placeholder="Pricing Plans" required=""
                            value="Pricing Plans">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Account Information *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang208" placeholder="Account Information"
                            required="" value="Account Information">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Email *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang209" placeholder="Email" required=""
                            value="Email">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Phone *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang210" placeholder="Phone" required=""
                            value="Phone">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Fax *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang211" placeholder="Fax" required=""
                            value="Fax">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">City *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang212" placeholder="City" required=""
                            value="City">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Zip *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang213" placeholder="Zip" required=""
                            value="Zip">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang214" placeholder="Address" required=""
                            value="Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Affiliate Bonus *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang215" placeholder="Affiliate Bonus"
                            required="" value="Affiliate Bonus">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">My Wallet *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang833" placeholder="My Wallet"
                            required="" value="My Wallet">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Wallet Balance: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang834" placeholder="Wallet Balance:"
                            required="" value="Wallet Balance:">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add Deposit *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang835" placeholder="Add Deposit"
                            required="" value="Add Deposit">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Recent Orders *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang836" placeholder="Recent Orders"
                            required="" value="Recent Orders">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Total Orders *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang837" placeholder="Total Orders"
                            required="" value="Total Orders">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Pending Orders *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang838" placeholder="Pending Orders"
                            required="" value="Pending Orders">
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">All Time *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang839" placeholder="All Time"
                            required="" value="All Time">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Transaction ID *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang840" placeholder="Transaction ID"
                            required="" value="Transaction ID">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">View Details *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang841" placeholder="View Details"
                            required="" value="View Details">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">PURCHASED ITEMS</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Purchased Items *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang277" placeholder="Purchased Items"
                            required="" value="Purchased Items">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">#Order *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang278" placeholder="#Order" required=""
                            value="#Order">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Date *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang279" placeholder="Date" required=""
                            value="Date">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Order Total *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang280" placeholder="Order Total" required=""
                            value="Order Total">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Order Status *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang281" placeholder="Order Status" required=""
                            value="Order Status">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">View *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang282" placeholder="View" required=""
                            value="View">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">VIEW ORDER *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang283" placeholder="VIEW ORDER" required=""
                            value="VIEW ORDER">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">My Order Details *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang284" placeholder="My Order Details"
                            required="" value="My Order Details">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Order# *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang285" placeholder="Order#" required=""
                            value="Order#">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">print order *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang286" placeholder="print order" required=""
                            value="Print">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Order Date *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang301" placeholder="Order Date" required=""
                            value="Order Date">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Billing Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang287" placeholder="Billing Address"
                            required="" value="Billing Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Name: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang288" placeholder="Name:" required=""
                            value="Name:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Email: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang289" placeholder="Email:" required=""
                            value="Email:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Phone: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang290" placeholder="Phone:" required=""
                            value="Phone:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Address: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang291" placeholder="Address:" required=""
                            value="Address:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Payment Information *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang292" placeholder="Payment Information"
                            required="" value="Payment Information">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Paid Amount: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang293" placeholder="Paid Amount:" required=""
                            value="Paid Amount:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Payment Method: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang294" placeholder="Payment Method:"
                            required="" value="Payment Method:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Charge ID: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang295" placeholder="Charge ID:" required=""
                            value="Charge ID:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Transaction ID: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang296" placeholder="Transaction ID:"
                            required="" value="Transaction ID:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Edit Transaction ID *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang297" placeholder="Edit Transaction ID"
                            required="" value="Edit Transaction ID">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Cancel *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang298" placeholder="Cancel" required=""
                            value="Cancel">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Enter Transaction ID & Press Enter *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang299"
                            placeholder="Enter Transaction ID & Press Enter" required=""
                            value="Enter Transaction ID & Press Enter">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Submit *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang300" placeholder="Submit" required=""
                            value="Submit">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shipping Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang302" placeholder="Shipping Address"
                            required="" value="Shipping Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">PickUp Location *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang303" placeholder="PickUp Location"
                            required="" value="PickUp Location">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Address: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang304" placeholder="Address:" required=""
                            value="Address:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shipping Method *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang305" placeholder="Shipping Method"
                            required="" value="Shipping Method">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Ship To Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang306" placeholder="Ship To Address"
                            required="" value="Ship To Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Pick Up *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang307" placeholder="Pick Up" required=""
                            value="Pick Up">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Ordered Products: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang308" placeholder="Ordered Products:"
                            required="" value="Ordered Products:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">ID# *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang309" placeholder="ID#" required=""
                            value="ID#">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang310" placeholder="Name" required=""
                            value="Name">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Quantity *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang311" placeholder="Quantity" required=""
                            value="Quantity">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Size *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang312" placeholder="Size" required=""
                            value="Size">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Color *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang313" placeholder="Color" required=""
                            value="Color">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Price *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang314" placeholder="Price" required=""
                            value="Price">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Total *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang315" placeholder="Total" required=""
                            value="Total">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Download *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang316" placeholder="Download" required=""
                            value="Download">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">View License *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang317" placeholder="View License" required=""
                            value="View License">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Back *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang318" placeholder="Back" required=""
                            value="Back">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">License Key *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang319" placeholder="License Key" required=""
                            value="License Key">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">The Licenes Key is : *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang320" placeholder="The Licenes Key is :"
                            required="" value="The Licenes Key is :">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Close *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang321" placeholder="Close" required=""
                            value="Close">
                        </div>
                      </div>

                      <hr>

                      <h4 class="text-center">Affiliate Code</h4>

                      <hr>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Affiliate Informations *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang322" placeholder="Affiliate Informations"
                            required="" value="Affiliate Informations">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Your Affilate Link *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang323" placeholder="Your Affilate Link *"
                            required="" value="Your Affilate Link *">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">This is your affilate link just copy the link and paste anywhere you
                              want. *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang324"
                            placeholder="This is your affilate link just copy the link and paste anywhere you want."
                            required=""
                            value="This is your affilate link just copy the link and paste anywhere you want.">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Affiliate Banner *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang325" placeholder="Affiliate Banner *"
                            required="" value="Affiliate Banner *">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">This is your affilate banner Preview. *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang326"
                            placeholder="This is your affilate banner Preview." required=""
                            value="This is your affilate banner Preview.">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Affiliate Banner HTML Code *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang327"
                            placeholder="Affiliate Banner HTML Code *" required="" value="Affiliate Banner HTML Code *">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">This is your affilate banner html code just copy the code and paste
                              anywhere you want. *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang328"
                            placeholder="This is your affilate banner html code just copy the code and paste anywhere you want."
                            required=""
                            value="This is your affilate banner html code just copy the code and paste anywhere you want.">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">WITHDRAW</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">My Withdraws *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang329" placeholder="My Withdraws" required=""
                            value="My Withdraws">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Withdraw Now *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang330" placeholder="Withdraw Now" required=""
                            value="Withdraw Now">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Withdraw Date *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang331" placeholder="Withdraw Date" required=""
                            value="Withdraw Date">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Method *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang332" placeholder="Method" required=""
                            value="Method">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Account *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang333" placeholder="Account" required=""
                            value="Account">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Amount *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang334" placeholder="Amount" required=""
                            value="Amount">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Status *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang335" placeholder="Status" required=""
                            value="Status">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">WITHDRAW NOW</h4>

                      <hr>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Withdraw Now *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang336" placeholder="Withdraw Now" required=""
                            value="Withdraw Now">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Back *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang337" placeholder="Back" required=""
                            value="Back">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Withdraw Method *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang338" placeholder="Withdraw Method"
                            required="" value="Withdraw Method">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Select Withdraw Method *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang339" placeholder="Select Withdraw Method"
                            required="" value="Select Withdraw Method">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Paypal *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang340" placeholder="Paypal" required=""
                            value="Paypal">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Skrill *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang341" placeholder="Skrill" required=""
                            value="Skrill">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Payoneer *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang342" placeholder="Payoneer" required=""
                            value="Payoneer">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Bank *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang343" placeholder="Bank" required=""
                            value="Bank">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Withdraw Amount *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang344" placeholder="Withdraw Amount"
                            required="" value="Withdraw Amount">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Enter Account Email *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang345" placeholder="Enter Account Email"
                            required="" value="Enter Account Email">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Enter IBAN/Account No *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang346" placeholder="Enter IBAN/Account No"
                            required="" value="Enter IBAN/Account No">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Enter Account Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang347" placeholder="Enter Account Name"
                            required="" value="Enter Account Name">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Enter Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang348" placeholder="Enter Address" required=""
                            value="Enter Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Enter Swift Code *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang349" placeholder="Enter Swift Code"
                            required="" value="Enter Swift Code">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Additional Reference(Optional) *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang350"
                            placeholder="Additional Reference(Optional)" required=""
                            value="Additional Reference(Optional)">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Withdraw Fee *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang351" placeholder="Withdraw Fee" required=""
                            value="Withdraw Fee">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">and *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang352" placeholder="and" required=""
                            value="and">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">will deduct from your account. *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang353"
                            placeholder="will deduct from your account." required=""
                            value="will deduct from your account.">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Withdraw *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang354" placeholder="Withdraw" required=""
                            value="Withdraw">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Current Balance *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang355" placeholder="Current Balance"
                            required="" value="Current Balance">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">ORDER TRACKING</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Order Tracking *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang772" placeholder="Order Tracking"
                            required="" value="Order Tracking">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Get Tracking Code *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang773" placeholder="Get Tracking Code"
                            required="" value="Get Tracking Code">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">View Tracking *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang774" placeholder="View Tracking"
                            required="" value="View Tracking">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">No Order Found *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang775" placeholder="No Order Found"
                            required="" value="No Order Found">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">FAVORITE SELLERS</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Favorite Sellers *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang252" placeholder="Favorite Sellers"
                            required="" value="Favorite Sellers">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shop Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang253" placeholder="Shop Name" required=""
                            value="Shop Name">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Owner Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang254" placeholder="Owner Name" required=""
                            value="Owner Name">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang255" placeholder="Address" required=""
                            value="Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Actions *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang256" placeholder="Actions" required=""
                            value="Actions">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Confirm Delete *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang257" placeholder="Confirm Delete" required=""
                            value="Confirm Delete">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">You are about to delete this Seller. *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang258"
                            placeholder="You are about to delete this Seller." required=""
                            value="You are about to delete this Seller.">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Do you want to proceed? *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang259" placeholder="Do you want to proceed?"
                            required="" value="Do you want to proceed?">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Cancel *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang260" placeholder="Cancel" required=""
                            value="Cancel">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Delete *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang261" placeholder="Delete" required=""
                            value="Delete">
                        </div>
                      </div>



                      <hr>

                      <h4 class="text-center">Messages</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Messages *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang356" placeholder="Messages" required=""
                            value="Messages">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Compose Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang357" placeholder="Compose Message"
                            required="" value="Compose Message">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang358" placeholder="Name" required=""
                            value="Name">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang359" placeholder="Message" required=""
                            value="Message">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Sent *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang360" placeholder="Sent" required=""
                            value="Sent">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Action *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang361" placeholder="Action" required=""
                            value="Action">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Send Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang362" placeholder="Send Message" required=""
                            value="Send Message">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Email *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang363" placeholder="Email" required=""
                            value="Email">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Subject *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang364" placeholder="Subject" required=""
                            value="Subject">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Your Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang365" placeholder="Your Message" required=""
                            value="Your Message">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Send Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang366" placeholder="Send Message" required=""
                            value="Send Message">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Confirm Delete *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang367" placeholder="Confirm Delete" required=""
                            value="Confirm Delete">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">You are about to delete this Conversation. *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang368"
                            placeholder="You are about to delete this Conversation." required=""
                            value="You are about to delete this Conversation.">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Do you want to proceed? *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang369" placeholder="Do you want to proceed?"
                            required="" value="Do you want to proceed?">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Cancel *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang370" placeholder="Cancel" required=""
                            value="Cancel">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Delete *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang371" placeholder="Delete" required=""
                            value="Delete">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Conversation with *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang372" placeholder="Conversation with"
                            required="" value="Conversation with">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Back *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang373" placeholder="Back" required=""
                            value="Back">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang374" placeholder="Message" required=""
                            value="Message">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add Reply *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang375" placeholder="Add Reply" required=""
                            value="Add Reply">
                        </div>
                      </div>

                      <hr>

                      <h4 class="text-center">Tickets And Disputes</h4>

                      <hr>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Tickets *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang376" placeholder="Tickets" required=""
                            value="Tickets">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add Ticket *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang377" placeholder="Add Ticket" required=""
                            value="Add Ticket">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Disputes *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang378" placeholder="Disputes" required=""
                            value="Disputes">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add Dispute *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang379" placeholder="Add Dispute" required=""
                            value="Add Dispute">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Subject *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang380" placeholder="Subject" required=""
                            value="Subject">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang381" placeholder="Message" required=""
                            value="Message">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Time *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang382" placeholder="Time" required=""
                            value="Time">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Action *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang383" placeholder="Action" required=""
                            value="Action">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add Ticket (In Modal) *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang384" placeholder="Add Ticket" required=""
                            value="Add Ticket">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add Dispute (In Modal) *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang385" placeholder="Add Dispute" required=""
                            value="Add Dispute">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Order Number *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang386" placeholder="Order Number" required=""
                            value="Order Number">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Subject *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang387" placeholder="Subject" required=""
                            value="Subject">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Your Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang388" placeholder="Your Message" required=""
                            value="Your Message">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Send *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang389" placeholder="Send" required=""
                            value="Send">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Confirm Delete *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang390" placeholder="Confirm Delete" required=""
                            value="Confirm Delete">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">You are about to delete this Ticket. *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang391"
                            placeholder="You are about to delete this Ticket." required=""
                            value="You are about to delete this Ticket.">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">You are about to delete this Dispute. *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang392"
                            placeholder="You are about to delete this Dispute." required=""
                            value="You are about to delete this Dispute.">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Do you want to proceed? *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang393" placeholder="Do you want to proceed?"
                            required="" value="Do you want to proceed?">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Cancel *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang394" placeholder="Cancel" required=""
                            value="Cancel">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Delete *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang395" placeholder="Delete" required=""
                            value="Delete">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Order Number: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang396" placeholder="Order Number:" required=""
                            value="Order Number:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Subject: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang397" placeholder="Subject:" required=""
                            value="Subject:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Back *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang398" placeholder="Back" required=""
                            value="Back">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Admin *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang399" placeholder="Admin" required=""
                            value="Admin">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Message *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang400" placeholder="Message" required=""
                            value="Message">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add Reply *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang401" placeholder="Add Reply" required=""
                            value="Add Reply">
                        </div>
                      </div>




                      <hr>

                      <h4 class="text-center">EDIT PROFILE</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Edit Profile *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang262" placeholder="Edit Profile" required=""
                            value="Edit Profile">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Upload *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang263" placeholder="Upload" required=""
                            value="Upload">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">User Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang264" placeholder="User Name" required=""
                            value="User Name">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Email Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang265" placeholder="Email Address" required=""
                            value="Email Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Phone Number *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang266" placeholder="Phone Number" required=""
                            value="Phone Number">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Fax *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang267" placeholder="Fax" required=""
                            value="Fax">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">City *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang268" placeholder="City" required=""
                            value="City">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Zip *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang269" placeholder="Zip" required=""
                            value="Zip">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang270" placeholder="Address" required=""
                            value="Address">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Save *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang271" placeholder="Save" required=""
                            value="Save">
                        </div>
                      </div>

                      <hr>

                      <h4 class="text-center">RESET PASSWORD</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Reset Password *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang272" placeholder="Reset Password" required=""
                            value="Reset Password">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Current Password *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang273" placeholder="Current Password"
                            required="" value="Current Password">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">New Password *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang274" placeholder="New Password" required=""
                            value="New Password">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Re-Type New Password *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang275" placeholder="Re-Type New Password"
                            required="" value="Re-Type New Password">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Submit *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang276" placeholder="Submit" required=""
                            value="Submit">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">Subscription Plans</h4>

                      <hr>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Free *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang402" placeholder="Free" required=""
                            value="Free">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Day(s) *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang403" placeholder="Day(s)" required=""
                            value="Day(s)">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Current Plan *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang404" placeholder="Current Plan" required=""
                            value="Current Plan">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Expired on: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang405" placeholder="Expired on:" required=""
                            value="Expired on:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Ends on: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang406" placeholder="Ends on:" required=""
                            value="Ends on:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Renew *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang407" placeholder="Renew" required=""
                            value="Renew">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Get Started *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang408" placeholder="Get Started" required=""
                            value="Get Started">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Package Details *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang409" placeholder="Package Details"
                            required="" value="Package Details">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Back *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang410" placeholder="Back" required=""
                            value="Back">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Plan: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang411" placeholder="Plan:" required=""
                            value="Plan:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Price: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang412" placeholder="Price:" required=""
                            value="Price:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Durations: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang413" placeholder="Durations:" required=""
                            value="Durations:">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Product(s) Allowed: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang414" placeholder="Product(s) Allowed:"
                            required="" value="Product(s) Allowed:">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Note: *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang415" placeholder="Note:" required=""
                            value="Note:">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Your Previous Plan will be deactivated! *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang416"
                            placeholder="Your Previous Plan will be deactivated!" required=""
                            value="Your Previous Plan will be deactivated!">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">(Optional) *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang417" placeholder="(Optional)" required=""
                            value="(Optional)">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Select Payment Method *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang418" placeholder="Select Payment Method"
                            required="" value="Select Payment Method">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Select an option *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang419" placeholder="Select an option"
                            required="" value="Select an option">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Paypal *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang420" placeholder="Paypal" required=""
                            value="Paypal">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Stripe *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang421" placeholder="Stripe" required=""
                            value="Stripe">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Card *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang422" placeholder="Card" required=""
                            value="Card">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Cvv *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang423" placeholder="Cvv" required=""
                            value="Cvv">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Month *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang424" placeholder="Month" required=""
                            value="Month">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Year *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang425" placeholder="Year" required=""
                            value="Year">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Submit *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang426" placeholder="Submit" required=""
                            value="Submit">
                        </div>
                      </div>

                      <hr>

                      <h4 class="text-center">Others</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Deposit *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang819" placeholder="Deposit" required=""
                            value="Deposit">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Transactions *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang820" placeholder="Transactions" required=""
                            value="Transactions">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Deposit Now *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang821" placeholder="Deposit Now" required=""
                            value="Deposit">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Amount *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang822" placeholder="Amount" required=""
                            value="Amount">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Deposit Amount *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang823" placeholder="Deposit Amount" required=""
                            value="Deposit Amount">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Deposits *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang824" placeholder="Deposits" required=""
                            value="Deposits">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Deposit Date *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang825" placeholder="Deposit Date" required=""
                            value="Deposit Date">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Transactions *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang826" placeholder="Transactions" required=""
                            value="Transactions">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Transaction Date *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang827" placeholder="Transaction Datee" required=""
                            value="Transaction Date">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Details *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang828" placeholder="Details" required=""
                            value="Details">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Country *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang829" placeholder="Country" required=""
                            value="Country">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">State *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang830" placeholder="State" required=""
                            value="State">
                        </div>
                      </div>



                    </div>

                    {{-- USER PANEL ENDS --}}

                    {{-- VENDOR PANEL STARTS --}}

                    <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">


                      <hr>

                      <h4 class="text-center">GLOBAL</h4>

                      <hr>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">(In Any Language) *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang517" placeholder="(In Any Language)"
                            required="" value="(In Any Language)">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">ADD NEW *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang518" placeholder="ADD NEW" required=""
                            value="ADD NEW">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">EDIT *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang519" placeholder="EDIT" required=""
                            value="EDIT">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">HEADER</h4>

                      <hr>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Welcome! *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang431" placeholder="Welcome!" required=""
                            value="Welcome!">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Visit Store *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang432" placeholder="Visit Store" required=""
                            value="Visit Store">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">User Panel *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang433" placeholder="User Panel" required=""
                            value="User Panel">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Edit Profile *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang434" placeholder="Edit Profile" required=""
                            value="Edit Profile">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Logout *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang435" placeholder="Logout" required=""
                            value="Logout">
                        </div>
                      </div>

                      <hr>

                      <h4 class="text-center">NOTIFICATION</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">New Order(s). *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang436" placeholder="New Order(s)." required=""
                            value="New Order(s).">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Clear All *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang437" placeholder="Clear All" required=""
                            value="Clear All">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">You Have a new order. *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang438" placeholder="You Have a new order."
                            required="" value="You Have a new order.">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">No New Notifications. *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang439" placeholder="No New Notifications."
                            required="" value="No New Notifications.">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">SIDEBAR</h4>

                      <hr>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Visit Store *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang440" placeholder="Visit Store" required=""
                            value="Visit Store">
                        </div>
                      </div>



                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Dashbord *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang441" placeholder="Dashbord" required=""
                            value="Dashbord">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Orders *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang442" placeholder="Orders" required=""
                            value="Orders">
                        </div>
                      </div>



                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">All Orders *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang443" placeholder="All Orders" required=""
                            value="All Orders">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Products *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang444" placeholder="Products" required=""
                            value="Products">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add New Product *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang445" placeholder="Add New Product"
                            required="" value="Add New Product">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">All Products *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang446" placeholder="All Products" required=""
                            value="All Products">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Product Catalogs *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang785" placeholder="Product Catalogs" required=""
                            value="Product Catalogs">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Affiliate Products *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang447" placeholder="Affiliate Products"
                            required="" value="Affiliate Products">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add Affiliate Product *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang448" placeholder="Add Affiliate Product"
                            required="" value="Add Affiliate Product">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">All Affiliate Products *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang449" placeholder="All Affiliate Products"
                            required="" value="All Affiliate Products">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Bulk Product Upload *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang450" placeholder="Bulk Product Upload"
                            required="" value="Bulk Product Upload">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Withdraws *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang451" placeholder="Withdraws" required=""
                            value="Withdraws">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Settings *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang452" placeholder="Settings" required=""
                            value="Settings">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Services *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang453" placeholder="Services" required=""
                            value="Services">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Banner *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang454" placeholder="Banner" required=""
                            value="Banner">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shipping Cost *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang455" placeholder="Shipping Cost" required=""
                            value="Shipping Cost">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Social Links *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang456" placeholder="Social Links" required=""
                            value="Social Links">
                        </div>
                      </div>


                      <hr>

                      <h4 class="text-center">EDIT PROFILE</h4>

                      <hr>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Verify Account *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang784" placeholder="Verify Account" required=""
                            value="Verify Account">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shop Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang457" placeholder="Shop Name" required=""
                            value="Shop Name">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Owner Name *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang458" placeholder="Owner Name" required=""
                            value="Owner Name">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shop Number *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang459" placeholder="Shop Number" required=""
                            value="Shop Number">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shop Address *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang460" placeholder="Shop Address" required=""
                            value="Shop Address">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Registration Number *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang461" placeholder="Registration Number"
                            required="" value="Registration Number">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">(Optional) *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang462" placeholder="(Optional)" required=""
                            value="(Optional)">
                        </div>
                      </div>



                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Shop Details *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang463" placeholder="Shop Details" required=""
                            value="Shop Details">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Save *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang464" placeholder="Save" required=""
                            value="Save">
                        </div>
                      </div>


                      <hr>
                        
                        <h4 class="text-center">Vendor Verification</h4>

                      <hr>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Vendor Verification *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang786" placeholder="Vendor Verification" required=""
                            value="Vendor Verification">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Details *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang787" placeholder="Details" required=""
                            value="Details">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Enter Verification Details *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang788" placeholder="Enter Verification Details" required=""
                            value="Enter Verification Details">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Attachment *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang789" placeholder="Attachment" required=""
                            value="Attachment">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">(Maximum Size is: 10MB) *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang792" placeholder="(Maximum Size is: 10MB)" required=""
                            value="(Maximum Size is: 10MB)">
                        </div>
                      </div>



                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Add More Attachment *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang790" placeholder="Add More Attachment" required=""
                            value="Add More Attachment">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Submit *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang791" placeholder="Submit" required=""
                            value="Submit">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Verify Now *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang803" placeholder="Verify Now " required="" value="Verify Now">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Your Documents Submitted Successfully. *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang804" placeholder="Your Documents Submitted Successfully." required="" value="Your Documents Submitted Successfully.">
                        </div>
                      </div>




                      <hr>

                      <h4 class="text-center">DASHBOARD</h4>

                      <hr>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Orders Pending! *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang465" placeholder="Orders Pending!"
                            required="" value="Orders Pending!">
                        </div>
                      </div>



                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Orders Procsessing! *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang466" placeholder="Orders Procsessing!"
                            required="" value="Orders Procsessing!">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Orders Completed! *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang467" placeholder="Orders Completed!"
                            required="" value="Orders Completed!">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Total Products! *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang468" placeholder="Total Products!"
                            required="" value="Total Products!">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Total Item Sold! *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang469" placeholder="Total Item Sold!"
                            required="" value="Total Item Sold!">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">Total Earnings! *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang470" placeholder="Total Earnings!"
                            required="" value="Total Earnings!">
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-lg-4">
                          <div class="left-area">
                            <h4 class="heading">View All *</h4>
                            <p class="sub-heading">(In Any Language)</p>
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <input type="text" class="input-field" name="lang471" placeholder="View All " required=""
                            value="View All ">
                        </div>
                      </div>

                    </div>


                    <hr>

                    <h4 class="text-center">ORDERS</h4>

                    <hr>



                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Order Number *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang534" placeholder="Order Number" required=""
                          value="Order Number">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Total Qty *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang535" placeholder="Total Qty" required=""
                          value="Total Qty">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Total Cost *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang536" placeholder="Total Cost" required=""
                          value="Total Cost">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Payment Method *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang537" placeholder="Payment Method" required=""
                          value="Payment Method">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Actions *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang538" placeholder="Actions" required=""
                          value="Actions">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Details *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang539" placeholder="Details" required=""
                          value="Details">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Pending *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang540" placeholder="Pending" required=""
                          value="Pending">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Processing *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang541" placeholder="Processing" required=""
                          value="Processing">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Completed *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang542" placeholder="Completed" required=""
                          value="Completed">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Declined *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang543" placeholder="Declined" required=""
                          value="Declined">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Update Status *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang544" placeholder="Update Status" required=""
                          value="Update Status">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">You are about to update the Order's Status. *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang545"
                          placeholder="You are about to update the Order's Status." required=""
                          value="You are about to update the Order's Status.">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Do you want to proceed? *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang546" placeholder="Do you want to proceed?"
                          required="" value="Do you want to proceed?">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Cancel *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang547" placeholder="Cancel" required=""
                          value="Cancel">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Proceed *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang548" placeholder="Proceed" required=""
                          value="Proceed">
                      </div>
                    </div>



                    <hr>

                    <h4 class="text-center">ORDER DETAILS</h4>

                    <hr>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Order Details *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang549" placeholder="Order Details" required=""
                          value="Order Details">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Payment Method *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang795" placeholder="Payment Method" required=""
                          value="Payment Method">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Charge ID *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang796" placeholder="Charge ID" required=""
                          value="Charge ID">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Transaction ID *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang797" placeholder="Transaction ID" required=""
                          value="Transaction ID">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Payment Status *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang798" placeholder="Payment Status" required=""
                          value="Payment Status">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Unpaid *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang799" placeholder="Unpaid" required=""
                          value="Unpaid">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Paid *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang800" placeholder="Paid" required=""
                          value="Paid">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Order Note *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang801" placeholder="Order Note" required=""
                          value="Order Note">
                      </div>
                    </div>







                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Back *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang550" placeholder="Back" required=""
                          value="Back">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Order ID *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang551" placeholder="Order ID" required=""
                          value="Order ID">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Total Product *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang552" placeholder="Total Product" required=""
                          value="Total Product">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Total Cost *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang553" placeholder="Total Cost" required=""
                          value="Total Cost">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Ordered Date *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang554" placeholder="Ordered Date" required=""
                          value="Ordered Date">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">View Invoice *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang555" placeholder="View Invoice" required=""
                          value="View Invoice">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Billing Details *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang556" placeholder="Billing Details" required=""
                          value="Billing Details">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Customer Name *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang557" placeholder="Customer Name" required="" value="Customer Name">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Email *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang558" placeholder="Email" required=""
                          value="Email">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Phone *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang559" placeholder="Phone" required=""
                          value="Phone">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Address *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang560" placeholder="Address" required=""
                          value="Address">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Country *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang561" placeholder="Country" required=""
                          value="Country">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">City *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang562" placeholder="City" required=""
                          value="City">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Postal Code *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang563" placeholder="Postal Code" required=""
                          value="Postal Code">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Shipping Details *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang564" placeholder="Shipping Details" required=""
                          value="Shipping Details">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Pickup Location *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang565" placeholder="Pickup Location" required=""
                          value="Pickup Location">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Products Ordered *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang566" placeholder="Products Ordered" required=""
                          value="Products Ordered">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product ID# *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang567" placeholder="Product ID#" required=""
                          value="Product ID#">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Shop Name *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang568" placeholder="Shop Name" required=""
                          value="Shop Name">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Status *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang569" placeholder="Status" required=""
                          value="Status">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Title *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang570" placeholder="Product Title" required=""
                          value="Product Title">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Quantity *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang571" placeholder="Quantity" required=""
                          value="Quantity">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Size *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang572" placeholder="Size" required=""
                          value="Size">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Color *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang573" placeholder="Color" required=""
                          value="Color">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Total Price *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang574" placeholder="Total Price" required=""
                          value="Total Price">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Vendor Removed *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang575" placeholder="Vendor Removed" required=""
                          value="Vendor Removed">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Send Email *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang576" placeholder="Send Email" required=""
                          value="Send Email">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">License Key *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang577" placeholder="License Key" required=""
                          value="License Key">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">The Licenes Key is *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang578" placeholder="The Licenes Key is"
                          required="" value="The Licenes Key is">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Enter New License Key *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang579" placeholder="Enter New License Key"
                          required="" value="Enter New License Key">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Close *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang580" placeholder="Close" required=""
                          value="Close">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Cancel *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang584" placeholder="Cancel" required=""
                          value="Cancel">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Save License *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang585" placeholder="Save License" required=""
                          value="Save License">
                      </div>
                    </div>



                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Email Address *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang583" placeholder="Email Address" required=""
                          value="Email Address">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Subject *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang581" placeholder="Subject" required=""
                          value="Subject">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Your Message *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang582" placeholder="Your Message" required=""
                          value="Your Message">
                      </div>
                    </div>



                    <hr>

                    <h4 class="text-center">ORDER INVOICE</h4>

                    <hr>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Order Invoice *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang586" placeholder="Order Invoice" required=""
                          value="Order Invoice">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Billing Address *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang587" placeholder="Billing Address" required=""
                          value="Billing Address">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Invoice Number *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang588" placeholder="Invoice Number" required=""
                          value="Invoice Number">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Order Date *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang589" placeholder="Order Date" required=""
                          value="Order Date">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Order ID *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang590" placeholder="Order ID" required=""
                          value="Order ID">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang591" placeholder="Product" required=""
                          value="Product">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Size *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang592" placeholder="Size" required=""
                          value="Size">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Color *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang593" placeholder="Color" required=""
                          value="Color">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Price *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang594" placeholder="Price" required=""
                          value="Price">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Qty *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang595" placeholder="Qty" required=""
                          value="Qty">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Packaging Cost *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang596" placeholder="Packaging Cost" required="" value="Packaging Cost">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Subtotal *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang597" placeholder="Subtotal" required=""
                          value="Subtotal">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Shipping Cost *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang598" placeholder="Shipping Cost" required=""
                          value="Shipping Cost">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">TAX *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang599" placeholder="TAX" required="" value="TAX">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Total *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang600" placeholder="Total" required=""
                          value="Total">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Order Details *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang601" placeholder="Order Details" required=""
                          value="Order Details">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Shipping Method *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang602" placeholder="Shipping Method" required=""
                          value="Shipping Method">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Pick Up *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang603" placeholder="Pick Up" required=""
                          value="Pick Up">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Ship To Address *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang604" placeholder="Ship To Address" required=""
                          value="Ship To Address">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Payment Method *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang605" placeholder="Payment Method" required=""
                          value="Payment Method">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Shipping Address *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang606" placeholder="Shipping Address" required=""
                          value="Shipping Address">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Print Invoice *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang607" placeholder="Print Invoice" required=""
                          value="Print Invoice">
                      </div>
                    </div>


                    <hr>

                    <h4 class="text-center">PRODUCTS & AFFILIATE PRODUCTS</h4>

                    <hr>



                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Name *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang608" placeholder="Name" required=""
                          value="Name">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Sku *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang793" placeholder="Product Sku" required=""
                          value="Product Sku">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Enter Product Sku *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang794" placeholder="Enter Product Sku" required=""
                          value="Enter Product Sku">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Type *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang609" placeholder="Type" required=""
                          value="Type">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Price *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang610" placeholder="Price" required=""
                          value="Price">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Status *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang611" placeholder="Status" required=""
                          value="Status">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Actions *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang612" placeholder="Actions" required=""
                          value="Actions">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Activated *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang713" placeholder="Activated" required=""
                          value="Activated">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Deactivated *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang714" placeholder="Deactivated" required=""
                          value="Deactivated">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Edit *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang715" placeholder="Edit" required=""
                          value="Edit">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">View Gallery *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang716" placeholder="View Gallery" required=""
                          value="View Gallery">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Close *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang613" placeholder="Close" required=""
                          value="Close">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Confirm Delete *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang614" placeholder="Confirm Delete" required=""
                          value="Confirm Delete">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">You are about to delete this Product. *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang615"
                          placeholder="You are about to delete this Product." required=""
                          value="You are about to delete this Product.">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Do you want to proceed? *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang616" placeholder="Do you want to proceed?"
                          required="" value="Do you want to proceed?">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Cancel *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang617" placeholder="Cancel" required=""
                          value="Cancel">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Delete *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang618" placeholder="Delete" required=""
                          value="Delete">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Image Gallery *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang619" placeholder="Image Gallery" required=""
                          value="Image Gallery">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Upload File *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang620" placeholder="Upload File" required=""
                          value="Upload File">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Done *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang621" placeholder="Done" required=""
                          value="Done">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">You can upload multiple Images. *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang622"
                          placeholder="You can upload multiple Images." required=""
                          value="You can upload multiple Images.">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Add New Product *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang623" placeholder="Add New Product" required=""
                          value="Add New Product">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">No Images Found. *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang624" placeholder="No Images Found." required=""
                          value="No Images Found.">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Types *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang625" placeholder="Product Types" required=""
                          value="Product Types">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Physical *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang626" placeholder="Physical" required=""
                          value="Physical">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Digital *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang627" placeholder="Digital" required=""
                          value="Digital">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">License *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang628" placeholder="License" required=""
                          value="License">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Physical Product *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang629" placeholder="Physical Product" required=""
                          value="Physical Product">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Digital Product *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang630" placeholder="Digital Product" required=""
                          value="Digital Product">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">License Product *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang631" placeholder="License Product" required=""
                          value="License Product">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Name *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang632" placeholder="Product Name" required=""
                          value="Product Name">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Allow Product Condition *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang633" placeholder="Allow Product Condition"
                          required="" value="Allow Product Condition">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Condition *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang634" placeholder="Product Condition"
                          required="" value="Product Condition">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">New *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang635" placeholder="New" required="" value="New">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Used *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang636" placeholder="Used" required=""
                          value="Used">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Category *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang637" placeholder="Category" required=""
                          value="Category">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Select Category *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang691" placeholder="Select Category" required=""
                          value="Select Category">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Sub Category *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang638" placeholder="Sub Category" required=""
                          value="Sub Category">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Select Sub Category *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang639" placeholder="Select Sub Category"
                          required="" value="Select Sub Category">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Child Category *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang640" placeholder="Child Category" required=""
                          value="Child Category">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Select Child Category *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang641" placeholder="Select Child Category"
                          required="" value="Select Child Category">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Feature Image *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang642" placeholder="Feature Image" required=""
                          value="Feature Image">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Upload Image Here *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang643" placeholder="Upload Image Here"
                          required="" value="Upload Image Here">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Gallery Images *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang644" placeholder="Product Gallery Images"
                          required="" value="Product Gallery Images">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Set Gallery *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang645" placeholder="Set Gallery" required=""
                          value="Set Gallery">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Allow Estimated Shipping Time *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang646"
                          placeholder="Allow Estimated Shipping Time" required="" value="Allow Estimated Shipping Time">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Estimated Shipping Time *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang647"
                          placeholder="Product Estimated Shipping Time" required=""
                          value="Product Estimated Shipping Time">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Allow Product Sizes *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang648" placeholder="Allow Product Sizes"
                          required="" value="Allow Product Sizes">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Size Name *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang649" placeholder="Size Name" required=""
                          value="Size Name">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">(eg. S,M,L,XL,XXL,3XL,4XL) *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang650" placeholder="(eg. S,M,L,XL,XXL,3XL,4XL)"
                          required="" value="(eg. S,M,L,XL,XXL,3XL,4XL)">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Size Qty *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang651" placeholder="Size Qty" required=""
                          value="Size Qty">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">(Number of quantity of this size) *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang652"
                          placeholder="(Number of quantity of this size)" required=""
                          value="(Number of quantity of this size)">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Size Price *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang653" placeholder="Size Price" required=""
                          value="Size Price">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">(This price will be added with base price) *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang654"
                          placeholder="(This price will be added with base price)" required=""
                          value="(This price will be added with base price)">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Add More Size *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang655" placeholder="Add More Size" required=""
                          value="Add More Size">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Allow Product Colors *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang656" placeholder="Allow Product Colors"
                          required="" value="Allow Product Colors">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Colors *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang657" placeholder="Product Colors" required=""
                          value="Product Colors">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">(Choose Your Favorite Colors) *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang658"
                          placeholder="(Choose Your Favorite Colors)" required="" value="(Choose Your Favorite Colors)">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Add More Color *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang659" placeholder="Add More Color" required=""
                          value="Add More Color">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Allow Product Whole Sell *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang660" placeholder="Allow Product Whole Sell"
                          required="" value="Allow Product Whole Sell">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Enter Quantity *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang661" placeholder="Enter Quantity" required=""
                          value="Enter Quantity">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Enter Discount Percentage *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang662" placeholder="Enter Discount Percentage"
                          required="" value="Enter Discount Percentage">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Add More Field *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang663" placeholder="Add More Field" required=""
                          value="Add More Field">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Current Price *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang664" placeholder="Product Current Price"
                          required="" value="Product Current Price">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">In *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang665" placeholder="In" required="" value="In">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">e.g 20 *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang666" placeholder="e.g 20" required=""
                          value="e.g 20">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Previous Price *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang667" placeholder="Product Previous Price"
                          required="" value="Product Previous Price">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">(Optional) *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang668" placeholder="(Optional)" required=""
                          value="(Optional)">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Stock *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang669" placeholder="Product Stock" required=""
                          value="Product Stock">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">(Leave Empty will Show Always Available) *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang670"
                          placeholder="(Leave Empty will Show Always Available)" required=""
                          value="(Leave Empty will Show Always Available)">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Allow Product Measurement *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang671" placeholder="Allow Product Measurement"
                          required="" value="Allow Product Measurement">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Measurement *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang672" placeholder="Product Measurement"
                          required="" value="Product Measurement">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">None *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang673" placeholder="None" required=""
                          value="None">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Gram *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang674" placeholder="Gram" required=""
                          value="Gram">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Kilogram *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang675" placeholder="Kilogram" required=""
                          value="Kilogram">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Litre *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang676" placeholder="Litre" required=""
                          value="Litre">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Pound *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang677" placeholder="Pound" required=""
                          value="Pound">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Custom *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang678" placeholder="Custom" required=""
                          value="Custom">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Enter Unit *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang679" placeholder="Enter Unit" required=""
                          value="Enter Unit">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Description *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang680" placeholder="Product Description"
                          required="" value="Product Description">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Buy/Return Policy *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang681" placeholder="Product Buy/Return Policy"
                          required="" value="Product Buy/Return Policy">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Youtube Video URL *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang682" placeholder="Youtube Video URL"
                          required="" value="Youtube Video URL">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Allow Product SEO *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang683" placeholder="Allow Product SEO"
                          required="" value="Allow Product SEO">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Meta Tags *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang684" placeholder="Meta Tags" required=""
                          value="Meta Tags">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Meta Description *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang685" placeholder="Meta Description" required=""
                          value="Meta Description">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Feature Tags *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang686" placeholder="Feature Tags" required=""
                          value="Feature Tags">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Enter Your Keyword *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang687" placeholder="Enter Your Keyword"
                          required="" value="Enter Your Keyword">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Add More Field *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang688" placeholder="Add More Field" required=""
                          value="Add More Field">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Tags *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang689" placeholder="Tags" required=""
                          value="Tags">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Create Product *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang690" placeholder="Create Product" required=""
                          value="Create Product">
                      </div>
                    </div>



                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Select Upload Type *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang692" placeholder="Select Upload Type"
                          required="" value="Select Upload Type">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Upload By File *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang693" placeholder="Upload By File" required=""
                          value="Upload By File">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Upload By Link *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang694" placeholder="Upload By Link" required=""
                          value="Upload By Link">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Select File *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang695" placeholder="Select File" required=""
                          value="Select File">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Link *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang696" placeholder="Link" required=""
                          value="Link">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product License *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang697" placeholder="Product License" required=""
                          value="Product License">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">License Key *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang698" placeholder="License Key" required=""
                          value="License Key">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">License Quantity *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang699" placeholder="License Quantity" required=""
                          value="License Quantity">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Add More Field *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang700" placeholder="Add More Field" required=""
                          value="Add More Field">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Platform *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang701" placeholder="Product Platform" required=""
                          value="Product Platform">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Region *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang702" placeholder="Product Region" required=""
                          value="Product Region">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">License Type *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang703" placeholder="License Type" required=""
                          value="License Type">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Edit Product *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang704" placeholder="Edit Product" required=""
                          value="Edit Product">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Edit *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang705" placeholder="Edit" required=""
                          value="Edit">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Save *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang706" placeholder="Save" required=""
                          value="Save">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Product Affiliate Link *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang707" placeholder="Product Affiliate Link"
                          required="" value="Product Affiliate Link">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">(External Link) *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang708" placeholder="(External Link)" required=""
                          value="(External Link)">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Feature Image Source *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang709" placeholder="Feature Image Source"
                          required="" value="Feature Image Source">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">File *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang710" placeholder="File" required=""
                          value="File">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Link *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang711" placeholder="Link" required=""
                          value="Link">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Feature Image Link *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang712" placeholder="Feature Image Link"
                          required="" value="Feature Image Link">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Prefered Size: (800x800) or Square Size. *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang805" placeholder="Prefered Size: (800x800) or Square Size."
                          required="" value="Prefered Size: (800x800) or Square Size.">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Image height and width must be 600 x 600. *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang806" placeholder="Image height and width must be 600 x 600."
                          required="" value="Image height and width must be 600 x 600.">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Image must have square size. *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang807" placeholder="Image must have square size."
                          required="" value="Image must have square size.">
                      </div>
                    </div>



                    <hr>

                    <h4 class="text-center">BULK PRODUCT UPLOAD</h4>

                    <hr>



                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Download Sample CSV *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang531" placeholder="Download Sample CSV"
                          required="" value="Download Sample CSV">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Upload a File *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang532" placeholder="Upload a File" required=""
                          value="Upload a File">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Start Import *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang533" placeholder="Start Import" required=""
                          value="Start Import">
                      </div>
                    </div>




                    <hr>

                    <h4 class="text-center">WITHDRAW</h4>

                    <hr>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">My Withdraws *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang472" placeholder="My Withdraws" required=""
                          value="My Withdraws">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Withdraw Now *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang473" placeholder="Withdraw Now" required=""
                          value="Withdraw Now">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Withdraw Date *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang474" placeholder="Withdraw Date" required=""
                          value="Withdraw Date">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Method *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang475" placeholder="Method" required=""
                          value="Method">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Account *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang476" placeholder="Account" required=""
                          value="Account">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Amount *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang477" placeholder="Amount" required=""
                          value="Amount">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Status *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang478" placeholder="Status" required=""
                          value="Status">
                      </div>
                    </div>


                    <hr>

                    <h4 class="text-center">WITHDRAW NOW</h4>

                    <hr>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Withdraw Now *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang479" placeholder="Withdraw Now" required=""
                          value="Withdraw Now">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Back *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang480" placeholder="Back" required=""
                          value="Back">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Withdraw Method *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang481" placeholder="Withdraw Method" required=""
                          value="Withdraw Method">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Select Withdraw Method *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang482" placeholder="Select Withdraw Method"
                          required="" value="Select Withdraw Method">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Paypal *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang483" placeholder="Paypal" required=""
                          value="Paypal">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Skrill *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang484" placeholder="Skrill" required=""
                          value="Skrill">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Payoneer *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang485" placeholder="Payoneer" required=""
                          value="Payoneer">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Bank *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang486" placeholder="Bank" required=""
                          value="Bank">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Withdraw Amount *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang487" placeholder="Withdraw Amount" required=""
                          value="Withdraw Amount">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Enter Account Email *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang488" placeholder="Enter Account Email"
                          required="" value="Enter Account Email">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Enter IBAN/Account No *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang489" placeholder="Enter IBAN/Account No"
                          required="" value="Enter IBAN/Account No">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Enter Account Name *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang490" placeholder="Enter Account Name"
                          required="" value="Enter Account Name">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Enter Address *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang491" placeholder="Enter Address" required=""
                          value="Enter Address">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Enter Swift Code *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang492" placeholder="Enter Swift Code" required=""
                          value="Enter Swift Code">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Additional Reference(Optional) *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang493"
                          placeholder="Additional Reference(Optional)" required=""
                          value="Additional Reference(Optional)">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Withdraw Fee *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang494" placeholder="Withdraw Fee" required=""
                          value="Withdraw Fee">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">and *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang495" placeholder="and" required="" value="and">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">will deduct from your account. *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang496"
                          placeholder="will deduct from your account." required=""
                          value="will deduct from your account.">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Withdraw *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang497" placeholder="Withdraw" required=""
                          value="Withdraw">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Current Balance *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang498" placeholder="Current Balance" required=""
                          value="Current Balance">
                      </div>
                    </div>


                    <hr>

                    <h4 class="text-center">Services</h4>

                    <hr>



                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">SERVICE *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang499" placeholder="SERVICE" required=""
                          value="SERVICE">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Featured Image *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang500" placeholder="Featured Image" required=""
                          value="Featured Image">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Title *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang501" placeholder="Title" required=""
                          value="Title">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Actions *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang502" placeholder="Actions" required=""
                          value="Actions">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Edit *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang717" placeholder="Edit" required=""
                          value="Edit">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Close *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang503" placeholder="Close" required=""
                          value="Close">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Confirm Delete *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang504" placeholder="Confirm Delete" required=""
                          value="Confirm Delete">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">You are about to delete this Service. *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang505"
                          placeholder="You are about to delete this Service." required=""
                          value="You are about to delete this Service.">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Do you want to proceed? *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang506" placeholder="Do you want to proceed?"
                          required="" value="Do you want to proceed?">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Cancel *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang507" placeholder="Cancel" required=""
                          value="Cancel">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Delete *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang508" placeholder="Delete" required=""
                          value="Delete">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Add New Service *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang509" placeholder="Add New Service" required=""
                          value="Add New Service">
                      </div>
                    </div>



                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Title *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang510" placeholder="Title" required=""
                          value="Title">
                      </div>
                    </div>



                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Current Featured Image *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang511" placeholder="Current Featured Image"
                          required="" value="Current Featured Image">
                      </div>
                    </div>



                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Upload Image *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang512" placeholder="Upload Image" required=""
                          value="Upload Image">
                      </div>
                    </div>



                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Prefered Size: (600x600) or Square Sized Image *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang513"
                          placeholder="Prefered Size: (600x600) or Square Sized Image" required=""
                          value="Prefered Size: (600x600) or Square Sized Image">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Description *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang514" placeholder="Description" required=""
                          value="Description">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Create Service *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang515" placeholder="Create Service" required=""
                          value="Create Service">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Save *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang516" placeholder="Save" required=""
                          value="Save">
                      </div>
                    </div>


                    <hr>

                    <h4 class="text-center">SHIPPING METHODS AND PACKAGING</h4>

                    <hr>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">SHIPPING METHOD *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang718" placeholder="SHIPPING METHOD" required=""
                          value="SHIPPING METHOD">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Shipping Methods *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang719" placeholder="Shipping Methods" required=""
                          value="Shipping Methods">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">PACKAGING *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang720" placeholder="PACKAGING" required=""
                          value="PACKAGING">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Packagings *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang721" placeholder="Packagings" required=""
                          value="Packagings">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Title *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang722" placeholder="Title" required=""
                          value="Title">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Price *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang723" placeholder="Price" required=""
                          value="Price">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Actions *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang724" placeholder="Actions" required=""
                          value="Actions">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Edit *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang725" placeholder="Edit" required=""
                          value="Edit">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Close *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang726" placeholder="Close" required=""
                          value="Close">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Confirm Delete *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang734" placeholder="Confirm Delete" required=""
                          value="Confirm Delete">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">You are about to delete this Shipping Method. *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang727"
                          placeholder="You are about to delete this Shipping Method." required=""
                          value="You are about to delete this Shipping Method.">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">You are about to delete this Packaging. *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang728"
                          placeholder="You are about to delete this Packaging." required=""
                          value="You are about to delete this Packaging.">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Do you want to proceed? *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang729" placeholder="Do you want to proceed?"
                          required="" value="Do you want to proceed?">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Cancel *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang730" placeholder="Cancel" required=""
                          value="Cancel">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Delete *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang731" placeholder="Delete" required=""
                          value="Delete">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Add New Shipping Method *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang732" placeholder="Add New Shipping Method"
                          required="" value="Add New Shipping Method">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Add New Packaging *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang733" placeholder="Add New Packaging"
                          required="" value="Add New Packaging">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Title *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang735" placeholder="Title" required=""
                          value="Title">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Subtitle *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang736" placeholder="Subtitle" required=""
                          value="Subtitle">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Duration *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang737" placeholder="Duration" required=""
                          value="Duration">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Price *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang738" placeholder="Price" required=""
                          value="Price">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Create *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang739" placeholder="Create" required=""
                          value="Create">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Save *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang740" placeholder="Save" required=""
                          value="Save">
                      </div>
                    </div>

                    <hr>

                    <h4 class="text-center">BANNER</h4>

                    <hr>



                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Current Banner *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang520" placeholder="Current Banner" required=""
                          value="Current Banner">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Prefered Size: (1920x220) or Relevant Sized Image *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang521"
                          placeholder="Prefered Size: (1920x220) or Relevant Sized Image" required=""
                          value="Prefered Size: (1920x220) or Relevant Sized Image">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Upload Banner *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang522" placeholder="Upload Banner" required=""
                          value="Upload Banner">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Save *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang523" placeholder="Save" required=""
                          value="Save">
                      </div>
                    </div>


                    <hr>

                    <h4 class="text-center">SHIPPING COST</h4>

                    <hr>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Shipping Cost *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang524" placeholder="Shipping Cost" required=""
                          value="Shipping Cost">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Save *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang525" placeholder="Save" required=""
                          value="Save">
                      </div>
                    </div>

                    <hr>

                    <h4 class="text-center">SOCIAL LINKS</h4>

                    <hr>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Facebook *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang526" placeholder="Facebook " required=""
                          value="Facebook ">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Google Plus *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang527" placeholder="Google Plus" required=""
                          value="Google Plus">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Twitter *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang528" placeholder="Twitter" required=""
                          value="Twitter">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Linkedin *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang529" placeholder="Linkedin" required=""
                          value="Linkedin">
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-area">
                          <h4 class="heading">Save *</h4>
                          <p class="sub-heading">(In Any Language)</p>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <input type="text" class="input-field" name="lang530" placeholder="Save" required=""
                          value="Save">
                      </div>
                    </div>








                    {{-- VENDOR PANEL ENDS --}}

                  </div>

                </div>
              </div>


              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">

                  </div>
                </div>
                <div class="col-lg-7">
                  <button class="addProductSubmit-btn" type="submit">Create Language</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
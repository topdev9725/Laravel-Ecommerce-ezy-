        <!-- ---------------------------------- Responsive area start ---------------------    -->
         <!-- <div class="col-lg-6 col-md-6 col-6 ezy-response-btn text-left">
            <a href="javascript:show_dashboard_menu()"><img src="{{ asset('assets/images/menu_icon.png') }}" style="width:22px"></img></a>
         </div> -->
         
          <!-- @if(Auth::user()->is_provider == 1)
          <div class="col-lg-6 col-md-6 col-6 ezy-response-btn text-right"><img
                  src="{{ Auth::user()->photo ? asset(Auth::user()->photo):asset('assets/images/'.$gs->user_image) }}" style="width:30px">
          </div>
          @else
          <div class="col-lg-6 col-md-6 col-6 ezy-response-btn text-right"><img
                  src="{{ Auth::user()->photo ? asset('assets/images/users/'.Auth::user()->photo):asset('assets/images/'.$gs->user_image) }}" style="width:30px">
          </div>
          @endif -->
          
        <div class="col-lg-12 wrap-core-nav-list right" id="responsive-list" style="display:none;margin-top:12px">
            <ul class="menu core-nav-list card" style="box-shadow: 0px 0px 23px -6px rgba(0,0,0,0.2);">
                @php 

                  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
                  {
                    $link = "https"; 
                  }
                  else
                  {
                    $link = "http"; 
                      
                    // Here append the common URL characters. 
                    $link .= "://"; 
                      
                    // Append the host(domain name, ip) to the URL. 
                    $link .= $_SERVER['HTTP_HOST']; 
                      
                    // Append the requested resource location to the URL 
                    $link .= $_SERVER['REQUEST_URI']; 
                  }      

                @endphp
              <li style="padding:10px 20px">
                <a href="{{ route('user-dashboard') }}" class="active">
                  {{ $langg->lang200 }}
                </a>
              </li>
              
              @if(Auth::user()->IsVendor())
                <li style="padding:10px 20px">
                  <a href="{{ route('vendor-dashboard') }}" class="active">
                    {{ $langg->lang230 }}
                  </a>
                </li>
              @endif
              
              <li style="padding:10px 20px">
                <a href="{{ route('front.autodebit') }}" class="active">
                  Autodebit
                </a>
              </li>

              <li style="padding:10px 20px">
                <a href="{{ route('user-orders') }}" class="active">
                  {{ $langg->lang201 }}
                </a>
              </li>

              <li style="padding:10px 20px">
                <a href="{{route('user-deposit-index')}}" class="active">{{ $langg->lang819 }}</a>
              </li>
  
              <li class="{{ $link == route('user-transactions-index') ? 'active':'' }}" style="padding:10px 20px">
                <a href="{{route('user-transactions-index')}}" class="active">{{ $langg->lang820 }}</a>
              </li>


              @if($gs->is_affilate == 1)

                <li class="{{ $link == route('user-affilate-code') ? 'active':'' }}" style="padding:10px 20px">
                    <a href="{{ route('user-affilate-code') }}">{{ $langg->lang202 }}</a>
                </li>

                <!--<li class="{{ $link == route('user-wwt-index') ? 'active':'' }}" style="padding:10px 20px">
                    <a href="{{route('user-wwt-index')}}">{{ $langg->lang203 }}</a>
                </li>-->
                
                <li class="{{ $link == route('user-affilate-users') ? 'active':'' }}" style="padding:10px 20px">
                    <a href="{{ route('user-affilate-users') }}">{{ __('Affiliate Users') }}</a>
                </li>

              @endif


              <li class="{{ $link == route('user-order-track') ? 'active':'' }}" style="padding:10px 20px">
                  <a href="{{route('user-order-track')}}">{{ $langg->lang772 }}</a>
              </li>
                <!--
              <li class="{{ $link == route('user-favorites') ? 'active':'' }}" style="padding:10px 20px">
                  <a href="{{route('user-favorites')}}">{{ $langg->lang231 }}</a>
              </li>

              <li class="{{ $link == route('user-messages') ? 'active':'' }}" style="padding:10px 20px">
                  <a href="{{route('user-messages')}}">{{ $langg->lang232 }}</a>
              </li>
              <li class="{{ $link == route('user-dmessage-index') ? 'active':'' }}" style="padding:10px 20px">
                  <a href="{{route('user-dmessage-index')}}">{{ $langg->lang250 }}</a>
              </li>
              -->

              <li class="{{ $link == route('user-notifications') ? 'active':'' }}" style="padding:10px 20px">
                  <a href="{{route('user-notifications')}}">{{ $langg->lang900 }}</a>
              </li>

              <li class="{{ $link == route('user-profile') ? 'active':'' }}" style="padding:10px 20px">
                <a href="{{ route('user-profile') }}">
                  {{ $langg->lang205 }}
                </a>
              </li>
              
              <!--<li class="{{ $link == route('user-reset-pincode') ? 'active':'' }}" style="padding:10px 20px">-->
              <!--  <a href="{{ route('user-reset-pincode') }}">-->
              <!--   {{ __('Reset Pin Code') }}-->
              <!--  </a>-->
              <!--</li>-->

              <li class="{{ $link == route('user-reset') ? 'active':'' }}" style="padding:10px 20px">
                <a href="{{ route('user-reset') }}">
                 {{ $langg->lang206 }}
                </a>
              </li>
              
              <li class="{{ $link == route('user-ename-index') ? 'active':'' }}" style="padding:10px 20px">
                <a href="{{ route('user-ename-index') }}">
                 {{ __('E-name Card') }}
                </a>
              </li>

              <li style="padding:10px 20px">
                <a href="{{ route('user-logout') }}">
                  {{ $langg->lang207 }}
                </a>
              </li>

            </ul>
        </div>

      <!-- ---------------------------------- Responsive area end ---------------------    -->
        
        <div class="col-lg-4 ezy-desktop-dashbord">
          <div class="user-profile-info-area">
            <ul class="links">
                @php 

                  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
                  {
                    $link = "https"; 
                  }
                  else
                  {
                    $link = "http"; 
                      
                    // Here append the common URL characters. 
                    $link .= "://"; 
                      
                    // Append the host(domain name, ip) to the URL. 
                    $link .= $_SERVER['HTTP_HOST']; 
                      
                    // Append the requested resource location to the URL 
                    $link .= $_SERVER['REQUEST_URI']; 
                  }      

                @endphp
              <li class="{{ $link == route('user-dashboard') ? 'active':'' }}">
                <a href="{{ route('user-dashboard') }}">
                  {{ $langg->lang200 }}
                </a>
              </li>
              
              @if(Auth::user()->IsVendor())
                <li>
                  <a href="{{ route('vendor-dashboard') }}">
                    {{ $langg->lang230 }}
                  </a>
                </li>
              @endif

              <li class="{{ $link == route('user-orders') ? 'active':'' }}">
                <a href="{{ route('user-orders') }}">
                  {{ $langg->lang201 }}
                </a>
              </li>

              <li class="{{ $link == route('user-autodebit-order') ? 'active':'' }}">
                <a href="{{route('user-autodebit-order')}}">
                  AutodebitOrders
                </a>
              </li>

              <li class="{{ $link == route('user-deposit-index') ? 'active':'' }}">
                <a href="{{route('user-deposit-index')}}">{{ $langg->lang819 }}</a>
              </li>
  
              <li class="{{ $link == route('user-transactions-index') ? 'active':'' }}">
                <a href="{{route('user-transactions-index')}}">{{ $langg->lang820 }}</a>
              </li>


              @if($gs->is_affilate == 1)

                <li class="{{ $link == route('user-affilate-code') ? 'active':'' }}">
                    <a href="{{ route('user-affilate-code') }}">{{ $langg->lang202 }}</a>
                </li>

                <!--<li class="{{ $link == route('user-wwt-index') ? 'active':'' }}" style="padding:10px 20px">
                    <a href="{{route('user-wwt-index')}}">{{ $langg->lang203 }}</a>
                </li>-->
                
                <li class="{{ $link == route('user-affilate-users') ? 'active':'' }}">
                    <a href="{{ route('user-affilate-users') }}">{{ __('Affiliate Users') }}</a>
                </li>

              @endif


              <li class="{{ $link == route('user-order-track') ? 'active':'' }}">
                  <a href="{{route('user-order-track')}}">{{ $langg->lang772 }}</a>
              </li>
                <!--
              <li class="{{ $link == route('user-favorites') ? 'active':'' }}">
                  <a href="{{route('user-favorites')}}">{{ $langg->lang231 }}</a>
              </li>
              <li class="{{ $link == route('user-messages') ? 'active':'' }}">
                  <a href="{{route('user-messages')}}">{{ $langg->lang232 }}</a>
              </li>
              <li class="{{ $link == route('user-dmessage-index') ? 'active':'' }}">
                  <a href="{{route('user-dmessage-index')}}">{{ $langg->lang250 }}</a>
              </li>
                -->
              <li class="{{ $link == route('user-notifications') ? 'active':'' }}">
                  <a href="{{route('user-notifications')}}">{{ $langg->lang900 }}</a>
              </li>

              <li class="{{ $link == route('user-profile') ? 'active':'' }}">
                <a href="{{ route('user-profile') }}">
                  {{ $langg->lang205 }}
                </a>
              </li>
              
              <!--<li class="{{ $link == route('user-reset-pincode') ? 'active':'' }}">-->
              <!--  <a href="{{ route('user-reset-pincode') }}">-->
              <!--   {{ __('Reset Pin Code') }}-->
              <!--  </a>-->
              <!--</li>-->

              <li class="{{ $link == route('user-reset') ? 'active':'' }}">
                <a href="{{ route('user-reset') }}">
                 {{ $langg->lang206 }}
                </a>
              </li>
              
              <li class="{{ $link == route('user-ename-index') ? 'active':'' }}">
                <a href="{{ route('user-ename-index') }}">
                 {{ __('E-name Card') }}
                </a>
              </li>

              <li>
                <a href="{{ route('user-logout') }}">
                  {{ $langg->lang207 }}
                </a>
              </li>

            </ul>
          </div>
          @if($gs->reg_vendor == 1)
           <div class="row mt-4">
             <div class="col-lg-12 text-center">
               <a href="{{route('user-vendor-request',8)}}" class="mybtn1 lg">
                 <i class="fas fa-dollar-sign"></i> {{ Auth::user()->is_vendor == 1 ? $langg->lang233 : (Auth::user()->is_vendor == 0 ? $langg->lang233 : $langg->lang237) }}
               </a>
             </div>
           </div>
          @endif
        </div>
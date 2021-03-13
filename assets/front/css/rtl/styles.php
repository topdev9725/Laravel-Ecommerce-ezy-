<?php
header("Content-type: text/css; charset: UTF-8");
if(isset($_GET['color']))
{
  $color = '#'.$_GET['color'];
}
else {
  $color = '#0f78f2';
}

if(isset($_GET['header_color']))
{
  $header_color = '#'.$_GET['header_color'];
}
else {
  $header_color = '#143250';
}

if(isset($_GET['footer_color']))
{
  $footer_color = '#'.$_GET['footer_color'];
}
else {
  $footer_color = '#143250';
}

if(isset($_GET['copyright_color']))
{
  $copyright_color = '#'.$_GET['copyright_color'];
}
else {
  $copyright_color = '#02020c';
}

if(isset($_GET['menu_color']))
{
  $menu_color = '#'.$_GET['menu_color'];
}
else {
  $menu_color = '#02020c';
}

if(isset($_GET['menu_hover_color']))
{
  $menu_hover_color = '#'.$_GET['menu_hover_color'];
}
else {
  $menu_hover_color = '#02020c';
}


?>



.top-header .content .right-content .list ul li .language-selector .language {
  background: <?php echo $header_color; ?>;}
.top-header .content .right-content .list ul li .currency-selector .currency {
  background: <?php echo $header_color; ?>;}

.logo-header {
  background: <?php echo $header_color; ?>; }
  
.logo-header .search-box .categori-container .categoris option {
  background: <?php echo $header_color; ?>; }



.autocomplete-items div {
  background: <?php echo $header_color; ?>;
  border: 0.5px solid <?php echo $header_color; ?>;
}





.footer {
  background: <?php echo $footer_color; ?>;
}



  .footer .copy-bg {
    background: <?php echo $copyright_color; ?>; }

.mybtn1,
.bottomtotop i,
.logo-header .search-box .categori-container .categoris option:hover,
.logo-header .helpful-links ul li.my-dropdown .cart .icon span,
.trending .item .item-img .time,
.hero-area .hero-area-slider .intro-carousel.owl-carousel .owl-controls .owl-nav .owl-prev:hover,
.hero-area .hero-area-slider .intro-carousel.owl-carousel .owl-controls .owl-nav .owl-next:hover,
.hero-area .info-box:hover .icon,
.trending .item .item-img .sale,
.trending .item .item-img .discount,
.trending .item .item-img .extra-list ul li a ,
.trending .item .item-img .extra-list ul li a:hover,
.categori-item .item .item-img .sale,
.categori-item .item .item-img .discount,
.categori-item .item .item-img .extra-list ul li a,
.categori-item .item .item-img .extra-list ul li a:hover,
.flash-deals .flas-deal-slider .item .item-img .discount,
.flash-deals .flas-deal-slider .owl-controls .owl-dots .owl-dot.active,
.hot-and-new-item .categori .section-top .section-title::after,
.blog-area .aside .slider-wrapper .owl-controls .owl-dots .owl-dot.active,
.blog-area .blog-box .blog-images .img .date,
.blog-area .blog-box .details .read-more-btn,
.footer .fotter-social-links ul li a:hover,
.product-details-page .all-item .slidPrv4.slick-arrow,
.product-details-page .all-item .slidNext4.slick-arrow,
.product-details-page .right-area .product-info .contact-seller .list li a:hover,
.product-details-page .right-area .product-info .info-meta-3 .meta-list li.compare a:hover,
.product-details-page #coment-area .all-comments li .single-comment .right-area .replaybtn:hover,
.product-details-page #coment-area .write-comment-area .submit-btn,
.ui-widget-header,
.ui-slider .ui-slider-handle,
.sub-categori .left-area .filter-result-area .body-area .filter-btn,
.sub-categori .left-area .tags-area .body-area .taglist li a:hover,
.sub-categori .right-area .categori-item-area .item .item-img .time,
.sub-categori .right-area .categori-item-area .item .item-img .sale,
.sub-categori .right-area .categori-item-area .item .item-img .discount,
.sub-categori .right-area .categori-item-area .item .item-img .extra-list ul li a:hover,
.sub-categori .right-area .pagination-area .pagination .page-item .page-link.active, 
.sub-categori .right-area .pagination-area .pagination .page-item .page-link:hover,
.sub-categori .modal .modal-dialog .modal-header,
.sub-categori .modal .contact-form .submit-btn,
.cartpage .left-area .table tbody tr td.quantity .qty ul li .qtminus:hover, 
.cartpage .left-area .table tbody tr td.quantity .qty ul li .qtplus:hover,
.cartpage .right-area .order-box .cupon-box #coupon-form button:hover,
.cartpage .right-area .order-box .order-btn,
.blogpagearea .blog-box .blog-images .img .date,
.blogpagearea .blog-box .details .read-more-btn,
.blog-details .blog-content .content .tag-social-link .social-links li a,
.blog-details .comments .comment-box-area li .comment-box .left .replay,
.blog-details .comments .comment-box-area li .comment-box .left .replay:hover,
.blog-details .comments .comment-box-area li .replay-form .replay-form-close:hover,
.blog-details .comments .comment-box-area li .replay-form .replay-comment-btn,
.blog-details .comments .comment-box-area li .replay-form .replay-comment-btn:hover,
.blog-details .write-comment .submit-btn,
.blog-details .write-comment .submit-btn:hover,
.blog-details .blog-aside .tags .tags-list li a:hover,
.contact-us .left-area .contact-form .submit-btn,
.contact-us .right-area .contact-info .left .icon,
.contact-us .right-area .social-links ul li a,
.contact-us .right-area .social-links ul li a:hover,
.login-signup .login-area .submit-btn,
.ui-accordion .ui-accordion-header,
.compare-page-content-wrap .btn__bg,
.user-dashbord .user-profile-details .mycard,
.user-dashbord .user-profile-details .account-info .edit-info-area .edit-info-area-form .back:hover,
.user-dashbord .user-profile-details .account-info .edit-info-area .edit-info-area-form .submit-btn,
.single-wish .remove:hover,
.sub-categori .right-area .categori-item-area .item .item-img .extra-list ul li a 
 {
    background: <?php echo $color; ?>;
}

.section-top .link,
.input-field.error:-ms-input-placeholder,
.input-field.error::-moz-placeholder,
.input-field.error::-webkit-input-placeholder,
.breadcrumb-area .pages li a:hover,
.categories_menu_inner > ul > li > ul.categories_mega_menu > li > a:hover,
.categorie_sub_menu ul li a:hover,
nav .menu li a:hover,
nav .menu li.dropdown.open > a,
.hero-area .hero-area-slider .intro-carousel .intro-content .slider-content .layer-1 .title,
.trending li.ui-tabs-tab.ui-corner-top.ui-state-default.ui-tab.ui-tabs-active.ui-state-active a,
.hero-area .info-box .icon,
.trending .item .info .stars ul li i,
.categori-item .item .info .stars ul li i,
.flash-deals .flas-deal-slider .item .stars ul li i,
.flash-deals .flas-deal-slider .item .price .new-price,
.hot-and-new-item .categori .item-list li .single-box .right-area .stars ul li i,
.footer .copy-bg .content .content a,
.footer .footer-widget ul li a:hover,
.info-link-widget .link-list li a:hover,
.info-link-widget .link-list li a:hover i,
.product-details-page .right-area .product-info .info-meta-1 ul li .stars li i,
.product-details-page .right-area .product-info .contact-seller .title,
.product-details-page .right-area .product-info .contact-seller .list li a,
.product-details-page .right-area .product-info .product-price .price,
 .product-details-page .right-area .product-info .info-meta-3 .meta-list li.compare a,
 .product-details-page #product-details-tab li.ui-tabs-tab.ui-corner-top.ui-state-default.ui-tab.ui-tabs-active.ui-state-active a,
 .product-details-page #product-details-tab ul li a i,
 .product-details-page #product-details-tab ul li a:hover,
 .product-details-page #coment-area .all-comments li .single-comment .right-area .header-area .posttime,
 .sub-categori .left-area .service-center .body-area .list li i,
 .sub-categori .left-area .service-center .footer-area .list li a:hover,
 .sub-categori .right-area .categori-item-area .item .info .stars ul li i,
 .sub-categori .right-area .pagination-area .pagination .page-item .page-link,
 .blog-details .blog-content .content .post-meta li a:hover,
 .blog-details .blog-content .content blockquote,
 .blog-details .blog-aside .categori .categori-list li a:hover,
  .blog-details .blog-aside .categori .categori-list li a.active,
  .blog-details .blog-aside .recent-post-widget .post-list li .post .post-details .post-title:hover,
  .blog-details .blog-aside .archives .archives-list li a:hover,
  .contact-us .contact-section-title .title,
  .login-signup .login-area .header-area .title,
  .login-signup .login-area .form-input i,
  .login-signup .login-area .social-area .title,
  .vendor-top-header .content .single-box .icon,
  .compare-page-content-wrap .pro-ratting i,
  .user-dashbord .user-profile-info-area .links li.active a, 
  .user-dashbord .user-profile-info-area .links li:hover a,
  .thankyou .content .icon,
  .single-wish .right .stars li i,
  .single-wish .right .store-name i
{
    color: <?php echo $color; ?>;
}


.input-field.error,
.trending .item .item-img .extra-list ul li a,
.categori-item .item .item-img .extra-list ul li a,
.product-details-page li.slick-slide,
.product-details-page .right-area .product-info .product-size .siz-list li.active .box,
.sub-categori .right-area .categori-item-area .item .item-img .extra-list ul li a 
{
    border: 1px solid <?php echo $color; ?>;;
}

.input-field.error:focus,
.trending .item .item-img .extra-list ul li a:hover,
.categori-item .item .item-img .extra-list ul li a:hover,
.footer .fotter-social-links ul li a:hover,
.product-details-page .right-area .product-info .contact-seller .list li a:hover,
.product-details-page .right-area .product-info .info-meta-3 .meta-list li.compare a:hover,
.product-details-page #product-details-tab li.ui-tabs-tab.ui-corner-top.ui-state-default.ui-tab.ui-tabs-active.ui-state-active a,
.sub-categori .right-area .categori-item-area .item .item-img .extra-list ul li a:hover,
.cartpage .left-area .table tbody tr td.quantity .qty ul li .qtminus:hover, 
.cartpage .left-area .table tbody tr td.quantity .qty ul li .qtplus:hover,
.cartpage .right-area .order-box .cupon-box #coupon-form button:hover,
.blog-details .comments .comment-box-area li .replay-form .replay-form-close:hover,
.blog-details .blog-aside .tags .tags-list li a:hover
{
    border-color: <?php echo $color; ?>;
}
.loader-1 .loader-outter,
.loader-1 .loader-inner
 {
    border: 4px solid <?php echo $color; ?>;
 }
 

  
 

 .trending .item .item-img .sale::before,
 .trending .item .item-img .discount::before,
 .categori-item .item .item-img .sale::before,
 .categori-item .item .item-img .discount::before,
 .sub-categori .right-area .categori-item-area .item .item-img .sale::before,
 .sub-categori .right-area .categori-item-area .item .item-img .discount::before 
  {
    border-bottom: 22px solid <?php echo $color; ?>;
 }
 .flash-deals .flas-deal-slider .item .item-img .discount::before {
    border-bottom: 30px solid <?php echo $color; ?>;
}
.blog-area .aside .slider-wrapper .slide-item .top-area .left img {
    border: 2px solid <?php echo $color; ?>;
}
.sub-categori .modal .contact-form ul li .input-field:focus,
.contact-us .left-area .contact-form ul li .input-field:focus,
.contact-us .left-area .contact-form .captcha-area li .input-field:focus,
.user-dashbord .user-profile-details .account-info .edit-info-area .edit-info-area-form .input-field:focus 
 {
    border-bottom: 1px solid <?php echo $color; ?> !important; 
}

.blog-details .blog-content .content blockquote {
    border-left: 5px solid <?php echo $color; ?>;
}
.blog-details .comments .comment-box-area li .comment-box .left .img {
    border: 2px solid <?php echo $color; ?>;
 }
 .contact-us .right-area .contact-info {
    border-bottom: 2px solid <?php echo $color; ?>;
}
.page-center ul.pagination li {
    background: <?php echo $color; ?>1a;
}

.page-center ul.pagination li.active {
    background: <?php echo $color; ?>;
}
.logo-header .helpful-links ul li.compare .compare-product .icon span {
  background: <?php echo $color; ?>;
}
.hero-area .info-box .icon {
    background: <?php echo $color; ?>;
    }


.video-play-btn {
  background-color: <?php echo $color; ?>;

  }

    .product-details-page .right-area .product-info .contact-seller .title {
      color: <?php echo $color; ?>;}

        .product-details-page .right-area .product-info .contact-seller .list li a {
          color: <?php echo $color; ?>; }
          .product-details-page .right-area .product-info .contact-seller .list li a:hover {
            background: <?php echo $color; ?>;
            border-color: <?php echo $color; ?>; }
    .product-details-page .right-area .product-info .product-price .price {
      color: <?php echo $color; ?>;}
        .product-details-page .right-area .product-info .product-size .siz-list li.active .box {
          border: 1px solid <?php echo $color; ?>; }



          .product-details-page .right-area .product-info .product-color .color-list li .box.color5 {
            background:<?php echo $color; ?>; }






      
          .product-details-page #product-details-tab.ui-tabs .ui-tabs-panel .heading-area .reating-area .stars {
            background: <?php echo $color; ?>;}
        .login-btn {
            background-color: <?php echo $color; ?>; 
            border-color: <?php echo $color; ?>;
        }
        .product-details-page #product-details-tab .top-menu-area ul li a::after {
          background: <?php echo $color; ?>;}

        .trending .item .item-img .extra-list ul li span {
          border: 1px solid <?php echo $color; ?>;
          background: <?php echo $color; ?>;}

      .item .item-img .extra-list ul li span {
        border: 1px solid <?php echo $color; ?>;
        background: <?php echo $color; ?>;
         }
      .item .item-img .extra-list ul li span:hover {
        background: <?php echo $color; ?>;
        border-color: <?php echo $color; ?>;}
      .flash-deals .flas-deal-slider .item .price .new-price {
        color: <?php echo $color; ?>;}
        .footer .footer-widget ul li a:hover {
          color: <?php echo $color; ?>; }
        .info-link-widget .link-list li a:hover i {
          color: <?php echo $color; ?>; }
      .footer .copy-bg .content .content a {
        color: <?php echo $color; ?>; }

       .login-area .header-area .title {
        color: <?php echo $color; ?>; }
      .login-area .form-input i {
        color: <?php echo $color; ?>; }
      .login-area .social-area .title {
        color: <?php echo $color; ?>;
      }
          .blog-details .blog-aside .categori .categori-list li a:hover, .blog-details .blog-aside .categori .categori-list li a.active {
            color: <?php echo $color; ?>; }
              .blog-details .blog-aside .recent-post-widget .post-list li .post .post-details .post-title:hover {
                color: <?php echo $color; ?>; }
          .blog-details .blog-aside .archives .archives-list li a:hover {
            color: <?php echo $color; ?>; }

.taglist a.active {
   background: <?php echo $color; ?>;
}
     .login-area .submit-btn {
      background:<?php echo $color; ?>; }

  .comment-log-reg-tabmenu .nav-tabs .nav-link {
    background: #143250; }
.comment-log-reg-tabmenu .nav-tabs .nav-link.active {
    background: <?php echo $color; ?>;
}
    
          .trending .item .item-img .extra-list ul li span:hover {
            background: <?php echo $color; ?>;
            border-color: <?php echo $color; ?>; }

        .user-dashbord .user-profile-info-area .links li.active a, .user-dashbord .user-profile-info-area .links li:hover a {
          color: <?php echo $color; ?>;
  }
    .user-dashbord .user-profile-details .order-details .view-order-page .print-order a {
      background: <?php echo $color; ?>; }

      .upload-img .file-upload-area .upload-file span {
        background: <?php echo $color; ?>; }
    .thankyou .content .icon {
      color: <?php echo $color; ?>; }

  #product-details-tab #replay-area .write-comment-area .submit-btn {
    background: <?php echo $color; ?>;
}
  #product-details-tab #comment-area .write-comment-area .submit-btn {
    background: <?php echo $color; ?>;
 }
 #style-switcher h2 a {
  background: <?php echo $color; ?>;
}
.categorie_sub_menu ul li a:hover {
  color: <?php echo $color; ?>; }

  .elegant-pricing-tables h3 .price-sticker,
.elegant-pricing-tables:hover,
.elegant-pricing-tables.active,
.elegant-pricing-tables:hover .price,
.elegant-pricing-tables.active .price,
.elegant-pricing-tables.style-2 .price,
.elegant-pricing-tables .btn {
    background: <?php echo $color; ?>;
}
 .logo-header .helpful-links ul li.my-dropdown.profilearea  .profile .img img{
  border: 2px solid <?php echo $color; ?>;
 }
 a.sell-btn {
    background: <?php echo $color; ?>;
}
 .top-header .content .right-content .list ul li a.sell-btn:hover {
 transition: 0.3s;
 background: #fff;
color: <?php echo $color; ?>;
}
.sub-categori .left-area .service-center .body-area .list li i {
  color: <?php echo $color; ?>; 
}
.sub-categori .left-area .service-center .footer-area .list li a:hover {
  color: <?php echo $color; ?>; }
.breadcrumb-area .pages li a:hover {
  color: <?php echo $color; ?>; }
.cartpage .left-area .table tbody tr td.quantity .qty ul li .qtminus1:hover, .cartpage .left-area .table tbody tr td.quantity .qty ul li .qtplus1:hover {
  background: <?php echo $color; ?>;
  border-color: <?php echo $color; ?>; }
.cupon-box #coupon-form button:hover {
  background: <?php echo $color; ?>;
  border-color: <?php echo $color; ?>; }
.cupon-box #check-coupon-form button:hover {
  background: <?php echo $color; ?>;
  border-color: <?php echo $color; ?>; }
  .categories_menu_inner > ul > li > ul.categories_mega_menu > li > a:hover {
  color: <?php echo $color; ?>; }
              .contact-us .left-area .contact-form .form-input i {
              color: <?php echo $color; ?>; 
            }
      .message-modal .modal .modal-dialog .modal-header {
        background:  <?php echo $color; ?>; }

      .message-modal .modal .contact-form .submit-btn {
        background:  <?php echo $color; ?>; }



.logo-header .search-box .categori-container .categoris option:focus{
  background: <?php echo $color; ?>;
}
        .product-details-page .right-area .product-info .mproduct-size .siz-list li.active .box {
          border: 1px solid <?php echo $color; ?>; }
 
  .trending .owl-carousel .owl-controls .owl-nav .owl-prev,
  .trending .owl-carousel .owl-controls .owl-nav .owl-next {

    background: <?php echo $color; ?>;
    border: 1px solid <?php echo $color; ?>;
    }
    .trending .owl-carousel .owl-controls .owl-nav .owl-prev:hover,
    .trending .owl-carousel .owl-controls .owl-nav .owl-next:hover {
      color: <?php echo $color; ?>;
    }
    .section-top .section-title::after{
      background: <?php echo $color; ?>;
    }
    .item .add-to-cart-btn{
      background: <?php echo $color; ?>;
      border: 1px solid <?php echo $color; ?>;
    }
    .item .add-to-cart-btn:hover {
      color: <?php echo $color; ?>;
  }    
  .flash-deals .owl-carousel .owl-controls .owl-nav .owl-prev,
  .flash-deals .owl-carousel .owl-controls .owl-nav .owl-next {
    background: <?php echo $color; ?>;
    border: 1px solid <?php echo $color; ?>;
    }
    .flash-deals .owl-carousel .owl-controls .owl-nav .owl-prev:hover,
    .flash-deals .owl-carousel .owl-controls .owl-nav .owl-next:hover {
      color: <?php echo $color; ?>;
    }
      .flash-deals .flas-deal-slider .item .price .new-price {
        color: <?php echo $color; ?>;}

        .flash-deals .flas-deal-slider .item .deal-counter span {
          color: <?php echo $color; ?>;
          }
          .hot-and-new-item .owl-carousel .owl-controls .owl-nav .owl-prev,
          .hot-and-new-item .owl-carousel .owl-controls .owl-nav .owl-next {
            border: 1px solid <?php echo $color; ?>;
            color: <?php echo $color; ?>;
            }
            .hot-and-new-item .owl-carousel .owl-controls .owl-nav .owl-prev:hover,
            .hot-and-new-item .owl-carousel .owl-controls .owl-nav .owl-next:hover {
              background: <?php echo $color; ?>!important;

            }

        .product-details-page .right-area .product-info .info-meta-3 .meta-list li.addtocart a {

          border: 1px solid #ff5500;
          background: <?php echo $color; ?>; }
          .product-details-page .right-area .product-info .info-meta-3 .meta-list li.addtocart a:hover {
            color: <?php echo $color; ?>; }
        .product-details-page .right-area .product-info .info-meta-3 .meta-list li.addtocart a {
          border: 1px solid <?php echo $color; ?>;
          background: <?php echo $color; ?>;
          }
          .product-details-page .right-area .product-info .info-meta-3 .meta-list li.addtocart a:hover {
            color: <?php echo $color; ?>; }

        .product-details-page .right-area .product-info .info-meta-3 .meta-list li.favorite a, .product-details-page .right-area .product-info .info-meta-3 .meta-list li.compare a {
          border: 1px solid <?php echo $color; ?>;
          background: <?php echo $color; ?>;}
          .product-details-page .right-area .product-info .info-meta-3 .meta-list li.favorite a:hover, .product-details-page .right-area .product-info .info-meta-3 .meta-list li.compare a:hover {
                      background: #fff;
            color: <?php echo $color; ?>; }

                .seller-info .content .title {
                  color: <?php echo $color; ?>;
                 }


                  .seller-info .content .total-product p {
                    color: <?php echo $color; ?>;
                   }


              .seller-info .view-stor {
                background: <?php echo $color; ?>;

                border: 1px solid <?php echo $color; ?>;

                }
                .seller-info .view-stor:hover{
                  background: #fff;
                  color: <?php echo $color; ?>;
                }
          .product-details-page .categori .owl-carousel .owl-controls .owl-nav .owl-prev,
          .product-details-page .categori .owl-carousel .owl-controls .owl-nav .owl-next {
            color: <?php echo $color; ?>;
                border: 1px solid <?php echo $color; ?>;
            }
  .product-details-page .xzoom-container .owl-carousel .owl-controls .owl-nav .owl-prev,
  .product-details-page .xzoom-container .owl-carousel .owl-controls .owl-nav .owl-next {

    background: <?php echo $color; ?>;
    border: 1px solid <?php echo $color; ?>;

    }
            

            .subscribePreloader__text {
    background: <?php echo $color; ?>c7;
}

          .logo-header .helpful-links ul li.my-dropdown .my-dropdown-menu .dropdownmenu-wrapper .dropdown-cart-action .mybtn1 {

            border: 1px solid  <?php echo $color; ?>;
          }
  .mybtn1:hover {
    color: <?php echo $color; ?> !important;
      border: 1px solid <?php echo $color; ?>;
    }
    .mybtn2:hover {
      background: <?php echo $color; ?>;
      border: 1px solid <?php echo $color; ?>;
    }
.top-header .content .right-content .list li .track-btn:hover{
  background: <?php echo $color; ?>;
}
input[type=checkbox]:checked + label:before {
  background-color: <?php echo $color; ?>;
  border-color: <?php echo $color; ?>;
}
    .radio-design .checkmark::after{
      background: <?php echo $color; ?>;
    }
     .order-box .order-btn {
      background: <?php echo $color; ?>;
 }
.mybtn1 {
  border: 1px solid <?php echo $color; ?>;
  }
  .mybtn2 {
    color: <?php echo $color; ?> !important;
  border: 1px solid <?php echo $color; ?>;
  }

.checkout-area .checkout-process li a:hover{
  background: <?php echo $color; ?>;

}
.checkout-area .checkout-process li a:hover::before{
  border-right: 20px solid <?php echo $color; ?>;
}
.checkout-area .checkout-process li a.active{
  background: <?php echo $color; ?>;

}
.checkout-area .checkout-process li a.active::before{
  border-right: 20px solid <?php echo $color; ?>;
}
.checkout-area  .content-box .content .billing-info-area .info-list li p i{
  color: <?php echo $color; ?>;
}
  .checkout-area  .content-box .content .payment-information .nav a span::after{
    background: <?php echo $color; ?>;
  }
      .hero-area .hero-area-slider .intro-carousel .intro-content .slider-content .layer-3 a {
      border: 1px solid <?php echo $color; ?>;
    }
    .hero-area .hero-area-slider .intro-carousel .intro-content .slider-content .layer-3 a:hover {
      border: 1px solid <?php echo $color; ?>;
      color: <?php echo $color; ?>;
    }    

  .order-tracking-content .track-form .mybtn1{
    border: 1px solid <?php echo $color; ?>;

  }  
  .order-tracking-content .tracking-form .mybtn1{
    border: 1px solid  <?php echo $color; ?>;
  }
  .tracking-steps li.done:after,
  .tracking-steps li.active:after,
  .tracking-steps li.active .icon{
  background: <?php echo $color; ?>;
  }
  .modal-header .close:hover {
  background-color: <?php echo $color; ?>;
}
.logo-header .helpful-links ul li.wishlist .wish span {
          background: <?php echo $color; ?>;
          }
          .top-header {
  background: <?php echo $color; ?>;

  }
  .logo-header .search-box .search-form button {
        background: <?php echo $color; ?>;
        }
  .categories_title {
  background: <?php echo $color; ?>;
 }
 nav .menu li:last-child a{
    color: <?php echo $color; ?>;
  }

  .blog-area .blog-box .details .read-more-btn:hover {
    color: <?php echo $color; ?>;
}
.blog-area .blog-box .details .read-more-btn {

        border: 1px solid <?php echo $color; ?>;
        }

  .blogpagearea .blog-box .details .read-more-btn {
        border: 1px solid <?php echo $color; ?>;

        }
        .blogpagearea .blog-box .details .read-more-btn:hover {
          color: <?php echo $color; ?>;
        }
        .contact-us .left-area .contact-form .submit-btn {
        border: 1px solid <?php echo $color; ?>;
        }
        .contact-us .left-area .contact-form .submit-btn:hover {
          color: <?php echo $color; ?>;
          }
          .process-steps li.done:after,
  .process-steps li.active:after,
  .process-steps li.active .icon{
  background: <?php echo $color; ?>;
  }
  .sub-categori .left-area .filter-result-area .body-area .filter-btn {
        border: 1px solid <?php echo $color; ?>;
        }
        .sub-categori .left-area .filter-result-area .body-area .filter-btn:hover {
          color: <?php echo $color; ?>;
          }
          .category-page  .bg-white .sub-category-menu .category-name a{
  color: <?php echo $color; ?>;

}
.category-page  .bg-white .sub-category-menu ul li a:hover{
  color: <?php echo $color; ?>;
}
.category-page  .bg-white .sub-category-menu ul li ul li a:hover i,
.category-page  .bg-white .sub-category-menu ul li ul li a:hover 
{
  color: <?php echo $color; ?>;
}
#product-details-tab #comment-area .write-comment-area .submit-btn{
    border: 1px solid <?php echo $color; ?>;
}
#product-details-tab #replay-area .write-comment-area .submit-btn {
    border: 1px solid <?php echo $color; ?>;
}
#product-details-tab #replay-area .write-comment-area .submit-btn:hover {
      color: <?php echo $color; ?>;
      }
      #product-details-tab #comment-area .write-comment-area .submit-btn:hover {
      color: <?php echo $color; ?>;
      }

      @media (max-width: 991px) {
      nav .nav-header .toggle-bar {
        color: <?php echo $color; ?>;
        }      
    }

    .product-details-page .xzoom-container .owl-carousel .owl-controls .owl-nav .owl-prev:hover,
    .product-details-page .xzoom-container .owl-carousel .owl-controls .owl-nav .owl-next:hover {
      color: <?php echo $color; ?>;
    }

    .product-details-page .categori .owl-carousel .owl-controls .owl-nav .owl-prev:hover,
.product-details-page .categori .owl-carousel .owl-controls .owl-nav .owl-next:hover {
  background: <?php echo $color; ?> !important;

}
.slider-buttom-category .single-category::before {
  background: <?php echo $color; ?>;

}
.custom-control-input:checked~.custom-control-label::before {
    border-color: <?php echo $color; ?>;
    background-color: <?php echo $color; ?>;
}
        #product-details-tab #comment-area .all-comment li .single-comment .left-area img {

          border: 2px solid <?php echo $color; ?>;
 }

         #product-details-tab #replay-area .all-replay li .single-review .left-area img {

          border: 2px solid <?php echo $color; ?>;
}
.wholesell-details-page{
  background: <?php echo $color; ?>0f;
}
.sub-categori .left-area .filter-result-area .body-area .filter-list li a:hover{
  color: <?php echo $color; ?>;
}
      .contact-us .right-area .contact-info .content a:hover {
    color: <?php echo $color; ?>;
 }
       #product-details-tab #comment-area .all-comment li .replay-area button {
        background: <?php echo $color; ?>;
        }
        .brand-section .owl-carousel .owl-controls .owl-nav .owl-prev,
  .brand-section .owl-carousel .owl-controls .owl-nav .owl-next {
    background: <?php echo $color; ?>;
 }        
 .single-box .right-area .action-meta li .wish {
    background: <?php echo $color; ?>;
 }          
 .single-box .right-area .action-meta li .cart-btn {
  background: <?php echo $color; ?>;
}
  .single-box .right-area .action-meta li .compear {
    background: <?php echo $color; ?>;
}        
.product-tab .section-top .nav .nav-item .nav-link::before {
    background: <?php echo $color; ?> !important;
}
.product-tab .section-top .nav .nav-item .nav-link::after {
    border-top: 8px solid <?php echo $color; ?>;
 }
.item .item-cart-area ul li span{
    background: <?php echo $color; ?>;
}
.featured-link-box .title{
    color: <?php echo $color; ?>;
  }
  .mybtn1.sm{
    color: <?php echo $color; ?> !important;
      border: 1px solid <?php echo $color; ?>;
    }
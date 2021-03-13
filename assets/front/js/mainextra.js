$(function ($) {
    "use strict";


    $(document).ready(function () {

        $(function(){

            var url = window.location.pathname,
                urlRegExp = new RegExp(url.replace(/\/$/,'') + "$");

            // now grab every link from the navigation
            $('.core-nav-list li a').each(function(){
                // and test its normalized href against the url pathname regexp
                if(urlRegExp.test(this.href.replace(/\/$/,''))){
                    $(this).addClass('active');
                }
            });

        });

        /*------addClass/removeClass categories-------*/
        var w = window.innerWidth;



        /*------addClass/removeClass categories-------*/




        /*------addClass/removeClass categories-------*/



        $('#example').DataTable({
            "paging":   true,
            "ordering": true,
            "info":     true
        });


        //   magnific popup activation
        $('.video-play-btn').magnificPopup({
            type: 'video'
        });
        $('.img-popup').magnificPopup({
            type: 'image'
        });


// Tooltip Section

        $('[data-toggle="tooltip"]').tooltip({

        });

        $('[rel-toggle="tooltip"]').tooltip();

        $('[data-toggle="tooltip"]').on('click',function(){
            $(this).tooltip('hide');
        })


        $('[rel-toggle="tooltip"]').on('click',function(){
            $(this).tooltip('hide');
        })

// Tooltip Section Ends

        /*-----------------------------
            Accordion Active js
        -----------------------------*/
        $("#accordion, #accordion2").accordion({
            heightStyle: "content",
            collapsible: true,
            icons: {
                "header": "ui-icon-caret-1-e",
                "activeHeader": " ui-icon-caret-1-s"
            }
        });
        $("#product-details-tab").tabs();


  



        // flas_deal_slider
        var $flas_deal_slider = $('.flas-deal-slider');

        if ($flas_deal_slider.children().length > 1) {
            $flas_deal_slider.owlCarousel({
                loop: true,
                nav: true,
                navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
                dots: false,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 6000,
                smartSpeed: 1000,
                responsive: {
                    0: {
                        items: 1,
                    },
                    414: {
                        items: 2,
                    },
                    768: {
                        items: 2,
                    },
                    992: {
                        items: 3
                    },
                    1200: {
                        items: 4
                    }
                }
            });

        }



        // Product deal countdown
        $('[data-countdown]').each(function () {
            var $this = $(this),
                finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function (event) {
                $this.html(event.strftime('<span>%D : <small>Days</small></span> <span>%H : <small>Hrs</small></span>  <span>%M : <small>Min</small></span> <span>%S <small>Sec</small></span>'));
            });
        });

        // trending item  slider
        var $trending_slider = $('.trending-item-slider');
        $trending_slider.owlCarousel({
            items: 4,
            autoplay: false,
            margin: 0,
            loop: true,
            dots: true,
            nav: true,
            center: false,
            autoplayHoverPause: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            smartSpeed: 800,
            responsive: {
                0: {
                    items: 1,
                },
                414: {
                    items: 2,
                },
                768: {
                    items: 2,
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        });


        // aside_review_slider
        var $aside_review_slider = $('.aside-review-slider');

        if ($aside_review_slider.children().length > 1) {

            $aside_review_slider.owlCarousel({
                loop: true,
                nav: false,
                dots: true,
                margin: 30,
                autoplay: true,
                autoplayTimeout: 6000,
                smartSpeed: 1000,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 1
                    }
                }
            });

        }

        /**------------------------------
         * Product Details  carousel
         * ---------------------------**/
        $('.one-item-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.all-item-slider',
            responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
                {
                    breakpoint: 767,
                    settings: {
                        horizontal: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $('.all-item-slider').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.one-item-slider',
            arrows: true,
            prevArrow: '<i class="fa fa fa-chevron-up slidPrv4"></i>',
            nextArrow: '<i class="fa fa-chevron-down slidNext4"></i>',
            dots: false,
            centerMode: true,
            centerPadding: '0px',
            focusOnSelect: true,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            }]
        });
    });

    /**------------------------------
     * Quick View
     * ---------------------------**/
    $('.quick-one-item-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.quick-all-item-slider',
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        },
            {
                breakpoint: 767,
                settings: {
                    vertical: false,
                    horizontal: true,
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.quick-all-item-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.quick-one-item-slider',
        arrows: true,
        prevArrow: '<i class="fa fa fa-chevron-up slidPrv4"></i>',
        nextArrow: '<i class="fa fa-chevron-down slidNext4"></i>',
        dots: false,
        centerMode: true,
        centerPadding: '0px',
        focusOnSelect: true,
        responsive: [{
            breakpoint: 768,
            settings: {
                vertical: false,
                slidesToShow: 3
            }
        }]
    });



    // brand_slider
    var $brand_slider = $('.brand-slider');
    $brand_slider.owlCarousel({
        loop: true,
        dots: false,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 0,
        autoplay: false,
        items: 4,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 2
            },
            768: {
                items: 3
            },
            768: {
                items: 4
            },
            992: {
                items: 4
            },
            1650: {
                items: 4
            }
        }
    });


});
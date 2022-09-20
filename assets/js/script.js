( function( $ ) {
    $(document).ready(function() {
        //Breaking News
        $(".breaking-news .carousel-item").first().addClass("active");
        //masonry
        if ( $(".masonry").length ){
            var $masonry = $('.masonry .masonry-wrap');
            $masonry.imagesLoaded( function() {
                $masonry.masonry({
                    itemSelector: '.hentry',
                    //isAnimated: true,
                    isFitWidth: true,
                    animationOptions: {
                        duration: 500,
                        easing: 'linear'
                    }
                });
            });
        }
        //Back To Top
        if ($('#back-to-top').length) {
            var scrollTrigger = 100, // px
                backToTop = function () {
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > scrollTrigger) {
                        $('#back-to-top').addClass('show');
                    } else {
                        $('#back-to-top').removeClass('show');
                    }
                };
            backToTop();
            $(window).on('scroll', function () {
                backToTop();
            });
            $('#back-to-top').on('click', function (e) {
                e.preventDefault();
                $('html,body').animate({
                    scrollTop: 0
                }, 700);
            });
        }
        //widget featured post
        // if ( ('.featured-mag-post-widget').length ){
        //     $( '.featured-col-6 .featured-mag-thumb img' ).each( function() {
        //         var isMobile = /Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent);
        //         if (jQuery(window).width() < 1199 || isMobile) {
        //         } else {
        //             if (jQuery('.boxed').length) {
        //                 jQuery('.featured-col-6 .featured-mag-thumb img').fakecrop({
        //                     wrapperWidth : 700,
        //                     wrapperHeight : 428,
        //                     squareWidth : false
        //                 });
        //             }else{
        //                 jQuery('.featured-col-6 .featured-mag-thumb img').fakecrop({
        //                     wrapperWidth : 700,
        //                     wrapperHeight : 460,
        //                     squareWidth : false
        //                 });
        //             }
        //         }
        //     } );
        // }
        //widget latest posts
        if ( ( '.latest-posts-carousel' ).length ){
            $( '.latest-posts-carousel' ).each( function() {
                $('.latest-posts-carousel').owlCarousel({
                    margin: 30,
                    nav: true,
                    autoplay: true,
                    loop: true,
                    responsive:{
                        0:{
                            items:1
                        },
                        600:{
                            items:2
                        },
                        1000:{
                            items:3
                        }
                    }
                });
            });
        }
        //widget trending posts
        if ( ( '.trending-slick-carousel' ).length ){
            $( '.trending-slick-carousel' ).each( function() {
                jQuery('.trending-slick-carousel').slick({
                    dots: false,
                    arrows: true,
                    vertical: true,
                    slidesToShow: 4,
                    slidesToScroll: 2,
                    verticalSwiping: true
                });
            })
        }
    });
})( jQuery );
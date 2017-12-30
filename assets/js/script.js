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
    });
    //Trending
    $('.trending-carousel .vertical .carousel-item').each(function(){
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        $('.trending-carousel').find('.carousel-item').first().addClass('active');
        next.children(':first-child').clone().appendTo($(this));

        for (var i=1;i<3;i++) {
            next=next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }

            next.children(':first-child').clone().appendTo($(this));
        }
    });
})( jQuery );
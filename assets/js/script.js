( function( $ ) {
    $(document).ready(function() {
        //Breaking News
        $(".breaking-news .carousel-item").first().addClass("active");
        //Latest Post Carousel
        $('.latest-posts-carousel').owlCarousel({
            margin:30,
            nav:true,
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

    });

})( jQuery );
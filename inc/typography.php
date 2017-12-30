<?php

/**
 * Timagazine Typography & Color Settings
 *
 */

function timagazine_typography_color($color) {

    $color = '';

    /**
     * Body
     */
    $body_text_color = get_theme_mod( 'bg_text_color', '#555' );
    $body_font_size = get_theme_mod( 'body_font_size', '14' );
    $body_font_weight = get_theme_mod( 'body_font_weight', '400' );

    $color .= "body { font-weight:" . esc_attr($body_font_weight) .";} ";
    $color .= "body,.woocommerce ul.products li.product .price { font-size: " . esc_attr($body_font_size) . "px; } ";
    $color .= "body,.woocommerce ul.products li.product .price,.woocommerce div.product p.price, .woocommerce div.product span.price { color:" . esc_attr( $body_text_color ) . "; } ";

    /**
     * Font Family
     */
    //body font family
    $body_font_family = get_theme_mod('body_font_family');
    if ( $body_font_family !='' ) {
        $color .= "body{ font-family:" . esc_attr( $body_font_family ) . ";}";
    }else{
        $color .= "body{ font-family: 'Poppins', sans-serif;}";
    }
    //heading font family
    $heading_font_family = get_theme_mod('heading_font_family');
    if ( $heading_font_family !='' ) {
        $color .= "h1,h2,h3,h4,h5,h6{ font-family:" . esc_attr( $heading_font_family ) . ";}";
    }else{
        $color .= "h1,h2,h3,h4,h5,h6{ font-family: 'Poppins', sans-serif;}";
    }

    /**
     * Heading
     */
    $heading_color = get_theme_mod( 'heading_color', '#333' );
    $heading_font_weight = get_theme_mod( 'heading_font_weight', '600' );
    $color .= "h1, h2, h3, h4, h5, h6,h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6{ color:" . esc_attr( $heading_color ) . "; font-weight:" . esc_attr( $heading_font_weight ) .";} ";

    /**
     * Link
     */
    if ( get_theme_mod( 'link_color', '#f4b738' ) ){
        $color .= "a ,.current-menu-item a,.main-menu a:hover,.dropdown-item:focus, .dropdown-item:hover,.dropdown-item.active, .dropdown-item:active,.footer-main .tagcloud a:hover{ color:" . esc_attr( get_theme_mod( 'link_color', '#f4b738' ) ) . "} ";
    }

    $link_hover_color = get_theme_mod( 'link_hover_color', '#204056' );
    $color .= "a:hover,a:focus { color:" . esc_attr( $link_hover_color ) . "} ";

    /**
     * Header Tob Bar Header-1
     */
    if ( get_theme_mod( 'enable_top_bar' ) ) :

        $top_bar_bg = get_theme_mod( 'top_bar_bg' );
        $top_bar_font_color = get_theme_mod( 'top_bar_font_color', '#222627' );
        $top_bar_font_size = get_theme_mod( 'top_bar_font_size', '13' );
        $top_bar_top_padding = get_theme_mod( 'top_bar_top_padding', '7' );
        $top_bar_bottom_padding = get_theme_mod( 'top_bar_bottom_padding', '7' );
        $breaking_news_title_bg = get_theme_mod( 'breaking_news_title_bg', '#222627' );

        //Top Bar BG Color
        $color .= ".top-bar { background-color:" . esc_attr( $top_bar_bg ) . "; }";
        //Top Bar Text Color
        $color .= ".top-bar a,.top-bar  { color:" . esc_attr( $top_bar_font_color ) . "; }";
        //Top Bar Font Size
        $color .= ".top-bar a,.top-bar { font-size:" . intval( $top_bar_font_size ) . "px; }";
        //Top Bar Top Padding
        $color .= ".top-bar { padding-top:" . intval( $top_bar_top_padding ) . "px; }";
        //Top Bar Bottom Padding
        $color .= ".top-bar { padding-bottom:" . intval( $top_bar_bottom_padding ) . "px; }";
        //Top Bar Breaking News Title BG
        $color .= ".top-news-feed-title { background-color:" . esc_attr( $breaking_news_title_bg ) . "; }";
        //Top Bar Current Date
        $color .= ".current-date { color:" . esc_attr( $breaking_news_title_bg ) . "; }";

    endif;

    /**
     * Header Design Options
     */
    $header_bg_color = get_theme_mod( 'header_bg_color', '#ffffff' );
    $header_border_color = get_theme_mod( 'header_border_color', '#ffffff' );
    $header_border_style = get_theme_mod( 'header_border_style', 'none' );
    $header_border_size = get_theme_mod( 'header_border_size', '1' );

    //Header Padding Top
    if ( get_theme_mod( 'header_top_padding' ) ){
        $header_top_padding = 'padding-top: '. intval( get_theme_mod( 'header_top_padding' ) ) .'px;';
        $color .= ".site-header {  $header_top_padding  } ";
    }
    //Header Padding Bottom
    if ( get_theme_mod( 'header_bottom_padding' ) ){
        $header_bottom_padding = 'padding-bottom: '. intval( get_theme_mod( 'header_bottom_padding' ) ) .'px;';
        $color .= ".site-header {  $header_bottom_padding  } ";
    }
    //Header Border Bottom
    if ( get_theme_mod( 'header_border_size' ) ){
        $header_border_color = 'border-bottom: '.  intval( $header_border_size ) .'px ' . esc_attr( $header_border_style ) .' '. esc_attr( $header_border_color ) .';';
        $color .= ".site-header { $header_border_color } ";
    }
    //Header Background
    $color .= ".site-header { background:" . esc_attr($header_bg_color) . "; } ";

    /**
     * Header Header-3 ( Menu )
     */

    $menu_font_weight = get_theme_mod( 'menu_font_weight', '600' );
    $main_menu_bg = get_theme_mod( 'main_menu_bg', '#222627' );
    $menu_color = get_theme_mod( 'menu_color', '#fff' );
    $submenu_bg = get_theme_mod( 'submenu_bg', '#222627' );
    $menu_font_size = get_theme_mod( 'menu_font_size', '13' );

    //Header Main Mneu Background
    $color .= ".main-menu { background-color:" . esc_attr( $main_menu_bg ) . "; } ";
    //Header Dropdonw Background
    $color .= ".main-menu .dropdown-menu { background-color:" . esc_attr( $submenu_bg ) . "; } ";
    //Header Font Size
    $color .= ".main-menu .navbar-nav .nav-link,.main-menu .navbar-nav .dropdown-item{ font-size: " . intval($menu_font_size) . "px;} ";
    //Header Font Color
    $color .= ".nav-link, .dropdown-item{ color:" . esc_attr( $menu_color ) . ";} ";
    //Header Font Weight
    $color .= ".main-menu .navbar-nav .nav-link,.main-menu .navbar-nav .dropdown-item{ font-weight:" . intval( $menu_font_weight ) . ";} ";

    /**
    * Footer General Settings
    */
    $footer_bg_color = get_theme_mod( 'footer_bg_color', '#272f32');
    $footer_text_color = get_theme_mod( 'footer_text_color', '#fff' );
    $footer_border_color = get_theme_mod( 'footer_border_color', '#272f32' );
    $footer_border_style = get_theme_mod( 'footer_border_style', 'none' );
    $footer_border_size = get_theme_mod( 'footer_border_size', '1' );

    //Footer BG Color
    $color .= ".footer-main { background:" . esc_attr( $footer_bg_color ) . "; } ";
    //Footer Text Color
    $color .= ".footer-main, .footer-main a{  color: ". esc_attr( $footer_text_color ) .";} ";
    //Footer Top Padding
    if ( get_theme_mod( 'footer_top_padding', '30' ) ){
        $footer_top_padding = 'padding-top: '. intval( get_theme_mod( 'footer_top_padding' ) ) .'px;';
        $color .= ".footer-main { $footer_top_padding } ";
    }
    //Footer Bottom Padding
    if ( get_theme_mod( 'footer_bottom_padding' ) ){
        $footer_bottom_padding = 'padding-bottom: '. intval( get_theme_mod( 'footer_bottom_padding' ) ) .'px;';
        $color .= ".footer-main {  $footer_bottom_padding } ";
    }
    //Footer Border Style
    if ( get_theme_mod( 'header_border_size' ) ){
        $footer_border = 'border-top: '. intval( $footer_border_size ) .'px ' . esc_attr( $footer_border_style ) .' '. esc_attr( $footer_border_color ) .';';
        $color .= ".footer-main {  $footer_border } ";
    }

    /**
     * Footer Top
     */

    $footer_top_bg_color = get_theme_mod( 'footer_top_bg_color' );
    $footer_top_text_color = get_theme_mod( 'footer_top_text_color' );
    $footer_top_border_color = get_theme_mod( 'footer_top_border_color', '#2f383c' );
    $footer_top_border_style = get_theme_mod( 'footer_top_border_style', 'none' );
    $footer_top_border_size = get_theme_mod( 'footer_top_border_size', '1' );

    //Footer Top BG Color
    $color .= ".footer-top { background:" . esc_attr( $footer_top_bg_color ) . "; } ";
    //Footer Top Text Color
    $color .= ".footer-top, .footer-top a{  color: ". esc_attr( $footer_top_text_color ) .";} ";
    //Footer Top Padding Top
    if ( get_theme_mod( 'footer_top_top_padding', '30' ) ){
        $footer_top_padding = 'padding-top: '. intval( get_theme_mod( 'footer_top_top_padding' ) ) .'px;';
        $color .= " .footer-top-padding { $footer_top_padding } ";
    }
    //Footer Top Padding Bottom
    if ( get_theme_mod( 'footer_top_bottom_padding' ) ){
        $footer_bottom_padding = 'padding-bottom: '. intval( get_theme_mod( 'footer_top_bottom_padding' ) ) .'px;';
        $color .= ".footer-top:after  {  $footer_bottom_padding } ";
    }
    //Footer Top Border Style
    if ( get_theme_mod( 'footer_top_border_size' ) ){
        $footer_top_border = 'border-bottom: '. intval( $footer_top_border_size ) .'px ' . esc_attr( $footer_top_border_style ) .' '. esc_attr( $footer_top_border_color ) .';';
        $color .= ".footer-top:after {  $footer_top_border } ";
    }

    /**
     * Footer Middle
     */
    $footer_middle_text_color = get_theme_mod( 'footer_middle_text_color', '#989898' );
    $footer_middle_border_color = get_theme_mod( 'footer_middle_border_color', '#2f383c' );
    //Footer Middle Top Padding
    if ( get_theme_mod( 'footer_middle_top_padding', '30' ) ){
        $footer_top_padding = 'padding-top: '. intval( get_theme_mod( 'footer_middle_top_padding' ) ) .'px;';
        $color .= ".footer-middle { $footer_top_padding } ";
    }
    //Footer Middle Bottom Padding
    if ( get_theme_mod( 'footer_middle_bottom_padding', '30' ) ){
        $footer_top_padding = 'padding-bottom: '. intval( get_theme_mod( 'footer_middle_bottom_padding' ) ) .'px;';
        $color .= ".footer-middle { $footer_top_padding } ";
    }
    //Footer Middle Text Color
    $color .= ".footer-social a { color:" . esc_attr( $footer_middle_text_color ) . "; } ";
    //Footer Middle Border and BG color
    $color .= ".footer-social a { border-color:" . esc_attr( $footer_middle_border_color ) . "; } ";
    $color .= ".footer-social a:hover { background:" . esc_attr( $footer_middle_border_color ) . "; } ";
    /**
     * Footer Bottom
     */
    $footer_bottom_bg_color = get_theme_mod( 'footer_bottom_bg_color', '#f4b738' );
    $footer_bottom_text_color = get_theme_mod( 'footer_bottom_text_color', '#fff' );
    //Footer Bottom BG Color
    $color .= ".footer-bottom { background-color:" . esc_attr( $footer_bottom_bg_color ) . "; } ";
    //Footer Bottom Text Color
    $color .= ".footer-bottom a,.footer-bottom { color:" . esc_attr( $footer_bottom_text_color ) . "; } ";
    //Footer Bottom Padding Top
    if ( get_theme_mod( 'footer_bottom_top_padding', '15' ) ){
        $footer_top_padding = 'padding-top: '. intval( get_theme_mod( 'footer_bottom_top_padding', '15' ) ) .'px;';
        $color .= ".footer-bottom { $footer_top_padding } ";
    }
    //Footer Bottom Padding Bottom
    if ( get_theme_mod( 'footer_bottom_bottom_padding', '15' ) ){
        $footer_bottom_padding = 'padding-bottom: '. intval( get_theme_mod( 'footer_bottom_bottom_padding', '15' ) ) .'px;';
        $color .= ".footer-bottom {  $footer_bottom_padding } ";
    }

    /**
     * Category BG Color
     */
    if( ! function_exists( 'timagazine_colored_category' ) ) :
        function timagazine_colored_category(){
            $output = '';
            // Hide category for pages.
            if ( 'post' === get_post_type() ) {
                $categories_list = get_the_category();
                if ( $categories_list ) {
                    $output .= '<div class="category-bg">';
                    foreach( $categories_list as $category ){
                        $cat_bg_color = get_theme_mod( 'category_color_' . $category->term_id );
                        if ( $cat_bg_color ) {
                            $output .= '<a class="category-unique-bg" href="' . esc_url( get_category_link( $category->term_id ) ) . '" style="background:' . esc_attr( $cat_bg_color ) . '" rel="category tag">'. esc_html( $category->cat_name ) .'</a>';
                        } else {
                            $output .= '<a class="category-unique-bg-empty" href="' . esc_url( get_category_link( $category->term_id ) ) . '"  rel="category tag">' . esc_html( $category->cat_name ) . '</a>';
                        }
                    }
                    $output .= '</div>';
                    echo $output;
                }
            }
        }
    endif;

    /**
     * Primary Color
     */
    $primary_color = get_theme_mod( 'primary_color' );
    if ( $primary_color != '' ){
        //Primary Color
        $color .= "a, .current-menu-item a, .main-menu a:hover, .dropdown-item:focus, .dropdown-item:hover, .dropdown-item.active, .dropdown-item:active, .footer-main .tagcloud a:hover,.current-date{ color: " . esc_attr( $primary_color ) . "; } ";
        //Primary BG Color
        $color .= ".woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.woocommerce ul.products li.product .button,.woocommerce span.onsale,#back-to-top,.footer-main,.top-news-feed-title,.category-bg .category-unique-empty,button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"],#back-to-top ,.widget-area .widget-title:after,.so-panel.widget .widget-title:after{ background-color:" . esc_attr( $primary_color ) . "; } ";
        //Primary Border Color
        $color .= ".woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce ul.products li.product .button,.btn, .widget-area .widget-title:after,button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"]{ border-color: " . esc_attr( $primary_color ) . "; } ";
    }

    /**
     * Typography & Color Inline
     */
    wp_add_inline_style( 'timagazine-style', $color );
}
add_action( 'wp_enqueue_scripts', 'timagazine_typography_color' );
<?php

/**
 * Removed breadcrumbs
 */
add_action( 'init', 'timagazine_remove_wc_breadcrumbs' );
function timagazine_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

/**
 * timagazine_hide_page_title
 *
 * Removes the "shop" title on the main shop page
 */
add_filter( 'woocommerce_show_page_title' , 'timagazine_hide_page_title' );
function timagazine_hide_page_title() {
    return false;
}

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'timagazine_loop_columns');
if (!function_exists('timagazine_loop_columns')) {
    function timagazine_loop_columns() {
        return 3; // 3 products per row
    }
}

/**
 * Opening div for our content wrapper
 */
add_action('woocommerce_before_main_content', 'timagazine_open_div', 5);

function timagazine_open_div() {
    echo '<div class="col-xl-9 col-lg-9 col-md-12 col-xs-12 mt-50 archive-woo">';
}

/**
 * Closing div for our content wrapper
 */
add_action('woocommerce_after_main_content', 'timagazine_close_div', 50);

function timagazine_close_div() {
    echo '</div>';
}

/**
 * Related Product Columns
 */
add_filter( 'woocommerce_output_related_products_args', 'timagazine_related_products_args' );
function timagazine_related_products_args( $args ) {
    $args['posts_per_page'] = 3; // 4 related products
    $args['columns'] = 3; // arranged in 2 columns
    return $args;
}

/**
 * Update contents count via AJAX
 */
add_filter('woocommerce_add_to_cart_fragments', 'timagazine_header_add_to_cart_fragment');
function timagazine_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <a class="cart-contents" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><i class="fa fa-shopping-basket"></i><span><?php echo sprintf(_n(' %d', ' %d', $woocommerce->cart->cart_contents_count, 'timagazine'), $woocommerce->cart->cart_contents_count ); ?></span></a>
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}
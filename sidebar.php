<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package timagazine
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside id="secondary" class="widget-area col-xl-3 col-lg-3 col-md-12 col-12 mt-50">
	<?php
	if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_product() ) ) {
		dynamic_sidebar( 'woocommerce-sidebar' );
	}else {
		dynamic_sidebar( 'sidebar-1' );
	}
	?>
</aside><!-- #secondary -->

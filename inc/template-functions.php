<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package timagazine
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function timagazine_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	// Adds a class of wide & boxed to site layout
	if (  get_theme_mod( 'site_layout' ) == 'wide' ) {
		$classes[] =  "wide";

	}else{
		$classes[] = "boxed";
	}

	return $classes;
}
add_filter( 'body_class', 'timagazine_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function timagazine_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'timagazine_pingback_header' );






/**
 *  Social Media
 */
function timagazine_social_action() { ?>

	<ul class="list-inline mb-0">
		<?php
		if( get_theme_mod( 'header_fb' ) ) {
			echo '<li class="list-inline-item"><a href="'.esc_url( get_theme_mod( 'header_fb' ) ).'"  target="_blank"><i class="fa fa-facebook"></i></a></li>';
		}
		if( get_theme_mod( 'header_tw' ) ) {
			echo '<li class="list-inline-item"><a href="'.esc_url( get_theme_mod( 'header_tw' ) ).'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
		}
		if( get_theme_mod( 'header_li') ) {
			echo '<li class="list-inline-item"><a href="'.esc_url( get_theme_mod('header_li') ).'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
		}
		if( get_theme_mod('header_pint') ) {
			echo '<li class="list-inline-item"><a href="'.esc_url( get_theme_mod('header_pint') ).'" target="_blank"><i class="fa fa-pinterest"></i></a></li>';
		}
		if( get_theme_mod('header_ins') ) {
			echo '<li class="list-inline-item"><a href="'.esc_url( get_theme_mod('header_ins') ).'" target="_blank"><i class="fa fa-instagram"></i></a></li>';
		}
		if( get_theme_mod('header_dri') ) {
			echo '<li class="list-inline-item"><a href="'.esc_url( get_theme_mod('header_dri') ).'" target="_blank"><i class="fa fa-dribbble"></i></a></li>';
		}
		if( get_theme_mod('header_plus') ) {
			echo '<li class="list-inline-item"><a href="'.esc_url( get_theme_mod('header_plus') ).'" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
		}
		if( get_theme_mod('header_you') ) {
			echo '<li class="list-inline-item"><a href="'.esc_url( get_theme_mod('header_you') ).'" target="_blank"><i class="fa fa-youtube"></i></a></li>';
		}
		?>
	</ul>

	<?php
}
add_action( 'timagazine_social', 'timagazine_social_action' );
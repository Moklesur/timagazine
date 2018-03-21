<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package timagazine
 */

?>
	<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>
	<a href="#" id="back-to-top" title="<?php esc_attr_e( 'Back to top', 'timagazine' ); ?>">&uarr;</a>
<div  class="layout">
	<header id="masthead" class="site-header">
		<?php if( get_theme_mod( 'enable_top_bar' ) ) :
			do_action( 'timagazine_top_header' );
		endif; ?>
		<section class="header-2">
			<div class="container-fluid">
				<div class="row align-items-center">
					<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="site-branding">
							<?php
							the_custom_logo();
							if ( is_front_page() && is_home() ) : ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else : ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php
							endif;

							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php wp_kses_post( $description ); /* WPCS: xss ok. */ ?></p>
								<?php
							endif; ?>
						</div><!-- .site-branding -->
					</div>
					<?php if ( get_theme_mod( 'enable_header_banner' ) ) : ?>
						<div class="col-lg-8 col-md-8 col-sm-12 ads-banner">
							<?php if ( get_header_image() ) : ?>
								<a href="<?php echo esc_url( get_theme_mod( 'header_banner_custom_url' ) );  ?>">
									<img src="<?php header_image(); ?>"  alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" class="img-fluid float-right">
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section><!-- .header-2 -->
		<section class="main-menu header-3">
			<nav class="navbar navbar-expand-lg pl-0 pr-0">
				<div class="container-fluid">
					<div class="mobile-bar text-right">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#timagazine-navbar-collapse" aria-controls="timagazine-navbar-collapse" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'timagazine' ); ?>">
							<i class="fa fa-bars" aria-hidden="true"></i>
						</button>
					</div>
					<?php
					wp_nav_menu( array(
							'theme_location'    => 'menu-1',
							'container'			=> 'div',
							'container_class'	=> 'collapse navbar-collapse text-uppercase',
							'container_id'		=> 'timagazine-navbar-collapse',
							'menu_class'		=> 'navbar-nav',
							'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
							'walker'			=> new WP_Bootstrap_Navwalker()
						)
					);

					if ( get_theme_mod( 'search_enable' ) ) : ?>
						<div class="dropdown show search-dropdown">
							<a class="" href="#" role="button" id="header-search-id" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-search"></i></a>
							<div class="dropdown-menu">
								<?php get_search_form(); ?>
							</div>
						</div>
					<?php endif;

					if ( class_exists( 'WooCommerce' ) ) : ?>
						<div class="mini-cart-fix">
							<a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" >
								<i class="fa fa-shopping-basket"></i>
							<span>
								<?php echo sprintf ( _n( ' %d', ' %d', WC()->cart->get_cart_contents_count(), 'timagazine' ), WC()->cart->get_cart_contents_count() ); ?>
							</span>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</nav>
		</section><!-- .header-3 -->
	</header><!-- #masthead -->

<?php timagazine_breadcrumbs(); ?>
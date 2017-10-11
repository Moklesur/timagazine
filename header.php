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
<div  class="layout">

	<header id="masthead" class="site-header">
		<?php if( get_theme_mod( 'enable_top_bar' ) ) : ?>
			<section class="top-bar header-1 position-r">
				<div class="container-fluid">
					<div class="row align-items-center">
						<?php if( get_theme_mod( 'enable_breaking_news' ) ) : ?>
							<div class="col-lg-6 col-md-6 col-sm-12 breaking-news">
								<div class="top-news-feed row align-items-center">
									<?php if ( get_theme_mod( 'breaking_news_title' ) != '' ) : ?>
										<div class="col">
											<p class="mb-0 top-news-feed-title text-center"><span><?php
													echo esc_html( get_theme_mod( 'breaking_news_title' ), 'timagazine' ); ?></span></p>
										</div>
									<?php endif;
									if ( get_theme_mod( 'breaking_news_content_1' ) != '' || get_theme_mod( 'breaking_news_content_2' ) != '' || get_theme_mod( 'breaking_news_content_3' ) != '' || get_theme_mod( 'breaking_news_content_4' ) != '' ) : ?>
										<div id="breaking-news" class="carousel slide col-8 pl-0" data-ride="carousel">
											<div class="carousel-inner">
												<?php if ( get_theme_mod( 'breaking_news_content_1' ) != '' ) : ?>
													<div class="carousel-item">
														<p class="mb-0"><?php
															echo esc_html( get_theme_mod( 'breaking_news_content_1' ), 'timagazine' ); ?></p>
													</div>
												<?php endif;
												if ( get_theme_mod( 'breaking_news_content_2' ) != '' ) : ?>
													<div class="carousel-item">
														<p class="mb-0"><?php
															echo esc_html( get_theme_mod( 'breaking_news_content_2' ), 'timagazine' ); ?></p>
													</div>
												<?php endif;
												if ( get_theme_mod( 'breaking_news_content_3' ) != '' ) : ?>
													<div class="carousel-item">
														<p class="mb-0"><?php
															echo esc_html( get_theme_mod( 'breaking_news_content_3' ), 'timagazine' ); ?></p>
													</div>
												<?php endif; ?>
												<?php if ( get_theme_mod( 'breaking_news_content_4' ) != '' ) : ?>
													<div class="carousel-item">
														<p class="mb-0"><?php
															echo esc_html( get_theme_mod( 'breaking_news_content_4' ), 'timagazine' ); ?></p>
													</div>
												<?php endif; ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="row d-flex justify-content-end">

								<?php if( get_theme_mod( 'enable_top_bar_date' ) ) : ?>
									<div class="col-auto hidden-xs">
										<p class="mb-0 current-date"><?php the_time( get_option( 'date_format' ) ); ?></p>
									</div>
								<?php endif;
								if( get_theme_mod( 'enable_top_bar_menu' ) ) : ?>
									<div class="col-auto top-menu">
										<?php
										wp_nav_menu( array(
											'theme_location' => 'top-menu'
										) );
										?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section><!-- .header-1 -->
		<?php endif; ?>
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
								<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
								<?php
							endif; ?>
						</div><!-- .site-branding -->
					</div>
					<?php if ( get_theme_mod( 'enable_header_banner' ) ) : ?>
						<div class="col-lg-8 col-md-8 col-sm-12 ads-banner">
							<?php if ( get_header_image() ) : ?>
								<a href="<?php echo esc_url( get_theme_mod( 'header_banner_custom_url' ) );  ?>">
									<img src="<?php header_image(); ?>"  alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" class="img-fluid float-right">
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
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
							<i class="fa fa-bars" aria-hidden="true"></i>
						</button>
					</div>
					<?php
					wp_nav_menu( array(
							'theme_location'    => 'menu-1',
							'container'			=> 'div',
							'container_class'	=> 'collapse navbar-collapse text-uppercase',
							'container_id'		=> 'bs-example-navbar-collapse-1',
							'menu_class'		=> 'navbar-nav',
							'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
							'walker'			=> new WP_Bootstrap_Navwalker()
						)
					);
					?>
					<?php if ( get_theme_mod( 'search_enable' ) ) : ?>
						<div class="dropdown show search-dropdown">
							<a class="" href="#" role="button" id="header-search-id" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-search"></i></a>
							<form method="get" class="dropdown-menu"  aria-labelledby="header-search-id" action="<?php echo esc_url( home_url( '/' )); ?>">
								<input type="search" class="search-field form-control"
									   placeholder="<?php echo esc_attr( 'Search ...', 'timagazine' ); ?>"
									   value="<?php echo get_search_query() ?>" name="s" />
							</form>
						</div>
					<?php endif; ?>
				</div>
			</nav>
		</section><!-- .header-3 -->
	</header><!-- #masthead -->

<?php timagazine_breadcrumbs(); ?>
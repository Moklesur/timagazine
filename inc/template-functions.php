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
			echo '<li class="list-inline-item"><a class="fb" href="'.esc_url( get_theme_mod( 'header_fb' ) ).'"  target="_blank"><i class="fa fa-facebook"></i></a></li>';
		}
		if( get_theme_mod( 'header_tw' ) ) {
			echo '<li class="list-inline-item"><a class="tw"  href="'.esc_url( get_theme_mod( 'header_tw' ) ).'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
		}
		if( get_theme_mod('header_you') ) {
			echo '<li class="list-inline-item"><a class="yo" href="'.esc_url( get_theme_mod('header_you') ).'" target="_blank"><i class="fa fa-youtube"></i></a></li>';
		}
		if( get_theme_mod( 'header_li') ) {
			echo '<li class="list-inline-item"><a class="li" href="'.esc_url( get_theme_mod('header_li') ).'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
		}
		if( get_theme_mod('header_pint') ) {
			echo '<li class="list-inline-item"><a class="pi" href="'.esc_url( get_theme_mod('header_pint') ).'" target="_blank"><i class="fa fa-pinterest"></i></a></li>';
		}
		if( get_theme_mod('header_ins') ) {
			echo '<li class="list-inline-item"><a class="in" href="'.esc_url( get_theme_mod('header_ins') ).'" target="_blank"><i class="fa fa-instagram"></i></a></li>';
		}
		if( get_theme_mod('header_dri') ) {
			echo '<li class="list-inline-item"><a class="dr" href="'.esc_url( get_theme_mod('header_dri') ).'" target="_blank"><i class="fa fa-dribbble"></i></a></li>';
		}
		if( get_theme_mod('header_plus') ) {
			echo '<li class="list-inline-item"><a class="gp" href="'.esc_url( get_theme_mod('header_plus') ).'" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
		}
		?>
	</ul>
<?php }
add_action( 'timagazine_social', 'timagazine_social_action' );

/**
 *  Top Header ( header-1 )
 */
function timagazine_top_header_action() { ?>
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

							$recent_post_hand_pick = get_theme_mod( 'recent_post_hand_pick', 'post' );

							if ( $recent_post_hand_pick != '' || get_theme_mod( 'breaking_news_content_1' ) != '' || get_theme_mod( 'breaking_news_content_2' ) != '' || get_theme_mod( 'breaking_news_content_3' ) != '' || get_theme_mod( 'breaking_news_content_4' ) != '' ) : ?>
								<div id="breaking-news" class="carousel breaking-news slide col-8 pl-0" data-ride="carousel">
									<div class="carousel-inner">

										<?php

										if( $recent_post_hand_pick == 'post' ) {
											/**
											 * Breaking News
											 * Blog From Recent Posts
											 */
											$query = new WP_Query( array(
												'posts_per_page'      => 3,
												'no_found_rows'       => true,
												'post_status'         => 'publish',
												'ignore_sticky_posts' => true,
											) );
											if ( $query->have_posts() ) :
												while ( $query->have_posts() ) : $query->the_post(); ?>
													<div class="carousel-item">
														<a href="<?php the_permalink(); ?>">
															<?php echo esc_html( get_the_title() ); ?>
														</a>
													</div>
													<?php
												endwhile; // End of the loop.
												// Restore original Post Data
												wp_reset_postdata();
											endif;
										} else {
											/**
											 * Breaking News Posts
											 * Hand Pick
											 */
											if ( get_theme_mod( 'breaking_news_content_1' ) != '' ) : ?>
												<div class="carousel-item">
													<p class="mb-0"><?php echo esc_html( get_theme_mod( 'breaking_news_content_1' ) ); ?></p>
												</div>
											<?php endif;
											if ( get_theme_mod( 'breaking_news_content_2' ) != '' ) : ?>
												<div class="carousel-item">
													<p class="mb-0"><?php echo esc_html( get_theme_mod( 'breaking_news_content_2' ) ); ?></p>
												</div>
											<?php endif;
											if ( get_theme_mod( 'breaking_news_content_3' ) != '' ) : ?>
												<div class="carousel-item">
													<p class="mb-0"><?php echo esc_html( get_theme_mod( 'breaking_news_content_3' ) ); ?></p>
												</div>
											<?php endif;
											if ( get_theme_mod( 'breaking_news_content_4' ) != '' ) : ?>
												<div class="carousel-item">
													<p class="mb-0"><?php echo esc_html( get_theme_mod( 'breaking_news_content_4' ) ); ?></p>
												</div>
											<?php endif;
										} ?>
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
								<p class="mb-0 current-date"><?php echo date( get_option( 'date_format' ) ); ?></p>
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
<?php }
add_action( 'timagazine_top_header', 'timagazine_top_header_action' );
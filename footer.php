<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package timagazine
 */

?>

<footer id="colophon" class="footer-main mt-50">

	<?php if ( get_theme_mod( 'enable_footer_top' ) ) : ?>
		<section class="footer-top">
			<div class="container-fluid">
				<div class="row">
					<?php

					if ( get_theme_mod( 'footer_widget_column' ) == 'four' ) { ?>

						<div class="col-lg-3 col-md-6 col-sm-6 col-12 footer-top-padding">
							<?php
							if ( is_active_sidebar( 'footer-widget' ) ) :
								dynamic_sidebar( 'footer-widget' );
							endif;
							?>
						</div>

						<div class="col-lg-3 col-md-6 col-sm-6 col-12 footer-top-padding">
							<?php
							if ( is_active_sidebar( 'footer-widget-2' ) ) :
								dynamic_sidebar( 'footer-widget-2' );
							endif;
							?>
						</div>

						<div class="col-lg-3 col-md-6 col-sm-6 col-12 footer-top-padding">
							<?php
							if ( is_active_sidebar( 'footer-widget-3' ) ) :
								dynamic_sidebar( 'footer-widget-3' );
							endif;
							?>
						</div>

						<div class="col-lg-3 col-md-6 col-sm-6 col-12 footer-top-padding">
							<?php
							if ( is_active_sidebar( 'footer-widget-4' ) ) :
								dynamic_sidebar( 'footer-widget-4' );
							endif;
							?>
						</div>

						<?php

					} elseif ( get_theme_mod( 'footer_widget_column' ) == 'three' ) { ?>

						<div class="col-lg-4 col-md-4 col-sm-6 col-12 footer-top-padding">
							<?php
							if ( is_active_sidebar( 'footer-widget' ) ) :
								dynamic_sidebar( 'footer-widget' );
							endif;
							?>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-6 col-12 footer-top-padding">
							<?php
							if ( is_active_sidebar( 'footer-widget-2' ) ) :
								dynamic_sidebar( 'footer-widget-2' );
							endif;
							?>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-6 col-12 footer-top-padding">
							<?php
							if ( is_active_sidebar( 'footer-widget-3' ) ) :
								dynamic_sidebar( 'footer-widget-3' );
							endif;
							?>
						</div>
						<?php } else { ?>
						<div class="col-lg-6 col-md-6 col-sm-6 col-12 footer-top-padding">
							<?php
							if ( is_active_sidebar( 'footer-widget' ) ) :
								dynamic_sidebar( 'footer-widget' );
							endif;
							?>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-12 footer-top-padding">
							<?php
							if ( is_active_sidebar( 'footer-widget-2' ) ) :
								dynamic_sidebar( 'footer-widget-2' );
							endif;
							?>
						</div>
					<?php } ?>
				</div>
			</div>
		</section><!-- .footer-top -->
	<?php endif;

	if ( get_theme_mod( 'enable_footer_middle' ) ) : ?>
		<section class="footer-middle">
			<div class="container-fluid">
				<div class="row">
					<?php if ( get_theme_mod( 'footer_middle_image' ) != '' ) :?>
					<div class="col-12 d-flex justify-content-center mb-3">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url( get_theme_mod( 'footer_middle_image' ) ) ;?>" alt="" class="img-fluid" >
						</a>
					</div>
					<?php endif;

					if ( get_theme_mod( 'social_footer_enable' ) ) : ?>
					<div class="col-12 d-flex justify-content-center footer-social">
						<?php do_action('timagazine_social'); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</section><!-- .footer-middle -->
	<?php endif; ?>

	<section class="footer-bottom">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-lg-6 d-flex align-self-center">
					<div class="site-info">
						<a href="<?php echo esc_url( __( 'https://www.themetim.com/', 'timagazine' ) ); ?>">
							<?php echo esc_html( get_theme_mod( 'copyright', 'TiMagazine By ThemeTim' ) ); ?>
						</a>
					</div><!-- .site-info -->
				</div>
				<?php if ( is_active_sidebar( 'footer-bottom' ) ) : ?>
					<div class="col-12 col-lg-6 d-flex justify-content-end">
					<?php dynamic_sidebar( 'footer-bottom' ); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section><!-- .footer-bottom -->

</footer><!-- #colophon -->
</div>
<?php wp_footer(); ?>

</body>
</html>
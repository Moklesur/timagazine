<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package timagazine
 */

get_header();

$row = ' row';
$blog_layout = get_theme_mod( 'blog_layout' );
$col = '9';

$mt_50 = '';
if ( ! is_front_page() ){
	$mt_50 = ' mt-50';
}

if ( get_theme_mod( 'blog_layout', 'default' ) == 'default' ) {
	$blog_layout = 'masonry';
	$col = '9 p-0';
	$row = '';
} elseif ( get_theme_mod( 'blog_layout', 'masonry' ) == 'masonry' ) {
	$blog_layout = 'masonry';
	$col = '12 p-0';
	$row = '';
}
?>
	<main id="main" class="site-main">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-<?php echo $col; ?> col-lg-<?php echo $col . $mt_50; ?> col-md-12 col-12 mt-50 <?php echo esc_attr( $blog_layout ); ?>">
					<div class="masonry-wrap<?php echo $row; ?>">
						<?php
						if ( have_posts() ) :

							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
								get_template_part( 'template-parts/content', get_post_format() );

							endwhile;

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif; ?>
					</div>
					<div class="col-lg-12">
						<?php the_posts_navigation(); ?>
					</div>
				</div>
				<?php
				if ( get_theme_mod( 'blog_layout', 'blog-wide' ) == 'blog-wide' || get_theme_mod( 'blog_layout', 'default' ) == 'default' ) :
					get_sidebar();
				endif;
				?>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
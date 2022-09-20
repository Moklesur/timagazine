<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package timagazine
 */

get_header();

$col = 'col-xl-12 col-lg-12 col-md-12';
if ( get_theme_mod( 'enable_single_post_sidebar' ) != 1 ) :
	$col = 'col-xl-9 col-lg-9 col-md-12';
endif;

?>
	<main id="main" class="site-main">
		<div class="container-fluid">
			<div class="row">
				<div class="<?php echo $col; ?> col-12 mt-50">
					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content-single', get_post_format() );

						the_post_navigation();

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
				</div>
				<?php
				if ( get_theme_mod( 'enable_single_post_sidebar' ) != 1 ) :
					get_sidebar();
				endif;
				?>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();

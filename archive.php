<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package timagazine
 */

get_header(); ?>

	<main id="main" class="site-main">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-9 col-lg-9 col-md-12 col-12 mt-50">
					<div class="row">
						<?php
						if ( have_posts() ) :

							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
								get_template_part( 'template-parts/content-archive', get_post_format() );

							endwhile;

							the_posts_navigation();

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif; ?>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();

<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package timagazine
 */

get_header(); ?>

	<main id="main" class="site-main error-404 not-found">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-9 col-lg-9 col-md-12 col-12 mt-50">
					<h4 class="mb-30"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'timagazine' ); ?></h4>
					<?php get_search_form(); ?>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();

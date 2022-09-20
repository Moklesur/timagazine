<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package boka
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="article-wrap overflow-h">
		<header class="entry-header">
			<?php if ( has_post_thumbnail() && get_theme_mod('featured_image_single_enable') != 1 ) : ?>
				<div class="entry-thumb mb-20 position-r overflow-h">
					<div class="hover-images">
						<img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-responsive" />
					</div>
				</div>
			<?php endif;
			if ( !is_singular() ) :
				the_title( '<h4 class="entry-title mb-0"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
			endif;
			if ( 'post' === get_post_type() && get_theme_mod('meta_single_enable') != 1 ) : ?>
				<div class="entry-meta">
					<?php timagazine_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
			endif; ?>
		</header><!-- .entry-header -->
		<div class="entry-content mt-20">
			<?php
			the_content();
			?>
		</div><!-- .entry-content -->
		<div class="clearfix"></div>
		<?php if ( get_theme_mod('meta_single_enable') != 1 ) : ?>
			<footer class="entry-footer">
				<?php timagazine_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
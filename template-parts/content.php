<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package timagazine
 */

if ( get_theme_mod( 'blog_layout', 'default' ) == 'default' ) {
	$margin[] = 'col-lg-6 hover-images';
} elseif ( get_theme_mod( 'blog_layout', 'masonry' ) == 'masonry' ) {
	$margin[] = 'col-lg-4 hover-images';
} else{
	$margin[] = 'col-lg-12 hover-images';
}

$margin[] = 'mb-30 hentry col-12';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $margin ); ?>>
	<div class="article-wrap overflow-h">
		<header class="entry-header">
			<?php if ( has_post_thumbnail() && get_theme_mod('featured_image_index_enable') != 1 ) : ?>
				<div class="entry-thumb mb-20 position-r overflow-h">
					<a href="<?php the_permalink(); ?>">
						<img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-responsive" />
					</a>
				</div>
			<?php endif;
			if ( !is_singular() ) :
				the_title( '<h4 class="entry-title mb-0"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
			endif;
			if ( 'post' === get_post_type() && get_theme_mod('meta_index_enable') != 1 ) : ?>
				<div class="entry-meta">
					<?php timagazine_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
			endif; ?>
		</header><!-- .entry-header -->
		<div class="entry-content mt-20">
			<?php
			if ( get_theme_mod( 'excerpt_content_enable' ) ){
				the_content();
			} else {
				the_excerpt();
			}
			wp_link_pages(array(
				'before' => '<div class="page-links">' . __('Pages : ', 'timagazine'),
				'after' => '</div>',
			));
			?>
		</div><!-- .entry-content -->
		<?php if ( get_theme_mod('meta_index_enable') != 1 ) : ?>
			<footer class="entry-footer">
				<?php timagazine_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->

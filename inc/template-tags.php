<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package timagazine
 */

if ( ! function_exists( 'timagazine_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function timagazine_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published " datetime="%1$s">%2$s</time><time class="updated d-none" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
		/* translators: %s: post date. */
			esc_html_x( ' %s', 'post date', 'timagazine' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
		/* translators: %s: post author. */
			esc_html_x( ' %s', 'post author', 'timagazine' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
		comments_number( '<span> <i class="fa fa-comments-o"></i> 0</span>', '<span> <i class="fa fa-comment"></i> 1</span>', '<span> <i class="fa fa-comment"></i> %</span>' );

	}
endif;

if ( ! function_exists( 'timagazine_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function timagazine_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'timagazine' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'timagazine' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'timagazine' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				esc_html( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}

	function timagazine_cat(){

		if ( 'post' === get_post_type() ) {

			$categories_list = get_the_category();
			foreach( $categories_list as $category ){

				$cat_bg_color = get_theme_mod( 'category_color_' . $category->term_id );

				if ( $cat_bg_color != '' ){
					echo '<a class="category-unique-bg" href="' . esc_url( get_category_link( $category->term_id ) ) . '" style="background:' . esc_attr( $cat_bg_color ) . '" rel="category tag">'. esc_html( $category->cat_name ) .'</a>';
				}else{
					echo '<a class="category-unique-empty" href="' . esc_url( get_category_link( $category->term_id ) ) . '" rel="category tag">'. esc_html( $category->cat_name ) .'</a>';
				}
			}
		}
	}

endif;
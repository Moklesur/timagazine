<?php

/**
 * Breadcrumbs
 * https://www.thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin
 */
function timagazine_breadcrumbs( $args = array() ) {

    if ( is_front_page() ) {
        return;
    }

    global $post;
    $defaults  = array(
        'separator_icon'      => '&#8725;',
        'breadcrumbs_id'      => 'breadcrumb',
        'breadcrumbs_classes' => 'breadcrumb-trail breadcrumb',
        'home_title'          => esc_html__( 'Home', 'timagazine' )
    );
    $args      = apply_filters( 'timagazine_breadcrumbs_args', wp_parse_args( $args, $defaults ) );
    $separator = '<span class="pl-2 pr-2">' . esc_html( $args['separator_icon'] ) . '</span>';

    /***** Begin Markup *****/

    // Open the breadcrumbs
    $html = '<div id="' . esc_attr( $args['breadcrumbs_id'] ) . '" class="' . esc_attr( $args['breadcrumbs_classes'] ) . '"><div class="container-fluid">';

    // Add Homepage link & separator (always present)
    $html .= '<span class="item-home"><a class="bread-link bread-home" href="' . esc_url( home_url() ) . '" title="' . esc_attr( $args['home_title'] ) . '">' .  esc_html($args['home_title']) . '</a></span>';
    $html .= $separator;

    // Post
    if ( is_singular( 'post' ) ) {
        $category = get_the_category();
        $category_values = array_values( $category );
        $last_category = end( $category_values );
        $cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ), ',' );
        $cat_parents = explode( ',', $cat_parents );

        foreach ( $cat_parents as $parent ) {
            $html .= '<span class="item-cat">' . wp_kses( $parent, wp_kses_allowed_html( 'a' ) ) . '</span>';
            $html .= $separator;
        }
        $html .= '<span class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . esc_attr( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span></span>';
        $html .= '<h1>' . esc_html( get_the_title() ) . '</h1>';
    } elseif ( is_singular( 'page' ) ) {
        if ( $post->post_parent ) {
            $parents = get_post_ancestors( $post->ID );
            $parents = array_reverse( $parents );

            foreach ( $parents as $parent ) {
                $html .= '<span class="item-parent item-parent-' . esc_attr( $parent ) . '"><a class="bread-parent bread-parent-' . esc_attr( $parent ) . '" href="' . esc_url( get_permalink( $parent ) ) . '" title="' . esc_attr( get_the_title( $parent ) ) . '">' . esc_html( get_the_title( $parent ) ) . '</a></span>';
                $html .= $separator;
            }
        }
        $html .= '<span class="item-current item-' . $post->ID . '"><span title="' . esc_attr( get_the_title() ) . '"> ' . esc_html( get_the_title() ) . '</span></span>';
        $html .= '<h1> ' . esc_html( get_the_title() ) . '</h1>';
    } elseif ( is_singular( 'attachment' ) ) {
        $parent_id        = $post->post_parent;
        $parent_title     = get_the_title( $parent_id );
        $parent_permalink = esc_url( get_permalink( $parent_id ) );

        $html .= '<span class="item-parent"><a class="bread-parent" href="' . esc_url( $parent_permalink ) . '" title="' . esc_attr( $parent_title ) . '">' . esc_html( $parent_title ) . '</a></span>';
        $html .= $separator;
        $html .= '<span class="item-current item-' . $post->ID . '"><span title="' . esc_attr( get_the_title() ) . '"> ' . esc_html( get_the_title() ) . '</span></span>';
        $html .= '<h1>' . esc_html( get_the_title() ) . '</h1>';
    } elseif ( is_singular() ) {
        $post_type         = get_post_type();
        $post_type_object  = get_post_type_object( $post_type );
        $post_type_archive = get_post_type_archive_link( $post_type );

        $html .= '<span class="item-cat item-custom-post-type-' . esc_attr( $post_type ) . '"><a class="bread-cat bread-custom-post-type-' . esc_attr( $post_type ) . '" href="' . esc_url( $post_type_archive ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . esc_html( $post_type_object->labels->name ) . '</a></span>';
        $html .= $separator;
        $html .= '<span class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . esc_attr($post->post_title) . '">' . esc_html($post->post_title) . '</span></span>';
        $html .= '<h1>' . $post->post_title . '</h1>';
    } elseif ( is_category() ) {
        $parent = get_queried_object()->category_parent;

        if ( $parent !== 0 ) {

            $parent_category = get_category( $parent );
            $category_link   = get_category_link( $parent );

            $html .= '<span class="item-parent item-parent-' . esc_attr( $parent_category->slug ) . '"><a class="bread-parent bread-parent-' . esc_attr( $parent_category->slug ) . '" href="' . esc_url( $category_link ) . '" title="' . esc_attr( $parent_category->name ) . '">' . esc_html( $parent_category->name ) . '</a></span>';
            $html .= $separator;
        }
        $html .= '<span class="item-current item-cat"><span class="bread-current bread-cat" title="' . esc_attr($post->ID) . '">' . esc_html( single_cat_title( '', false ) ) . '</span></span>';
        $html .= '<h1>' . esc_html( single_cat_title( '', false ) ) . '</h1>';
    } elseif ( is_tag() ) {
        $html .= '<span class="item-current item-tag"><span class="bread-current bread-tag">' . esc_html( single_tag_title( '', false ) ) . '</span></span>';
        $html .= '<h1>' . esc_html( single_tag_title( '', false ) ) . '</h1>';
    } elseif ( is_author() ) {
        $html .= '<span class="item-current item-author"><span class="bread-current bread-author">' . esc_html( get_queried_object()->display_name ) . '</span></span>';
        $html .= '<h1>' . esc_html( get_queried_object()->display_name ) . '</h1>';
    } elseif ( is_day() ) {
        $html .= '<span class="item-current item-day"><span class="bread-current bread-day">' . esc_html( get_the_date() ) . '</span></span>';
        $html .= '<h1>' . esc_html( get_the_date() ) . '</h1>';
    } elseif ( is_month() ) {
        $html .= '<span class="item-current item-month"><span class="bread-current bread-month">' . esc_html( get_the_date( 'F Y' ) ) . '</span></span>';
        $html .= '<h1>' . esc_html( get_the_date( 'F Y' ) ) . '</h1>';
    } elseif ( is_year() ) {
        $html .= '<span class="item-current item-year"><span class="bread-current bread-year">' . esc_html( get_the_date( 'Y' ) ) . '</span></span>';
        $html .= '<h1>' . esc_html( get_the_date( 'Y' ) ) . '</h1>';
    } elseif ( is_archive() ) {
        $custom_tax_name = get_queried_object()->name;
        $html .= '<span class="item-current item-archive"><span class="bread-current bread-archive">' . esc_html( $custom_tax_name ) . '</span></span>';
        $html .= '<h1>' . esc_html( $custom_tax_name ) . '</h1>';
    } elseif ( is_search() ) {
        $html .= '<span class="item-current item-search"><span class="bread-current bread-search">'.__('Search results for:','timagazine').' ' . get_search_query() . '</span></span>';
        $html .= '<h1>'. __( ' Search results for : ', 'timagazine') . get_search_query() . '</h1>';
    } elseif ( is_404() ) {
        $html .= '<span>' . __( 'Error 404', 'timagazine' ) . '</span>';
        $html .= '<h1>' . __( 'Error 404', 'timagazine' ) . '</h1>';
    } elseif ( is_home() ) {
        $html .= '<span>' . esc_html( get_the_title( get_option( 'page_for_posts' ) ) ) . '</span>';
        $html .= '<h1>' . esc_html( get_the_title( get_option( 'page_for_posts' ) ) ) . '</h1>';
    }

    $html .= '</div></div>';
    $html = apply_filters( 'timagazine_breadcrumbs_filter', $html );

    echo wp_kses_post( $html );
}
<?php
/**
 * Hooks for site origin.
 *
 * This file contains hook functions attached to core hooks of site origin bundle.
 *
 * @package timagazine
 */

if ( ! function_exists( 'timagazine_add_tab_in_builer_widgets_panel' ) ) :

    /**
     * Add tab in builder widgets section.
     *
     * @since 1.0.0
     *
     * @param array $tabs Tabs.
     * @return array Modified tabs.
     */
    function timagazine_add_tab_in_builer_widgets_panel( $tabs ) {
        $tabs['timagazine'] = array(
            'title'  => __( 'Timagazine Widgets', 'timagazine' ),
            'filter' => array(
                'groups' => array( 'timagazine' ),
            ),
        );
        return $tabs;
    }

endif;

add_filter( 'siteorigin_panels_widget_dialog_tabs', 'timagazine_add_tab_in_builer_widgets_panel' );

if ( ! function_exists( 'timagazine_group_theme_widgets_in_builder' ) ) :

    /**
     * Grouping theme widgets in builder.
     *
     * @since 1.0.0
     *
     * @param array $widgets Widgets array.
     * @return array Modified widgets array.
     */
    function timagazine_group_theme_widgets_in_builder( $widgets ) {

        if ( isset( $GLOBALS['wp_widget_factory'] ) && ! empty( $GLOBALS['wp_widget_factory']->widgets ) ) {
            $all_widgets = array_keys( $GLOBALS['wp_widget_factory']->widgets );
            foreach ( $all_widgets as $widget ) {
                if ( false !== strpos( $widget, 'Timagazine_' ) ) {
                    $widgets[ $widget ]['groups'] = array( 'timagazine' );
                    $widgets[ $widget ]['icon']   = 'dashicons dashicons-align-none';
                }
            }
        }
        return $widgets;

    }
endif;

add_filter( 'siteorigin_panels_widgets', 'timagazine_group_theme_widgets_in_builder' );


if ( ! function_exists( 'timagazine_customize_so_widgets_status' ) ) :

    /**
     * Customize to make widgets active.
     *
     * @since 1.0.0
     *
     * @param array $active Array of widgets.
     * @return array Modified array.
     */
    function timagazine_customize_so_widgets_status( $active ) {

        $active['so-features-widget']    = true;
        $active['features']              = true;

        $active['so-slider-widget']      = true;
        $active['slider']                = true;

        $active['so-google-map-widget']  = true;
        $active['google-map']            = true;

        $active['so-image-widget']       = true;
        $active['image']                 = true;

        $active['so-cta-widget']         = true;
        $active['cta']                   = true;

        $active['so-contact-widget']     = true;
        $active['contact']               = true;

        $active['so-testimonial-widget'] = true;
        $active['testimonial']           = true;

        $active['so-hero-widget']        = true;
        $active['hero']                  = true;

        return $active;

    }

endif;

add_filter( 'siteorigin_widgets_active_widgets', 'timagazine_customize_so_widgets_status' );

/**
 * Theme SO Widgets.
 */

// Theme widgets.
$theme_widgets = array(
    'widget-category-posts-a',
    'widget-featured-posts',
    'widget-lastest-posts',
);

$template_dir = get_template_directory();

foreach ( $theme_widgets as $widget ) {

    require_once $template_dir . '/inc/widgets/' . $widget . '.php';

}

/**
 * Scripts and styles for the Page Builder plugin
 */
function timagazine_load_pagebuilder_scripts() {
    wp_enqueue_script( 'timagazine-chosen', get_template_directory_uri() . '/assets/js/chosen.jquery.min.js', array('jquery', 'jquery-ui-sortable'), '', true );
    wp_enqueue_script( 'timagazine-chosen-init', get_template_directory_uri() . '/assets/js/chosen-init.js', array('jquery'), '', true );
    wp_enqueue_style( 'timagazine-chosen-styles', get_template_directory_uri() . '/assets/css/chosen.min.css', array(), true );
}
add_action( 'siteorigin_panel_enqueue_admin_scripts', 'timagazine_load_pagebuilder_scripts' );
<?php
/**
 * timagazine functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package timagazine
 */

if ( ! function_exists( 'timagazine_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function timagazine_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		/*
         * Define custom image size
         */

		add_image_size( 'timagazine-team-thumb', 960, 444  );
		add_image_size( 'timagazine-medium-thumb', 295, 191, true );
		add_image_size( 'timagazine-featured-medium-thumb', 1100, 710, true );
		add_image_size( 'timagazine-featured-small-thumb', 570, 395, true );
		add_image_size( 'timagazine-most-popular-thumb', 100, 70, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'top-menu' => esc_html__( 'Top Menu', 'timagazine' ),
			'menu-1' => esc_html__( 'Primary', 'timagazine' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'timagazine_custom_background_args', array(
			'default-color' => 'fcfcfc',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'timagazine_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function timagazine_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'timagazine_content_width', 640 );
}
add_action( 'after_setup_theme', 'timagazine_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function timagazine_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'timagazine' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'timagazine' ),
		'before_widget' => '<div id="%1$s" class="widget mb-30 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title text-uppercase position-r"><span>',
		'after_title'   => '</span></h6>',
	) );

	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'          => __( 'WooCommerce', 'timagazine' ),
			'id'            => 'woocommerce-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your WooCommerce sidebar.', 'timagazine' ),
			'before_widget' => '<div id="%1$s" class="widget mb-30 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="widget-title text-uppercase position-r"><span>',
			'after_title'   => '</span></h6>',
		) );
	}

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Bottom', 'timagazine' ),
		'id'            => 'footer-bottom',
		'description'   => esc_html__( 'Add widgets here.', 'timagazine' ),
		'before_widget' => '<div id="%1$s" class="footer-bottom-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="footer-bottom-widget-title">',
		'after_title'   => '</h6>',
	) );

	$args_footer_widgets = array(
		'name'          => __( 'Footer %d', 'timagazine' ),
		'id'            => 'footer-widget',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="footer-top-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="footer-top-widget-title">',
		'after_title'   => '</h6>'
	);

	register_sidebars( 4, $args_footer_widgets );

	// Register Widgets
	register_widget( 'Timagazine_Widget_Featured_Posts' );
	register_widget( 'Timagazine_Widget_Category_Posts_A' );
	register_widget( 'Timagazine_Widget_latest_Posts' );
	register_widget( 'Timagazine_Widget_Trending_Posts' );
	register_widget( 'Timagazine_Widget_Social_Links' );
	register_widget( 'Timagazine_Newsletter' );
	register_widget( 'Timagazine_Widget_Author' );
	register_widget( 'Timagazine_Most_Popular' );
}
add_action( 'widgets_init', 'timagazine_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function timagazine_scripts() {
	if ( get_theme_mod('body_font_name') ) {
		wp_enqueue_style( 'timagazine-body-fonts', '//fonts.googleapis.com/css?family=' . esc_url( get_theme_mod( 'body_font_name' ) ) );
	} else {
		wp_enqueue_style( 'timagazine-body-fonts', '//fonts.googleapis.com/css?family=Poppins:400');
	}
	if ( get_theme_mod('heading_font_name') ) {
		wp_enqueue_style( 'timagazine-heading-fonts', '//fonts.googleapis.com/css?family=' . esc_url( get_theme_mod( 'heading_font_name' ) ) );
	} else {
		wp_enqueue_style( 'timagazine-heading-fonts', '//fonts.googleapis.com/css?family=Poppins:600');
	}
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.min.css', array(), '3.5.2' );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '2.2.1' );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.8.0' );
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', array(), '1.8.0' );
	wp_enqueue_style( 'FontAwesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7.0' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.0.0' );
	wp_enqueue_style( 'timagazine-style', get_stylesheet_uri() );
	wp_enqueue_style( 'timagazine-mobile', get_template_directory_uri() . '/assets/css/mobile.css', array(), '1.0' );

	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '2.2.1', true );
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), '1.12.5', true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '1.8.0', false );
	wp_enqueue_script( 'fakecrop', get_template_directory_uri() . '/assets/js/jquery.fakecrop.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.0.0', true );

	wp_enqueue_script( 'timagazine-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'timagazine-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'masonry' );

	wp_enqueue_script( 'timagazine-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'timagazine_scripts' );

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets/widget-category-posts-a.php';
require get_template_directory() . '/inc/widgets/widget-featured-posts.php';
require get_template_directory() . '/inc/widgets/widget-lastest-posts.php';
require get_template_directory() . '/inc/widgets/widget-trending-posts.php';
require get_template_directory() . '/inc/widgets/widget-social-links.php';
require get_template_directory() . '/inc/widgets/widget-newsletter.php';
require get_template_directory() . '/inc/widgets/widget-author.php';
require get_template_directory() . '/inc/widgets/widget-most-popular.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Timagazine Typography, Color
 */
require get_template_directory() . '/inc/typography.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Breadcrumb
 */
require get_template_directory() . '/inc/breadcrumb.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * woocommerce support
 */
add_action( 'after_setup_theme', 'timagazine_woocommerce_support' );
function timagazine_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
/**
 * woocommerce Hook
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Load Site Origin Bundle
 */
if ( class_exists( 'SiteOrigin_Widget' ) ) {
	require get_template_directory() . '/inc/widgets/widgets.php';
}

/**
 * Load WP Bootstrap Nav Walker file.
 */
if ( ! class_exists( 'WP_Bootstrap_Navwalker' )) {
	require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}

/**
 * Load TGM Plugin
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'timagazine_active_plugins' );

function timagazine_active_plugins() {
	$plugins = array(
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
		array(
			'name'      => 'Page Builder by SiteOrigin',
			'slug'      => 'siteorigin-panels',
			'required'  => false,
		),
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => false,
		)
	);
	tgmpa( $plugins );
}
/**
 * Scripts and styles for the Page Builder plugin
 */
function timagazine_load_pagebuilder_scripts() {

	global  $pagenow;

	if( $pagenow == 'post.php' || $pagenow == 'post-new.php' || $pagenow == 'widgets.php' || $pagenow == 'customize.php' ){
		wp_enqueue_script( 'timagazine-chosen', get_template_directory_uri() . '/inc/widgets/admin/js/chosen.jquery.min.js', array('jquery', 'jquery-ui-sortable'), '1.6.2', true );
		wp_enqueue_script( 'timagazine-chosen-init', get_template_directory_uri() . '/inc/widgets/admin/js/chosen-init.js', array( 'jquery' ), '1.0.0', true );

		wp_enqueue_style( 'timagazine-chosen-styles', get_template_directory_uri() . '/inc/widgets/admin/css/chosen.min.css', '1.6.2', false );

		wp_enqueue_style( 'timagazine-widgets-style', get_template_directory_uri() . '/inc/widgets/admin/css/widgets-style.css', '1.0.0', false );

	}

}
add_action( 'admin_enqueue_scripts', 'timagazine_load_pagebuilder_scripts' );
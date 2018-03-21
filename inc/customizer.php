<?php
/**
 * timagazine Theme Customizer
 *
 * @package timagazine
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function timagazine_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'title_tagline' )->title = __('Header', 'timagazine');

	/*--------------------------------------------------------------
	# Divider
	--------------------------------------------------------------*/
	class timagazine_divider extends WP_Customize_Control {
		public $type = 'divider';
		public $label = '';
		public function render_content() { ?>
			<hr/><hr/><hr/><h3><?php echo esc_html( $this->label ); ?></h3>
			<?php
		}
	}
	/*--------------------------------------------------------------
	# General
	--------------------------------------------------------------*/
	$wp_customize->add_setting('timagazine_options[divider]', array(
			'type'              => 'divider_control',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'timagazine_sanitize_text'
		)
	);
	$wp_customize->add_panel( 'general_settings_panel', array(
		'title' => __( 'General Settings', 'timagazine' ),
		'priority' => 10,
	) );

	## Sections ##

	$wp_customize->add_section( 'background_image', array(
		'title'          => __( 'Body Background Image', 'timagazine' ),
		'theme_supports' => 'custom-background',
		'panel' => 'general_settings_panel',
		'priority'       => 20
	) );

	$wp_customize->add_section( 'site_width',
		array(
		'title'          => __( 'Site Width', 'timagazine' ),
		'panel' => 'general_settings_panel',
		'priority'       => 10
	) );

	## Site Layout ##

	$wp_customize->add_setting(
		'site_layout',
		array(
			'default'           => 'boxed',
			'sanitize_callback' => 'timagazine_layout_sanitize',
		)
	);
	$wp_customize->add_control(
		'site_layout',
		array(
			'type'        => 'radio',
			'label'       => __( 'Site Layout', 'timagazine' ),
			'priority'       => 10,
			'section'     => 'site_width',
			'choices' => array(
				'wide'    => __( 'Wide', 'timagazine' ),
				'boxed'     => __( 'Boxed', 'timagazine' )
			),
		)
	);

	/*--------------------------------------------------------------
	# Header
	--------------------------------------------------------------*/
	## Divider ##

	$wp_customize->add_control( new timagazine_divider( $wp_customize, 'header_logo', array(
			'label' => __('Logo', 'timagazine'),
			'section' => 'title_tagline',
			'settings' => 'timagazine_options[divider]',
			'priority'      => 5
		) )
	);
	$wp_customize->add_control( new timagazine_divider( $wp_customize, 'header_favicon', array(
			'label' => __('Favicon', 'timagazine'),
			'section' => 'title_tagline',
			'settings' => 'timagazine_options[divider]',
			'priority'      => 50
		) )
	);

	$wp_customize->add_panel( 'header_panel', array(
		'title' => __( 'Header', 'timagazine' ),
		'priority' => 20
	) );

	## Sections ##

	$wp_customize->add_section( 'top_bar', array(
		'title'          => __( 'Top Bar', 'timagazine' ),
		'panel' => 'header_panel',
		'priority'       => 5
	) );

	$wp_customize->add_section( 'title_tagline', array(
		'title'          => __( 'Header Content', 'timagazine' ),
		'panel' => 'header_panel',
		'priority'       => 10
	) );

	$wp_customize->add_section( 'header_design', array(
		'title'          => __( 'Header Design Options', 'timagazine' ),
		'panel' => 'header_panel',
		'priority'       => 15
	) );

	$wp_customize->add_section( 'menu_design', array(
		'title'          => __( 'Menu Design', 'timagazine' ),
		'panel' => 'header_panel',
		'priority'       => 20
	) );

	$wp_customize->add_section( 'header_image', array(
		'title'          => __( 'Ads', 'timagazine' ),
		'panel' => 'header_panel',
		'priority'       => 40
	) );

	## Top Bar ##

	$wp_customize->add_setting( 'enable_top_bar', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'enable_top_bar', array(
		'label' => __( 'Show/Hide Top Bar', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'top_bar'
	) );

	$wp_customize->add_setting(
		'top_bar_bg',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'top_bar_bg',
			array(
				'label'         => __('Top Bar Background Color', 'timagazine'),
				'section'       => 'top_bar'
			)
		)
	);

	$wp_customize->add_setting(
		'top_bar_font_color',
		array(
			'default'           => '#222627',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'top_bar_font_color',
			array(
				'label'         => __('Top Bar Text Color', 'timagazine'),
				'section'       => 'top_bar'
			)
		)
	);

	$wp_customize->add_setting( 'top_bar_font_size', array(
		'default'           => '13',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'top_bar_font_size', array(
		'label' => __( 'Top Bar Font Size', 'timagazine' ),
		'type' => 'number',
		'section' => 'top_bar'
	) );

	$wp_customize->add_setting( 'top_bar_top_padding', array(
		'default'           => '10',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'top_bar_top_padding', array(
		'label' => __( 'Padding Top', 'timagazine' ),
		'type' => 'number',
		'section' => 'top_bar'
	) );

	$wp_customize->add_setting( 'top_bar_bottom_padding', array(
		'default'           => '10',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'top_bar_bottom_padding', array(
		'label' => __( 'Padding Bottom', 'timagazine' ),
		'type' => 'number',
		'section' => 'top_bar'
	) );

	## Divider ##

	$wp_customize->add_control( new timagazine_divider( $wp_customize, 'braking_news_divider', array(
			'label' => __('Braking News', 'timagazine'),
			'section' => 'top_bar',
			'settings' => 'timagazine_options[divider]'
		) )
	);

	$wp_customize->add_setting( 'enable_breaking_news', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'enable_breaking_news', array(
		'label' => __( 'Show/Hide Breaking News in Top Bar', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'top_bar'
	) );

	$wp_customize->add_setting( 'breaking_news_title', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_text',
	) );
	$wp_customize->add_control( 'breaking_news_title', array(
		'label' => __( 'Breaking News Title', 'timagazine' ),
		'type' => 'text',
		'section' => 'top_bar'
	) );

	$wp_customize->add_setting(
		'breaking_news_title_bg',
		array(
			'default'           => '#222627',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'breaking_news_title_bg',
			array(
				'label'         => __('Breaking News Title BG Color', 'timagazine'),
				'section'       => 'top_bar'
			)
		)
	);

	$wp_customize->add_setting(
		'recent_post_hand_pick',
		array(
			'default'           => 'post',
			'sanitize_callback' => 'timagazine_border_style_sanitize',
		)
	);
	$wp_customize->add_control(
		'recent_post_hand_pick',
		array(
			'type'        => 'select',
			'label'       => __( 'Recent Post Or Hand Pick', 'timagazine' ),
			'section'     => 'top_bar',
			'choices' => array(
				'post'     => __( 'Recent Post', 'timagazine' ),
				'custom'     => __( 'Hand Pick', 'timagazine' )
			),
		)
	);

	$wp_customize->add_setting( 'recent_post_limit', array(
		'default'           => '3',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'recent_post_limit', array(
		'label' => __( 'Recent Post Limit', 'timagazine' ),
		'description' => __( 'Post limit 3 for free version', 'timagazine' ),
		'type' => 'number',
		'section' => 'top_bar'
	) );

	$wp_customize->add_setting( 'breaking_news_content_1', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_text',
	) );
	$wp_customize->add_control( 'breaking_news_content_1', array(
		'label' => __( 'Breaking News Content 1', 'timagazine' ),
		'description' => __( 'Hand Pick Content 1', 'timagazine' ),
		'type' => 'text',
		'section' => 'top_bar'
	) );

	$wp_customize->add_setting( 'breaking_news_content_2', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_text',
	) );
	$wp_customize->add_control( 'breaking_news_content_2', array(
		'label' => __( 'Breaking News Content 2', 'timagazine' ),
		'description' => __( 'Hand Pick Content 2', 'timagazine' ),
		'type' => 'text',
		'section' => 'top_bar'
	) );

	$wp_customize->add_setting( 'breaking_news_content_3', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_text',
	) );
	$wp_customize->add_control( 'breaking_news_content_3', array(
		'label' => __( 'Breaking News Content 3', 'timagazine' ),
		'description' => __( 'Hand Pick Content 3', 'timagazine' ),
		'type' => 'text',
		'section' => 'top_bar'
	) );

	$wp_customize->add_setting( 'breaking_news_content_4', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_text',
	) );
	$wp_customize->add_control( 'breaking_news_content_4', array(
		'label' => __( 'Breaking News Content 4', 'timagazine' ),
		'description' => __( 'Hand Pick Content 4', 'timagazine' ),
		'type' => 'text',
		'section' => 'top_bar'
	) );

	## Divider ##

	$wp_customize->add_control( new timagazine_divider( $wp_customize, 'date_menu_divider', array(
			'label' => __('Date & Menu', 'timagazine'),
			'section' => 'top_bar',
			'settings' => 'timagazine_options[divider]'
		) )
	);

	$wp_customize->add_setting( 'enable_top_bar_date', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'enable_top_bar_date', array(
		'label' => __( 'Show/Hide Date in Top Bar', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'top_bar'
	) );

	$wp_customize->add_setting( 'enable_top_bar_menu', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'enable_top_bar_menu', array(
		'label' => __( 'Show/Hide Menu in Top Bar', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'top_bar'
	) );

	## Site Title and Tagline Color ##

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_textcolor',
			array(
				'label'         => __('Site Title and Tagline Color', 'timagazine'),
				'section'       => 'title_tagline'
			)
		)
	);


	## Header Banner Image ##

	$wp_customize->add_setting( 'enable_header_banner', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'enable_header_banner', array(
		'label' => __( 'Show/Hide Header Banner', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'header_image',
		'priority'       => 5
	) );
	$wp_customize->add_setting( 'header_banner_custom_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'header_banner_custom_url', array(
		'label' => __( 'Header Banner Custom URL', 'timagazine' ),
		'type' => 'url',
		'section' => 'header_image',
		'priority'       => 5
	) );


	## Header Design Option ##

	$wp_customize->add_setting(
		'header_bg_color',
		array(
			'default'           => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_bg_color',
			array(
				'label'         => __('Header Background Color', 'timagazine'),
				'section'       => 'header_design',
				'settings'      => 'header_bg_color'
			)
		)
	);

	$wp_customize->add_setting(
		'header_border_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_border_color',
			array(
				'label'         => __('Header Border Color', 'timagazine'),
				'section'       => 'header_design'
			)
		)
	);

	$wp_customize->add_setting(
		'header_border_style',
		array(
			'default'           => 'none',
			'sanitize_callback' => 'timagazine_border_style_sanitize',
		)
	);
	$wp_customize->add_control(
		'header_border_style',
		array(
			'type'        => 'select',
			'label'       => __( 'Header Border style', 'timagazine' ),
			'section'     => 'header_design',
			'choices' => array(
				'none'    => __( 'none', 'timagazine' ),
				'dotted'     => __( 'dotted', 'timagazine' ),
				'dashed'     => __( 'dashed', 'timagazine' ),
				'solid'     => __( 'solid', 'timagazine' ),
				'double'     => __( 'double', 'timagazine' ),
				'groove'     => __( 'groove', 'timagazine' ),
				'ridge'     => __( 'ridge', 'timagazine' )
			),
		)
	);

	$wp_customize->add_setting( 'header_border_size', array(
		'default'           => '1',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'header_border_size', array(
		'label' => __( 'Header Border Size', 'timagazine' ),
		'type' => 'number',
		'section' => 'header_design'
	) );

	$wp_customize->add_setting( 'header_top_padding', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'header_top_padding', array(
		'label' => __( 'Header Padding Top', 'timagazine' ),
		'type' => 'number',
		'section' => 'header_design'
	) );

	$wp_customize->add_setting( 'header_bottom_padding', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'header_bottom_padding', array(
		'label' => __( 'Header Padding Bottom', 'timagazine' ),
		'type' => 'number',
		'section' => 'header_design'
	) );

	## Menu Design ##

	$wp_customize->add_setting(
		'menu_layout',
		array(
			'default'           => 'wide',
			'sanitize_callback' => 'timagazine_layout_sanitize',
		)
	);
	$wp_customize->add_control(
		'menu_layout',
		array(
			'type'        => 'radio',
			'label'       => __( 'Menu Layout', 'timagazine' ),
			'section'     => 'menu_design',
			'choices' => array(
				'wide'    => __( 'default', 'timagazine' )
			),
		)
	);

	$wp_customize->add_setting(
		'main_menu_bg',
		array(
			'default'           => '#222627',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_menu_bg',
			array(
				'label'         => __('Menu Background Color', 'timagazine'),
				'section'       => 'menu_design'
			)
		)
	);

	$wp_customize->add_setting(
		'menu_color',
		array(
			'default'           => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_color',
			array(
				'label'         => __('Menu Item Font Color', 'timagazine'),
				'section'       => 'menu_design'
			)
		)
	);

	$wp_customize->add_setting( 'menu_font_size', array(
		'default'           => '13',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'menu_font_size', array(
		'label' => __( 'Menu Item Font Size', 'timagazine' ),
		'type' => 'number',
		'section' => 'menu_design'
	) );

	$wp_customize->add_setting( 'menu_font_weight', array(
		'default'           => '600',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'menu_font_weight', array(
		'label' => __( 'Menu Item Font Weight', 'timagazine' ),
		'type' => 'number',
		'section' => 'menu_design'
	) );

	$wp_customize->add_setting(
		'submenu_bg',
		array(
			'default'           => '#222627',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'submenu_bg',
			array(
				'label'         => __('Dropdown Area Background Color', 'timagazine'),
				'section'       => 'menu_design'
			)
		)
	);

	## Search ##

	$wp_customize->add_setting( 'search_enable', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'search_enable', array(
		'label' => __( 'Show/Hide Search Icon in Header', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'menu_design'
	) );

	/*--------------------------------------------------------------
	# Footer
	--------------------------------------------------------------*/

	$wp_customize->add_panel( 'footer_panel', array(
		'title' => __( 'Footer', 'timagazine' ),
		'priority' => 85
	) );

	## Sections ##

	$wp_customize->add_section( 'footer_general_settings', array(
		'title' => __( 'Footer General Settings', 'timagazine' ),
		'panel' => 'footer_panel',
		'priority' => 5,
	) );

	$wp_customize->add_section( 'footer_top', array(
		'title' => __( 'Footer Top', 'timagazine' ),
		'panel' => 'footer_panel',
		'priority' => 10,
	) );

	$wp_customize->add_section( 'footer_middle', array(
		'title' => __( 'Footer Middle', 'timagazine' ),
		'panel' => 'footer_panel',
		'priority' => 15,
	) );

	$wp_customize->add_section( 'footer_bottom', array(
		'title' => __( 'Footer Bottom', 'timagazine' ),
		'panel' => 'footer_panel',
		'priority' => 20,
	) );

	## Footer General Settings ##

	$wp_customize->add_setting(
		'footer_bg_color',
		array(
			'default'           => '#272f32',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_bg_color',
			array(
				'label'         => __('Footer Background Color', 'timagazine'),
				'section'       => 'footer_general_settings'
			)
		)
	);

	$wp_customize->add_setting(
		'footer_text_color',
		array(
			'default'           => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_text_color',
			array(
				'label'         => __('Footer Text Color', 'timagazine'),
				'section'       => 'footer_general_settings'
			)
		)
	);

	$wp_customize->add_setting(
		'footer_border_color',
		array(
			'default'           => '#272f32',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_border_color',
			array(
				'label'         => __('Footer Border Color', 'timagazine'),
				'section'       => 'footer_general_settings'
			)
		)
	);

	$wp_customize->add_setting(
		'footer_border_style',
		array(
			'default'           => 'none',
			'sanitize_callback' => 'timagazine_border_style_sanitize',
		)
	);
	$wp_customize->add_control(
		'footer_border_style',
		array(
			'type'        => 'select',
			'label'       => __( 'Footer Border style', 'timagazine' ),
			'section'     => 'footer_general_settings',
			'choices' => array(
				'none'    => __( 'none', 'timagazine' ),
				'dotted'     => __( 'dotted', 'timagazine' ),
				'dashed'     => __( 'dashed', 'timagazine' ),
				'solid'     => __( 'solid', 'timagazine' ),
				'double'     => __( 'double', 'timagazine' ),
				'groove'     => __( 'groove', 'timagazine' ),
				'ridge'     => __( 'ridge', 'timagazine' )
			),
		)
	);

	$wp_customize->add_setting( 'footer_border_size', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'footer_border_size', array(
		'label' => __( 'Footer Border Size', 'timagazine' ),
		'type' => 'number',
		'section' => 'footer_general_settings'
	) );

	$wp_customize->add_setting( 'footer_top_padding', array(
		'default'           => '30',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'footer_top_padding', array(
		'label' => __( 'Footer Padding Top', 'timagazine' ),
		'type' => 'number',
		'section' => 'footer_general_settings'
	) );

	$wp_customize->add_setting( 'footer_bottom_padding', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'footer_bottom_padding', array(
		'label' => __( 'Footer Padding Bottom', 'timagazine' ),
		'type' => 'number',
		'section' => 'footer_general_settings'
	) );


	## Footer Top ##

	$wp_customize->add_setting( 'enable_footer_top', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'enable_footer_top', array(
		'label' => __( 'Show/Hide Footer Top', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'footer_top'
	) );

	$wp_customize->add_setting(
		'footer_top_bg_color',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_top_bg_color',
			array(
				'label'         => __('Footer Top Background Color', 'timagazine'),
				'section'       => 'footer_top'
			)
		)
	);

	$wp_customize->add_setting(
		'footer_top_text_color',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_top_text_color',
			array(
				'label'         => __('Footer Top Text Color', 'timagazine'),
				'section'       => 'footer_top'
			)
		)
	);

	$wp_customize->add_setting(
		'footer_top_border_color',
		array(
			'default'           => '#2f383c',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_top_border_color',
			array(
				'label'         => __('Footer Top Border Color', 'timagazine'),
				'section'       => 'footer_top'
			)
		)
	);

	$wp_customize->add_setting(
		'footer_top_border_style',
		array(
			'default'           => 'none',
			'sanitize_callback' => 'timagazine_border_style_sanitize',
		)
	);
	$wp_customize->add_control(
		'footer_top_border_style',
		array(
			'type'        => 'select',
			'label'       => __( 'Footer Top Border style', 'timagazine' ),
			'description' => __( 'Border shows at bottom', 'timagazine' ),
			'section'     => 'footer_top',
			'choices' => array(
				'none'    => __( 'none', 'timagazine' ),
				'dotted'     => __( 'dotted', 'timagazine' ),
				'dashed'     => __( 'dashed', 'timagazine' ),
				'solid'     => __( 'solid', 'timagazine' ),
				'double'     => __( 'double', 'timagazine' ),
				'groove'     => __( 'groove', 'timagazine' ),
				'ridge'     => __( 'ridge', 'timagazine' )
			),
		)
	);

	$wp_customize->add_setting( 'footer_top_border_size', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'footer_top_border_size', array(
		'label' => __( 'Footer Top Border Size', 'timagazine' ),
		'type' => 'number',
		'section' => 'footer_top'
	) );

	$wp_customize->add_setting( 'footer_top_top_padding', array(
		'default'           => '30',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'footer_top_top_padding', array(
		'label' => __( 'Footer Top Padding Top', 'timagazine' ),
		'type' => 'number',
		'section' => 'footer_top'
	) );

	$wp_customize->add_setting( 'footer_top_bottom_padding', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'footer_top_bottom_padding', array(
		'label' => __( 'Footer Top Padding Bottom', 'timagazine' ),
		'type' => 'number',
		'section' => 'footer_top'
	) );

	$wp_customize->add_setting(
		'footer_widget_column',
		array(
			'default'           => 'two',
			'sanitize_callback' => 'timagazine_footer_column_sanitize',
		)
	);
	$wp_customize->add_control(
		'footer_widget_column',
		array(
			'type'        => 'radio',
			'label'       => __( 'Footer Column Settings', 'timagazine' ),
			'priority'       => 10,
			'section'     => 'footer_top',
			'choices' => array(
				'two'    => __( 'Two Columns', 'timagazine' ),
				'three'    => __( 'Three Columns', 'timagazine' ),
				'four'    => __( 'Four Columns', 'timagazine' )
			),
		)
	);

	## Footer Middle ##

	$wp_customize->add_setting( 'enable_footer_middle', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'enable_footer_middle', array(
		'label' => __( 'Show/Hide Footer Middle', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'footer_middle'
	) );

	$wp_customize->add_setting( 'footer_middle_top_padding', array(
		'default'           => '30',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'footer_middle_top_padding', array(
		'label' => __( 'Footer Middle Padding Top', 'timagazine' ),
		'type' => 'number',
		'section' => 'footer_middle'
	) );

	$wp_customize->add_setting( 'footer_middle_bottom_padding', array(
		'default'           => '30',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'footer_middle_bottom_padding', array(
		'label' => __( 'Footer Middle Padding Bottom', 'timagazine' ),
		'type' => 'number',
		'section' => 'footer_middle'
	) );

	$wp_customize->add_setting(
		'footer_middle_image',
		array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'footer_middle_image',
			array(
				'label'          => __( 'Upload Logo or A banner', 'timagazine' ),
				'type'           => 'image',
				'section'        => 'footer_middle'
			)
		)
	);

	$wp_customize->add_setting( 'social_footer_enable', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'social_footer_enable', array(
		'label' => __( 'Show/Hide Social Icons in Footer', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'footer_middle'
	) );

	$wp_customize->add_setting(
		'footer_middle_text_color',
		array(
			'default'           => '#989898',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_middle_text_color',
			array(
				'label'         => __('Social Text Color', 'timagazine'),
				'section'       => 'footer_middle'
			)
		)
	);

	$wp_customize->add_setting(
		'footer_middle_border_color',
		array(
			'default'           => '#2f383c',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_middle_border_color',
			array(
				'label'         => __('Social Border Color', 'timagazine'),
				'section'       => 'footer_middle'
			)
		)
	);

	## Footer Bottom ##

	$wp_customize->add_setting(
		'footer_bottom_bg_color',
		array(
			'default'           => '#f4b738',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_bottom_bg_color',
			array(
				'label'         => __('Footer Bottom BG Color', 'timagazine'),
				'section'       => 'footer_bottom'
			)
		)
	);

	$wp_customize->add_setting(
		'footer_bottom_text_color',
		array(
			'default'           => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_bottom_text_color',
			array(
				'label'         => __('Footer Bottom Text Color', 'timagazine'),
				'section'       => 'footer_bottom'
			)
		)
	);

	$wp_customize->add_setting( 'footer_bottom_top_padding', array(
		'default'           => '15',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'footer_bottom_top_padding', array(
		'label' => __( 'Footer Bottom Padding Top', 'timagazine' ),
		'type' => 'number',
		'section' => 'footer_bottom'
	) );

	$wp_customize->add_setting( 'footer_bottom_bottom_padding', array(
		'default'           => '15',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'footer_bottom_bottom_padding', array(
		'label' => __( 'Footer Bottom Padding Bottom', 'timagazine' ),
		'type' => 'number',
		'section' => 'footer_bottom'
	) );

	$wp_customize->add_setting( 'copyright', array(
		'default'           => 'TiMagazine By ThemeTim',
		'sanitize_callback' => 'timagazine_sanitize_text',
	) );
	$wp_customize->add_control( 'copyright', array(
		'label' => __( 'Footer Bottom Copyright Text', 'timagazine' ),
		'type' => 'textarea',
		'section' => 'footer_bottom'
	) );

	/*--------------------------------------------------------------
	# Social Media
	--------------------------------------------------------------*/
	
	$wp_customize->add_section( 'social_settings', array(
		'title' => __( 'Social Media', 'timagazine' ),
		'priority' => 60,
	) );

	## Social ##

	$wp_customize->add_setting( 'header_fb', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'header_fb', array(
		'label' => __( 'Facebook', 'timagazine' ),
		'type' => 'url',
		'section' => 'social_settings',
		'settings' => 'header_fb'
	) );

	$wp_customize->add_setting( 'header_tw', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'header_tw', array(
		'label' => __( 'Twitter', 'timagazine' ),
		'type' => 'url',
		'section' => 'social_settings',
		'settings' => 'header_tw'
	) );

	$wp_customize->add_setting( 'header_li', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'header_li', array(
		'label' => __( 'Linkedin', 'timagazine' ),
		'type' => 'url',
		'section' => 'social_settings',
		'settings' => 'header_li'
	) );

	$wp_customize->add_setting( 'header_pint', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'header_pint', array(
		'label' => __( 'Pinterest', 'timagazine' ),
		'type' => 'url',
		'section' => 'social_settings',
		'settings' => 'header_pint'
	) );

	$wp_customize->add_setting( 'header_ins', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'header_ins', array(
		'label' => __( 'Instagram', 'timagazine' ),
		'type' => 'url',
		'section' => 'social_settings',
		'settings' => 'header_ins'
	) );

	$wp_customize->add_setting( 'header_dri', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'header_dri', array(
		'label' => __( 'Dribbble', 'timagazine' ),
		'type' => 'url',
		'section' => 'social_settings',
		'settings' => 'header_dri'
	) );

	$wp_customize->add_setting( 'header_plus', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'header_plus', array(
		'label' => __( 'Plus Google', 'timagazine' ),
		'type' => 'url',
		'section' => 'social_settings',
		'settings' => 'header_plus'
	) );

	$wp_customize->add_setting( 'header_you', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'header_you', array(
		'label' => __( 'YouTube', 'timagazine' ),
		'type' => 'url',
		'section' => 'social_settings',
		'settings' => 'header_you'
	) );

	/*--------------------------------------------------------------
	# Color
	--------------------------------------------------------------*/

	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color',
			array(
				'label'         => __('Primary Color', 'timagazine'),
				'section'       => 'colors',
				'settings'      => 'primary_color',
				'priority'       => 5
			)
		)
	);
	$wp_customize->add_setting(
		'link_color',
		array(
			'default'           => '#f4b738',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color',
			array(
				'label'         => __('Link Color', 'timagazine'),
				'section'       => 'colors',
				'settings'      => 'link_color'
			)
		)
	);
	$wp_customize->add_setting(
		'link_hover_color',
		array(
			'default'           => '#204056',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_hover_color',
			array(
				'label'         => __('Link Hover Color', 'timagazine'),
				'section'       => 'colors',
				'settings'      => 'link_hover_color'
			)
		)
	);

	/*--------------------------------------------------------------
	# Category Color
	--------------------------------------------------------------*/

	## Sections ##

	$wp_customize->add_section(
		'category_color_section',
		array(
			'title'       => __( 'Category BG Color', 'timagazine' ),
			'description' => __( 'Choose BG color for specific category.', 'timagazine' ),
			'priority' => 45
		)
	);

	$args = array(
		'type'                     => 'post',
		'orderby'                  => 'name',
		'hide_empty'               => 0,
		'taxonomy'                 => 'category'
	);

	$category_lists = get_categories( $args );

	foreach( $category_lists as $category ){

		$wp_customize->add_setting( 'category_color_' . $category->term_id,
			array(
				'default'           => '#222627',
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'category_color_' . $category->term_id,
			array(
				'label'    => esc_html( $category->name ),
				'section'  => 'category_color_section',
				'settings' => 'category_color_' . $category->term_id,
			)
		));
	}

	/*--------------------------------------------------------------
	# Typography
	--------------------------------------------------------------*/

	$wp_customize->add_panel( 'typography_panel', array(
		'title' => __( 'Typography', 'timagazine' ),
		'priority' => 40
	) );

	## Sections ##

	$wp_customize->add_section( 'body_font', array(
		'title'          => __( 'Body Font', 'timagazine' ),
		'panel' => 'typography_panel',
		'priority'       => 10
	) );

	$wp_customize->add_section( 'heading_font', array(
		'title'          => __( 'Heading Font', 'timagazine' ),
		'panel' => 'typography_panel',
		'priority'       => 20
	) );

	## Body Font ##

	$wp_customize->add_setting(
		'bg_text_color',
		array(
			'default'           => '#555',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'bg_text_color',
			array(
				'label'         => __('Body Font Color', 'timagazine'),
				'section'       => 'body_font'
			)
		)
	);
	$wp_customize->add_setting( 'body_font_size', array(
		'default'           => '14',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'body_font_size', array(
		'label' => __( 'Body Font Size', 'timagazine' ),
		'type' => 'number',
		'section' => 'body_font'
	) );

	$wp_customize->add_setting(
		'body_font_name',
		array(
			'default' => 'Poppins:400',
			'sanitize_callback'     => 'timagazine_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'body_font_name',
		array(
			'type' => 'text',
			'label' => __('Body Font Name', 'timagazine'),
			'section' => 'body_font'
		)
	);
	$wp_customize->add_setting(
		'body_font_family',
		array(
			'default' => '\'Poppins\', sans-serif',
			'sanitize_callback'     => 'timagazine_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'body_font_family',
		array(
			'type' => 'text',
			'label' => __('Body Font Family', 'timagazine'),
			'section' => 'body_font'
		)
	);
	$wp_customize->add_setting( 'body_font_weight', array(
		'default'           => '400',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'body_font_weight', array(
		'label' => __( 'Body Font Weight', 'timagazine' ),
		'type' => 'text',
		'section' => 'body_font'
	) );

	## Heading Font ##

	$wp_customize->add_setting(
		'heading_color',
		array(
			'default'           => '#333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'heading_color',
			array(
				'label'         => __('Heading Color', 'timagazine'),
				'section'       => 'heading_font'
			)
		)
	);

	$wp_customize->add_setting('heading_font_name', array(
		'default'        => 'Poppins:600',
		'sanitize_callback'     => 'timagazine_sanitize_text',
	));
	$wp_customize->add_control( 'heading_font_name', array(
		'label'   => __('Heading Font Name', 'timagazine'),
		'section' => 'heading_font',
		'type'    => 'text'

	));
	$wp_customize->add_setting('heading_font_family', array(
		'default'        => '\'Poppins\', sans-serif',
		'sanitize_callback'     => 'timagazine_sanitize_text',
	));
	$wp_customize->add_control( 'heading_font_family', array(
		'label'   => __('Heading Font Family', 'timagazine'),
		'section' => 'heading_font',
		'type'    => 'text'

	));
	$wp_customize->add_setting( 'heading_font_weight', array(
		'default'           => '600',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'heading_font_weight', array(
		'label' => __( 'Heading Font Weight', 'timagazine' ),
		'type' => 'text',
		'section' => 'heading_font'
	) );

	/*--------------------------------------------------------------
	# Blog
	--------------------------------------------------------------*/

	$wp_customize->add_panel( 'blog_panel', array(
		'title' => __( 'Blog', 'timagazine' ),
		'priority' => 85
	) );

	## Sections ##

	$wp_customize->add_section( 'blog_layout_settings', array(
		'title'          => __( 'Blog Layout', 'timagazine' ),
		'panel' => 'blog_panel',
		'priority'       => 10
	) );

	$wp_customize->add_section( 'blog_meta', array(
		'title'          => __( 'Post Meta', 'timagazine' ),
		'panel' => 'blog_panel',
		'priority'       => 20
	) );

	$wp_customize->add_section( 'blog_content_excerpt', array(
		'title'          => __( 'Post Excerpts', 'timagazine' ),
		'panel' => 'blog_panel',
		'priority'       => 30
	) );

	$wp_customize->add_section( 'blog_featured_image', array(
		'title'          => __( 'Featured Image', 'timagazine' ),
		'panel' => 'blog_panel',
		'priority'       => 40
	) );

	## Blog Layout ##

	$wp_customize->add_setting(
		'blog_layout',
		array(
			'default'           => 'default',
			'sanitize_callback' => 'timagazine_blog_layout_sanitize',
		)
	);
	$wp_customize->add_control(
		'blog_layout',
		array(
			'type'        => 'radio',
			'label'       => __( 'Blog Layout', 'timagazine' ),
			'priority'       => 10,
			'section'     => 'blog_layout_settings',
			'choices' => array(
				'default'    => __( 'Default ( Masonry Two Columns )', 'timagazine' ),
				'blog-wide'     => __( 'Full Width ( One Column with sidebar)', 'timagazine' ),
				'masonry'     => __( 'Masonry ( Three Columns No Sidebar)', 'timagazine' ),
			),
		)
	);

	## Single Post Layout ##

	$wp_customize->add_control( new timagazine_divider( $wp_customize, 'single_layout_settings', array(
			'label' => __(' Single Post Layout', 'timagazine'),
			'section' => 'blog_layout_settings',
			'settings' => 'timagazine_options[divider]'
		) )
	);

	$wp_customize->add_setting( 'enable_single_post_sidebar', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'enable_single_post_sidebar', array(
		'label' => __( 'Show/Hide Sidebar', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'blog_layout_settings'
	) );

	## Blog Meta ##

	$wp_customize->add_setting( 'meta_index_enable', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'meta_index_enable', array(
		'label' => __( 'Show/Hide Blog Posts Meta', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'blog_meta',
		'priority'       => 20
	) );

	$wp_customize->add_setting( 'meta_single_enable', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'meta_single_enable', array(
		'label' => __( 'Show/Hide Single Posts Meta', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'blog_meta',
		'priority'       => 20
	) );

	## Excerpt length ##

	$wp_customize->add_setting( 'excerpt_content_enable', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'excerpt_content_enable', array(
		'label' => __( 'Show/Hide Post Excerpts', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'blog_content_excerpt'
	) );

	## Featured Image ##

	$wp_customize->add_setting( 'featured_image_index_enable', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'featured_image_index_enable', array(
		'label' => __( 'Show/Hide Blog Posts Featured Image', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'blog_featured_image',
		'priority'       => 30
	) );

	$wp_customize->add_setting( 'featured_image_single_enable', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'featured_image_single_enable', array(
		'label' => __( 'Show/Hide Single Posts Featured Image', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'blog_featured_image',
		'priority'       => 30
	) );

	/*--------------------------------------------------------------
	# Archive
	--------------------------------------------------------------*/

	$wp_customize->add_panel( 'archive_panel', array(
		'title' => __( 'Archive', 'timagazine' ),
		'priority' => 90
	) );

	## Sections ##

	$wp_customize->add_section( 'archive_layout_settings', array(
		'title'          => __( 'Archive Layout', 'timagazine' ),
		'panel' => 'archive_panel',
		'priority'       => 10
	) );

	$wp_customize->add_section( 'archive_meta', array(
		'title'          => __( 'Post Meta', 'timagazine' ),
		'panel' => 'archive_panel',
		'priority'       => 20
	) );

	$wp_customize->add_section( 'archive_featured_image', array(
		'title'          => __( 'Featured Image', 'timagazine' ),
		'panel' => 'archive_panel',
		'priority'       => 40
	) );

	## Archive  Layout ##

	$wp_customize->add_setting(
		'archive_layout',
		array(
			'default'           => 'blog-wide',
			'sanitize_callback' => 'timagazine_blog_layout_sanitize',
		)
	);
	$wp_customize->add_control(
		'archive_layout',
		array(
			'type'        => 'radio',
			'label'       => __( 'Archive Layout', 'timagazine' ),
			'priority'       => 10,
			'section'     => 'archive_layout_settings',
			'choices' => array(
				'default'    => __( 'Default ( One Column With Sidebar )', 'timagazine' ),
				'blog-wide'     => __( 'Two Columns ( sidebar )', 'timagazine' ),
				'masonry'     => __( 'Masonry Three Columns ( No Sidebar *Pro Version* )', 'timagazine' ),
			),
		)
	);

	## Archive Meta ##

	$wp_customize->add_setting( 'archive_meta_index_enable', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'archive_meta_index_enable', array(
		'label' => __( 'Show/Hide Archive Posts Meta', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'archive_meta',
		'priority'       => 20
	) );

	## Featured Image ##

	$wp_customize->add_setting( 'archive_featured_image_index_enable', array(
		'default'           => '',
		'sanitize_callback' => 'timagazine_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'archive_featured_image_index_enable', array(
		'label' => __( 'Show/Hide Archive Posts Featured Image', 'timagazine' ),
		'type' => 'checkbox',
		'section' => 'archive_featured_image',
		'priority'       => 30
	) );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'timagazine_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'timagazine_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'timagazine_customize_register' );
/**
 * Adding Go to Pro Section in Customizer
 * https://github.com/justintadlock/trt-customizer-pro
 */
if( class_exists( 'WP_Customize_Section' ) ) :
	/**
	 * Adding Go to Pro Section in Customizer
	 * https://github.com/justintadlock/trt-customizer-pro
	 */
	class timagazine_Customize_Section_Pro extends WP_Customize_Section {

		/**
		 * The type of customize section being rendered.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $type = 'pro-section';

		/**
		 * Custom button text to output.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $pro_text = '';

		/**
		 * Custom pro button URL.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $pro_url = '';

		/**
		 * Add custom parameters to pass to the JS via JSON.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function json() {
			$json = parent::json();

			$json['pro_text'] = $this->pro_text;
			$json['pro_url']  = esc_url( $this->pro_url );

			return $json;
		}

		/**
		 * Outputs the Underscore.js template.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		protected function render_template() { ?>
			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand get-pro-theme">
				<h3 class="accordion-section-title">
					{{ data.title }}
					<# if ( data.pro_text && data.pro_url ) { #>
						<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
						<# } #>
				</h3>
			</li>
		<?php }
	}
endif;

add_action( 'customize_register', 'timagazine_magazine_sections_pro' );
function timagazine_magazine_sections_pro( $wp_customize ) {
	// Register custom section types.
	$wp_customize->register_section_type( 'timagazine_Customize_Section_Pro' );

	// Register sections.
	$wp_customize->add_section(
		new timagazine_Customize_Section_Pro(
			$wp_customize,
			'timagazine_magazine_get_pro',
			array(
				'title'    => esc_html__( 'Pro Available', 'timagazine' ),
				'priority' => 5,
				'pro_text' => esc_html__( 'Get Pro Theme', 'timagazine' ),
				'pro_url'  => 'https://www.themetim.com/wordpress-themes/ti-magazine-pro/'
			)
		)
	);
}

/**
 * Text
 * @param $input
 * @return string
 */

function timagazine_sanitize_text( $input ) {
	return sanitize_text_field( $input );
}

/**
 * Checkbox
 * @param $input
 * @return int|string
 */
function timagazine_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Header Border Style Settings
 * @param $input
 * @return string
 */
function timagazine_border_style_sanitize( $input ) {
	$valid = array(
		'none'    => __( 'none', 'timagazine' ),
		'dotted'     => __( 'dotted', 'timagazine' ),
		'dashed'     => __( 'dashed', 'timagazine' ),
		'solid'     => __( 'solid', 'timagazine' ),
		'double'     => __( 'double', 'timagazine' ),
		'groove'     => __( 'groove', 'timagazine' ),
		'ridge'     => __( 'ridge', 'timagazine' ),
		'post'     => __( 'Recent Post', 'timagazine' ),
		'custom'     => __( 'Hand Pick', 'timagazine' ),
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Site/Menu Layout Settings
 * @param $input
 * @return string
 * timagazine_footer_column_sanitize
 */
function timagazine_layout_sanitize( $input ) {
	$valid = array(
		'wide'    => __('Wide', 'timagazine'),
		'boxed'     => __('Boxed', 'timagazine'),
		'collapse'     => __('Collapse', 'timagazine')
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Blog Layout Settings
 * @param $input
 * @return string
 */
function timagazine_blog_layout_sanitize( $input ) {
	$valid = array(
		'default'    => __( 'Default ( Sidebar )', 'timagazine' ),
		'blog-wide'     => __( 'Full Width', 'timagazine' ),
		'masonry'     => __( 'Masonry ( Two Columns )', 'timagazine' )
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Footer Column Settings
 * @param $input
 * @return string
 */
function timagazine_footer_column_sanitize( $input ) {
	$valid = array(
		'two'    => __( 'Two Column', 'timagazine' ),
		'three'    => __( 'Three Column', 'timagazine' ),
		'four'    => __( 'Four Column', 'timagazine' )
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function timagazine_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function timagazine_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function timagazine_customize_preview_js() {
	wp_enqueue_script( 'timagazine-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'timagazine_customize_preview_js' );
/**
 * Enqueue Scripts for customize controls
 */
function timagazine_customize_scripts() {
	wp_enqueue_script( 'timagazine-customize-controls-js', get_template_directory_uri().'/assets/js/customize-controls.js', array( 'jquery' ), '', true );
}
add_action( 'customize_controls_enqueue_scripts', 'timagazine_customize_scripts' );
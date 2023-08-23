<?php
/**
 * Charity Zone Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Charity Zone
 */

if ( ! defined( 'CHARITY_ZONE_URL' ) ) {
    define( 'CHARITY_ZONE_URL', esc_url( 'https://www.themagnifico.net/themes/charity-wordpress-theme/', 'charity-zone') );
}
if ( ! defined( 'CHARITY_ZONE_TEXT' ) ) {
    define( 'CHARITY_ZONE_TEXT', __( 'Charity Zone Pro','charity-zone' ));
}

use WPTRT\Customize\Section\Charity_Zone_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Charity_Zone_Button::class );

    $manager->add_section(
        new Charity_Zone_Button( $manager, 'charity_zone_pro', [
            'title'       => CHARITY_ZONE_TEXT,
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'charity-zone' ),
            'button_url'  => CHARITY_ZONE_URL
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'charity-zone-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'charity-zone-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function charity_zone_customize_register($wp_customize){

    // Theme Color
    $wp_customize->add_section('charity_zone_color_option',array(
        'title' => esc_html__('Theme Color','charity-zone'),
        'description' => esc_html__('Change theme color on one click.','charity-zone'),
        'priority'   => 10
    ));

    $wp_customize->add_setting( 'charity_zone_theme_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_theme_color', array(
        'label' => esc_html__('First Color Option','charity-zone'),
        'section' => 'charity_zone_color_option',
        'settings' => 'charity_zone_theme_color' 
    )));

    $wp_customize->add_setting( 'charity_zone_theme_color_2', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_theme_color_2', array(
        'label' => esc_html__('Second Color Option','charity-zone'),
        'section' => 'charity_zone_color_option',
        'settings' => 'charity_zone_theme_color_2' 
    )));
    
    
    // Top Header
    $wp_customize->add_section('charity_zone_top_header',array(
        'title' => esc_html__('Top Header','charity-zone'),
        'description' => esc_html__('Topbar content','charity-zone'),
        'priority'   => 110
    ));

    $wp_customize->add_setting('charity_zone_phone_number_info',array(
        'default' => '',
        'sanitize_callback' => 'charity_zone_sanitize_phone_number'
    )); 
    $wp_customize->add_control('charity_zone_phone_number_info',array(
        'label' => esc_html__('Phone Number','charity-zone'),
        'section' => 'charity_zone_top_header',
        'setting' => 'charity_zone_phone_number_info',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('charity_zone_email_info',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_email'
    )); 
    $wp_customize->add_control('charity_zone_email_info',array(
        'label' => esc_html__('Email Address','charity-zone'),
        'section' => 'charity_zone_top_header',
        'setting' => 'charity_zone_email_info',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('charity_zone_donate_button',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('charity_zone_donate_button',array(
        'label' => esc_html__('Donate Page Link','charity-zone'),
        'section' => 'charity_zone_top_header',
        'setting' => 'charity_zone_donate_button',
        'type'  => 'url'
    ));

    // General Settings
     $wp_customize->add_section('charity_zone_general_settings',array(
        'title' => esc_html__('General Settings','charity-zone'),
        'description' => esc_html__('General settings of our theme.','charity-zone'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('charity_zone_preloader_hide', array(
        'default' => false,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'charity-zone' ),
        'section'        => 'charity_zone_general_settings',
        'settings'       => 'charity_zone_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting( 'charity_zone_preloader_bg_color', array(
        'default' => '#000',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','charity-zone'),
        'section' => 'charity_zone_general_settings',
        'settings' => 'charity_zone_preloader_bg_color' 
    )));
    
    $wp_customize->add_setting( 'charity_zone_preloader_dot_1_color', array(
        'default' => '#fff',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','charity-zone'),
        'section' => 'charity_zone_general_settings',
        'settings' => 'charity_zone_preloader_dot_1_color' 
    )));

    $wp_customize->add_setting( 'charity_zone_preloader_dot_2_color', array(
        'default' => '#ff5722',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','charity-zone'),
        'section' => 'charity_zone_general_settings',
        'settings' => 'charity_zone_preloader_dot_2_color' 
    )));

    $wp_customize->add_setting('charity_zone_sticky_header', array(
        'default' => false,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_sticky_header',array(
        'label'          => __( 'Show Sticky Header', 'charity-zone' ),
        'section'        => 'charity_zone_general_settings',
        'settings'       => 'charity_zone_sticky_header',
        'type'           => 'checkbox',
    )));

    // Social Link
    $wp_customize->add_section('charity_zone_social_link',array(
        'title' => esc_html__('Social Links','charity-zone'),
        'description' => esc_html__('Social Contact','charity-zone'),
        'priority'   => 110
    ));

    $wp_customize->add_setting('charity_zone_facebook_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('charity_zone_facebook_url',array(
        'label' => esc_html__('Facebook Link','charity-zone'),
        'section' => 'charity_zone_social_link',
        'setting' => 'charity_zone_facebook_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('charity_zone_twitter_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('charity_zone_twitter_url',array(
        'label' => esc_html__('Twitter Link','charity-zone'),
        'section' => 'charity_zone_social_link',
        'setting' => 'charity_zone_twitter_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('charity_zone_intagram_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('charity_zone_intagram_url',array(
        'label' => esc_html__('Intagram Link','charity-zone'),
        'section' => 'charity_zone_social_link',
        'setting' => 'charity_zone_intagram_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('charity_zone_linkedin_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('charity_zone_linkedin_url',array(
        'label' => esc_html__('Linkedin Link','charity-zone'),
        'section' => 'charity_zone_social_link',
        'setting' => 'charity_zone_linkedin_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('charity_zone_pintrest_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )); 
    $wp_customize->add_control('charity_zone_pintrest_url',array(
        'label' => esc_html__('Pinterest Link','charity-zone'),
        'section' => 'charity_zone_social_link',
        'setting' => 'charity_zone_pintrest_url',
        'type'  => 'url'
    ));

    //Slider
    $wp_customize->add_section('charity_zone_top_slider',array(
        'title' => esc_html__('Slider Settings','charity-zone'),
        'description' => esc_html__('Here you have to add 3 different pages in below dropdown. Note: Image Dimensions 1200 x 400 px','charity-zone'),
        'priority'   => 130
    ));

    for ( $count = 1; $count <= 3; $count++ ) {

        $wp_customize->add_setting( 'charity_zone_top_slider_page' . $count, array(
            'default'           => '',
            'sanitize_callback' => 'charity_zone_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'charity_zone_top_slider_page' . $count, array(
            'label'    => __( 'Select Slide Page', 'charity-zone' ),
            'section'  => 'charity_zone_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    //Our Services section
    $wp_customize->add_section( 'charity_zone_services_section' , array(
        'title'      => __( 'Services Settings', 'charity-zone' ),
        'priority'   => 140
    ) );

    $categories = get_categories();
    $cat_post = array();
    $cat_post[]= 'select';
    $i = 0; 
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_post[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('charity_zone_services',array(
        'default'   => 'select',
        'sanitize_callback' => 'charity_zone_sanitize_choices',
    ));
    $wp_customize->add_control('charity_zone_services',array(
        'type'    => 'select',
        'choices' => $cat_post,
        'label' => __('Select Category to display Services','charity-zone'),
        'description' => __('Image Size (50 x 50)','charity-zone'),
        'section' => 'charity_zone_services_section',
    ));

    //About
    $wp_customize->add_section('charity_zone_about_section',array(
        'title' => esc_html__('About Settings','charity-zone'),
        'priority'   => 150
    ));

    $wp_customize->add_setting( 'charity_zone_about_page', array(
        'default'           => '',
        'sanitize_callback' => 'charity_zone_sanitize_dropdown_pages'
    ) );
    $wp_customize->add_control( 'charity_zone_about_page', array(
        'label'    => __( 'Select About Page', 'charity-zone' ),
        'section'  => 'charity_zone_about_section',
        'type'     => 'dropdown-pages'
    ) );
    
    // Footer
    $wp_customize->add_section('charity_zone_site_footer_section', array(
        'title' => esc_html__('Footer', 'charity-zone'),
    ));

    $wp_customize->add_setting('charity_zone_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('charity_zone_footer_text_setting', array(
        'label' => __('Replace the footer text', 'charity-zone'),
        'section' => 'charity_zone_site_footer_section',
        'priority' => 1,
        'type' => 'text',
    ));
}
add_action('customize_register', 'charity_zone_customize_register');
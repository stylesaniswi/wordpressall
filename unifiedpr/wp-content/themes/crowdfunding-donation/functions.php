<?php
/**
 * Crowdfunding Donation functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Crowdfunding Donation
 */

if ( ! defined( 'CHARITY_ZONE_URL' ) ) {
    define( 'CHARITY_ZONE_URL', esc_url( 'https://www.themagnifico.net/themes/donation-wordpress-theme/', 'crowdfunding-donation') );
}
if ( ! defined( 'CHARITY_ZONE_TEXT' ) ) {
    define( 'CHARITY_ZONE_TEXT', __( 'Donation Pro','crowdfunding-donation' ));
}

function crowdfunding_donation_enqueue_styles() {
    wp_enqueue_style('crowdfunding-donation-font', charity_zone_font_url(), array());
    wp_enqueue_style( 'flatly-css', esc_url(get_template_directory_uri()) . '/assets/css/flatly.css');
    $parentcss = 'crowdfunding-donation-style';
    $theme = wp_get_theme(); wp_enqueue_style( $parentcss, get_template_directory_uri() . '/style.css', array(), $theme->parent()->get('Version'));
    wp_enqueue_style( 'crowdfunding-donation-style', get_stylesheet_uri(), array( $parentcss ), $theme->get('Version'));
}

add_action( 'wp_enqueue_scripts', 'crowdfunding_donation_enqueue_styles' );

/**
 * Enqueue theme color style.
 */
function crowdfunding_donation_theme_color() {

    $theme_color_css = '';
    $charity_zone_theme_color = get_theme_mod('charity_zone_theme_color');

    $theme_color_css = '
        .navbar-brand, .sticky .entry-title::before, .donate-btn a, .main-navigation .menu > li > a:hover, .main-navigation .sub-menu, #button, .sidebar input[type="submit"], .comment-respond input#submit, .post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, posts-navigation .nav-previous a:hover, .posts-navigation .nav-next a:hover, .woocommerce .woocommerce-ordering select, .woocommerce ul.products li.product .onsale, .woocommerce span.onsale, .pro-button a, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, woocommerce button.button.alt, .woocommerce input.button.alt, .wp-block-button__link, .serv-box:hover, .woocommerce-account .woocommerce-MyAccount-navigation ul li, .btn-primary, .toggle-nav.mobile-menu button,.sidebar button[type="submit"],.sidebar .tagcloud a:hover{                
                background: '.esc_attr($charity_zone_theme_color).';
        }
        a,.sidebar a:hover, #colophon a:hover,#colophon a:focus, p.price, .woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-message::before, .woocommerce-info::before,.donate-btn a:hover,.causes-inner-box li a {
            color: '.esc_attr($charity_zone_theme_color).';
        }
        .woocommerce-message, .woocommerce-info,.wp-block-pullquote,.wp-block-quote, .wp-block-quote:not(.is-large):not(.is-style-large), .wp-block-pullquote,.btn-primary,#causes-sec h3{
            border-color: '.esc_attr($charity_zone_theme_color).' !important;
        }
    ';
    wp_add_inline_style( 'crowdfunding-donation-style',$theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'crowdfunding_donation_theme_color' );

function crowdfunding_donation_customize_register($wp_customize){

    // Our Mission section
    $wp_customize->add_section( 'crowdfunding_donation_mission_section' , array(
        'title'      => __( 'Mission Settings', 'crowdfunding-donation' ),
        'priority'   => null
    ) );

    $wp_customize->add_setting('crowdfunding_donation_mission_title', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('crowdfunding_donation_mission_title', array(
        'label' => __('Section Title', 'crowdfunding-donation'),
        'section' => 'crowdfunding_donation_mission_section',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('crowdfunding_donation_mission_text', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('crowdfunding_donation_mission_text', array(
        'label' => __('Section Text', 'crowdfunding-donation'),
        'section' => 'crowdfunding_donation_mission_section',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('crowdfunding_donation_mission_counter', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('crowdfunding_donation_mission_counter', array(
        'label' => __('Counter Number', 'crowdfunding-donation'),
        'section' => 'crowdfunding_donation_mission_section',
        'priority' => 1,
        'type' => 'number',
    ));

    $mission = get_theme_mod('crowdfunding_donation_mission_counter');
        for ($i=1; $i <= $mission; $i++) { 

        $wp_customize->add_setting('crowdfunding_donation_mission_count'.$i, array(
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('crowdfunding_donation_mission_count'.$i, array(
            'label' => __('Add Number ', 'crowdfunding-donation').$i,
            'section' => 'crowdfunding_donation_mission_section',
            'priority' => 1,
            'type' => 'text',
        ));
        $wp_customize->add_setting('crowdfunding_donation_mission_count_text'.$i, array(
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('crowdfunding_donation_mission_count_text'.$i, array(
            'label' => __('Add Text ', 'crowdfunding-donation').$i,
            'section' => 'crowdfunding_donation_mission_section',
            'priority' => 1,
            'type' => 'text',
        ));
    }

    $wp_customize->add_setting('crowdfunding_donation_mission_button_text', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('crowdfunding_donation_mission_button_text', array(
        'label' => __('Button Text', 'crowdfunding-donation'),
        'section' => 'crowdfunding_donation_mission_section',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('crowdfunding_donation_mission_button_url', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('crowdfunding_donation_mission_button_url', array(
        'label' => __('Button URL', 'crowdfunding-donation'),
        'section' => 'crowdfunding_donation_mission_section',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting( 'crowdfunding_donation_mission_img1', array(
        'capability'        => 'edit_theme_options',
        'default'           => '',
        'sanitize_callback' => 'crowdfunding_donation_sanitize_image',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'crowdfunding_donation_mission_img1', array(
        'label'    => __( 'Mission Image 1', 'crowdfunding-donation' ),
        'section'  => 'crowdfunding_donation_mission_section',
        'settings' => 'crowdfunding_donation_mission_img1',
    ) ) );

    $wp_customize->add_setting( 'crowdfunding_donation_mission_img2', array(
        'capability'        => 'edit_theme_options',
        'default'           => '',
        'sanitize_callback' => 'crowdfunding_donation_sanitize_image',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'crowdfunding_donation_mission_img2', array(
        'label'    => __( 'Mission Image 2', 'crowdfunding-donation' ),
        'section'  => 'crowdfunding_donation_mission_section',
        'settings' => 'crowdfunding_donation_mission_img2',
    ) ) );

    $wp_customize->add_setting( 'crowdfunding_donation_mission_img3', array(
        'capability'        => 'edit_theme_options',
        'default'           => '',
        'sanitize_callback' => 'crowdfunding_donation_sanitize_image',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'crowdfunding_donation_mission_img3', array(
        'label'    => __( 'Mission Image 3', 'crowdfunding-donation' ),
        'section'  => 'crowdfunding_donation_mission_section',
        'settings' => 'crowdfunding_donation_mission_img3',
    ) ) );

}
add_action('customize_register', 'crowdfunding_donation_customize_register');

if ( ! function_exists( 'crowdfunding_donation_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function crowdfunding_donation_setup() {

        add_theme_support( 'responsive-embeds' );

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

        add_image_size('crowdfunding-donation-featured-header-image', 2000, 660, true);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
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
        add_theme_support( 'custom-background', apply_filters( 'charity_zone_custom_background_args', array(
            'default-color' => '',
            'default-image' => '',
        ) ) );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 50,
            'width'       => 50,
            'flex-width'  => true,
        ) );

        add_editor_style( array( '/editor-style.css' ) );

        add_theme_support( 'align-wide' );

        add_theme_support( 'wp-block-styles' );
    }
endif;
add_action( 'after_setup_theme', 'crowdfunding_donation_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function crowdfunding_donation_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'crowdfunding-donation' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'crowdfunding-donation' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 1', 'crowdfunding-donation' ),
        'id'            => 'crowdfunding-donation-footer1',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h5 class="footer-column-widget-title">',
        'after_title'   => '</h5>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 2', 'crowdfunding-donation' ),
        'id'            => 'crowdfunding-donation-footer2',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h5 class="footer-column-widget-title">',
        'after_title'   => '</h5>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 3', 'crowdfunding-donation' ),
        'id'            => 'crowdfunding-donation-footer3',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h5 class="footer-column-widget-title">',
        'after_title'   => '</h5>',
    ) );
}
add_action( 'widgets_init', 'crowdfunding_donation_widgets_init' );

function crowdfunding_donation_remove_my_action() {
    remove_action( 'admin_menu','charity_zone_themepage' );
    remove_action( 'after_switch_theme','charity_zone_setup_options' );
}
add_action( 'init', 'crowdfunding_donation_remove_my_action');

function crowdfunding_donation_sanitize_image( $file, $setting ) {
 
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
 
    //check file type from file name
    $file_ext = wp_check_filetype( $file, $mimes );
 
    //if file has a valid mime type return it, otherwise return default
    return ( $file_ext['ext'] ? $file : $setting->default );
}
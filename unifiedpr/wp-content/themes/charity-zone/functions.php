<?php
/**
 * Charity Zone functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Charity Zone
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/Charity_Zone_Loader.php' );

$charity_zone_loader = new \WPTRT\Autoload\Charity_Zone_Loader();

$charity_zone_loader->charity_zone_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$charity_zone_loader->charity_zone_register();

if ( ! function_exists( 'charity_zone_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function charity_zone_setup() {

		add_theme_support( 'responsive-embeds'); 

		add_theme_support( 'woocommerce' );
		
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

        add_image_size('charity-zone-featured-header-image', 2000, 660, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary','charity-zone' ),
	        'footer'=> esc_html__( 'Footer Menu','charity-zone' ),
        ) );

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
			'default-color' => 'ffffff',
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
			'height'      => 50,
			'width'       => 50,
			'flex-width'  => true,
		) );

		add_editor_style( array( '/editor-style.css' ) );

		add_theme_support( 'wp-block-styles' );

		add_theme_support( 'align-wide' );
	}
endif;
add_action( 'after_setup_theme', 'charity_zone_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function charity_zone_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'charity_zone_content_width', 1170 );
}
add_action( 'after_setup_theme', 'charity_zone_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function charity_zone_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'charity-zone' ),
		'id'            => 'sidebar-1',
		'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'charity-zone' ),
		'id'            => 'charity-zone-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'charity-zone' ),
		'id'            => 'charity-zone-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'charity-zone' ),
		'id'            => 'charity-zone-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'charity_zone_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function charity_zone_scripts() {

	wp_enqueue_style('charity-zone-font', charity_zone_font_url(), array());

	wp_enqueue_style( 'charity-zone-block-editor-style', get_theme_file_uri('/assets/css/block-editor-style.css') );

    // load bootstrap css
    wp_enqueue_style( 'flatly-css', esc_url(get_template_directory_uri()) . '/assets/css/flatly.css');

	// fontawesome
	wp_enqueue_style( 'fontawesome-style', esc_url(get_template_directory_uri()).'/assets/css/fontawesome/css/all.css' );

	wp_enqueue_style( 'owl.carousel-style', esc_url(get_template_directory_uri()).'/assets/css/owl.carousel.css' );

	wp_enqueue_style( 'charity-zone-block-editor-style', get_theme_file_uri('/assets/css/block-editor-style.css') );

    wp_enqueue_style( 'charity-zone-style', get_stylesheet_uri() );

    wp_style_add_data('charity-zone-style', 'rtl', 'replace');

    wp_enqueue_script('owl.carousel-jquery', esc_url(get_template_directory_uri()) . '/assets/js/owl.carousel.js', array('jquery'), '', true );

    wp_enqueue_script('charity-zone-theme-js', esc_url(get_template_directory_uri()) . '/assets/js/theme-script.js', array('jquery'), '', true );
    
    wp_enqueue_script('charity-zone-skip-link-focus-fix', esc_url(get_template_directory_uri()) . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'charity_zone_scripts' );

/**
 * Enqueue theme color style.
 */
function charity_zone_theme_color() {

    $theme_color_css = '';
    $charity_zone_theme_color = get_theme_mod('charity_zone_theme_color');
    $charity_zone_theme_color_2 = get_theme_mod('charity_zone_theme_color_2');
    $charity_zone_preloader_bg_color = get_theme_mod('charity_zone_preloader_bg_color');
    $charity_zone_preloader_dot_1_color = get_theme_mod('charity_zone_preloader_dot_1_color');
    $charity_zone_preloader_dot_2_color = get_theme_mod('charity_zone_preloader_dot_2_color');

    if(get_theme_mod('charity_zone_preloader_bg_color') == '') {
			$charity_zone_preloader_bg_color = '#000';
		}
		if(get_theme_mod('charity_zone_preloader_dot_1_color') == '') {
			$charity_zone_preloader_dot_1_color = '#fff';
		}
		if(get_theme_mod('charity_zone_preloader_dot_2_color') == '') {
			$charity_zone_preloader_dot_2_color = '#fbb703';
		}

	$theme_color_css = '
		.navbar-brand,.sidebar button[type="submit"],.sticky .entry-title::before,.donate-btn a,.main-navigation .menu > li > a:hover,.main-navigation .sub-menu,#button,.sidebar input[type="submit"],.comment-respond input#submit,.post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, .posts-navigation .nav-previous a:hover, .posts-navigation .nav-next a:hover,.woocommerce .woocommerce-ordering select,.woocommerce ul.products li.product .onsale, .woocommerce span.onsale,.pro-button a, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.wp-block-button__link,.serv-box:hover,.woocommerce-account .woocommerce-MyAccount-navigation ul li,.btn-primary,.toggle-nav.mobile-menu button,thead,a.added_to_cart.wc-forward{
			background: '.esc_attr($charity_zone_theme_color).';
		}
		@media screen and (max-width:1000px){
	         .sidenav #site-navigation {
	        background: '.esc_attr($charity_zone_theme_color).';
	 		}
		}
		a,.sidebar a:hover,#colophon a:hover, #colophon a:focus,p.price, .woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price,.woocommerce-message::before, .woocommerce-info::before,.slider-inner-box a h2,.social-link i,.socialmedia i {
			color: '.esc_attr($charity_zone_theme_color).';
		}
		.woocommerce-message, .woocommerce-info,.wp-block-pullquote,.wp-block-quote, .wp-block-quote:not(.is-large):not(.is-style-large), .wp-block-pullquote,.btn-primary,.sidebar th, #theme-sidebar td{
			border-color: '.esc_attr($charity_zone_theme_color).';
		}
		.has-black-background-color,.has-black-color,#button:hover,#button:active,.main-navigation .sub-menu > li > a:hover, .main-navigation .sub-menu > li > a:focus,#colophon,.sidebar h5,.socialmedia,.donate-btn a:hover,.woocommerce-account .woocommerce-MyAccount-navigation ul li:hover,.woocommerce .woocommerce-error .button:hover, .woocommerce .woocommerce-info .button:hover, .woocommerce .woocommerce-message .button:hover, .woocommerce-page .woocommerce-error .button:hover, .woocommerce-page .woocommerce-info .button, .woocommerce-page .woocommerce-message .button:hover,.woocommerce button.button:hover,.comment-respond input#submit:hover,.woocommerce a.button:hover,.woocommerce a.button.alt:hover,.woocommerce button.button:hover,.woocommerce button.button.alt:hover,a.added_to_cart.wc-forward:hover{
			background: '.esc_attr($charity_zone_theme_color_2).';
		}
		.main-navigation .menu > li > a,.custom-header .bg-gradient .centered a button,.custom-header .bg-gradient .centered a button,h1,h2,h3,h4,h5,h6,.serv-box a{
			color: '.esc_attr($charity_zone_theme_color_2).';
		}
		.woocommerce .quantity .qty{
			border-color: '.esc_attr($charity_zone_theme_color_2).';
		}
		.loading{
			background-color: '.esc_attr($charity_zone_preloader_bg_color).';
		 }
		 @keyframes loading {
		  0%,
		  100% {
		  	transform: translatey(-2.5rem);
		    background-color: '.esc_attr($charity_zone_preloader_dot_1_color).';
		  }
		  50% {
		  	transform: translatey(2.5rem);
		    background-color: '.esc_attr($charity_zone_preloader_dot_2_color).';
		  }
		}
	';
    wp_add_inline_style( 'charity-zone-style',$theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'charity_zone_theme_color' );

/**
 * Enqueue S Header.
 */
function charity_zone_sticky_header() {

	$charity_zone_sticky_header = get_theme_mod('charity_zone_sticky_header');

	$charity_zone_custom_style= "";

	if($charity_zone_sticky_header != true){

		$charity_zone_custom_style .='.stick_header{';

			$charity_zone_custom_style .='position: static;';
			
		$charity_zone_custom_style .='}';
	} 

	wp_add_inline_style( 'charity-zone-style',$charity_zone_custom_style );

}
add_action( 'wp_enqueue_scripts', 'charity_zone_sticky_header' );


function charity_zone_font_url(){
	$font_url = '';
	$lobster = _x('on','Lobster:on or off','charity-zone');
	$lato = _x('on','Lato:on or off','charity-zone');
	
	if('off' !== $lobster ){
		$font_family = array();
		if('off' !== $lobster){
			$font_family[] = 'Lobster';
		}	
		if('off' !== $lato){
			$font_family[] = 'Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900';
		}
		$query_args = array(
			'family'	=> urlencode(implode('|',$font_family)),
		);
		$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	}
	return $font_url;
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/*dropdown page sanitization*/
function charity_zone_sanitize_dropdown_pages( $page_id, $setting ) {
	// Ensure $input is an absolute integer.
	$page_id = absint( $page_id );
	// If $page_id is an ID of a published page, return it; otherwise, return the default.
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

/*radio button sanitization*/
function charity_zone_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function charity_zone_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

/* Excerpt Limit Begin */
function charity_zone_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function charity_zone_skip_link_focus_fix() {
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'charity_zone_skip_link_focus_fix' );

function charity_zone_sanitize_checkbox( $input ) {
	// Boolean check 
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

/**
 * Get CSS
 */

function charity_zone_getpage_css($hook) {
	if ( 'appearance_page_charity-zone-info' != $hook ) {
		return;
	}
	wp_enqueue_style( 'charity-zone-demo-style', get_template_directory_uri() . '/assets/css/demo.css' );
}
add_action( 'admin_enqueue_scripts', 'charity_zone_getpage_css' );

add_action('after_switch_theme', 'charity_zone_setup_options');

function charity_zone_setup_options () {
	wp_redirect( admin_url() . 'themes.php?page=charity-zone-info.php' );
}

if ( ! defined( 'CHARITY_ZONE_CONTACT_SUPPORT' ) ) {
define('CHARITY_ZONE_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/charity-zone/','charity-zone'));
}
if ( ! defined( 'CHARITY_ZONE_REVIEW' ) ) {
define('CHARITY_ZONE_REVIEW',__('https://wordpress.org/support/theme/charity-zone/reviews/','charity-zone'));
}
if ( ! defined( 'CHARITY_ZONE_LIVE_DEMO' ) ) {
define('CHARITY_ZONE_LIVE_DEMO',__('https://www.themagnifico.net/eard/charity-wordpress-theme/','charity-zone'));
}
if ( ! defined( 'CHARITY_ZONE_GET_PREMIUM_PRO' ) ) {
define('CHARITY_ZONE_GET_PREMIUM_PRO',__('https://www.themagnifico.net/themes/charity-wordpress-theme/','charity-zone'));
}
if ( ! defined( 'CHARITY_ZONE_PRO_DOC' ) ) {
define('CHARITY_ZONE_PRO_DOC',__('https://www.themagnifico.net/eard/wathiqa/charity-pro-doc/','charity-zone'));
}

add_action('admin_menu', 'charity_zone_themepage');
function charity_zone_themepage(){
	$theme_info = add_theme_page( __('Theme Options','charity-zone'), __('Theme Options','charity-zone'), 'manage_options', 'charity-zone-info.php', 'charity_zone_info_page' );
}

function charity_zone_info_page() {
	$user = wp_get_current_user();
	$theme = wp_get_theme();
	?>
	<div class="wrap about-wrap charity-zone-add-css">
		<div>
			<h1>
				<?php esc_html_e('Welcome To ','charity-zone'); ?><?php echo esc_html( $theme ); ?>
			</h1>
			<div class="feature-section three-col">
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Contact Support", "charity-zone"); ?></h3>
						<p><?php esc_html_e("Thank you for trying Charity Zone , feel free to contact us for any support regarding our theme.", "charity-zone"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( CHARITY_ZONE_CONTACT_SUPPORT ); ?>" class="button button-primary get">
							<?php esc_html_e("Contact Support", "charity-zone"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Checkout Premium", "charity-zone"); ?></h3>
						<p><?php esc_html_e("Our premium theme comes with extended features like demo content import , responsive layouts etc.", "charity-zone"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( CHARITY_ZONE_GET_PREMIUM_PRO ); ?>" class="button button-primary get">
							<?php esc_html_e("Get Premium", "charity-zone"); ?>
						</a></p>
					</div>
				</div>  
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Review", "charity-zone"); ?></h3>
						<p><?php esc_html_e("If You love Charity Zone theme then we would appreciate your review about our theme.", "charity-zone"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( CHARITY_ZONE_REVIEW ); ?>" class="button button-primary get">
							<?php esc_html_e("Review", "charity-zone"); ?>
						</a></p>
					</div>
				</div>
			</div>
		</div>
		<hr>

		<h2><?php esc_html_e("Free Vs Premium","charity-zone"); ?></h2>
		<div class="charity-zone-button-container">
			<a target="_blank" href="<?php echo esc_url( CHARITY_ZONE_PRO_DOC ); ?>" class="button button-primary get">
				<?php esc_html_e("Checkout Documentation", "charity-zone"); ?>
			</a>
			<a target="_blank" href="<?php echo esc_url( CHARITY_ZONE_LIVE_DEMO ); ?>" class="button button-primary get">
				<?php esc_html_e("View Theme Demo", "charity-zone"); ?>
			</a>
		</div>

		<table class="wp-list-table widefat">
			<thead class="table-book">
				<tr>
					<th><strong><?php esc_html_e("Theme Feature", "charity-zone"); ?></strong></th>
					<th><strong><?php esc_html_e("Basic Version", "charity-zone"); ?></strong></th>
					<th><strong><?php esc_html_e("Premium Version", "charity-zone"); ?></strong></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?php esc_html_e("Header Background Color", "charity-zone"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Navigation Logo Or Text", "charity-zone"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Hide Logo Text", "charity-zone"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Premium Support", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Fully SEO Optimized", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Recent Posts Widget", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Easy Google Fonts", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Pagespeed Plugin", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Header Image On Front Page", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Show Header Everywhere", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Text On Header Image", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Full Width (Hide Sidebar)", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Upper Widgets On Front Page", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Replace Copyright Text", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Upper Widgets Colors", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Navigation Color", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Post/Page Color", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Blog Feed Color", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Footer Color", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Sidebar Color", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Background Color", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Importable Demo Content	", "charity-zone"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
			</tbody>
		</table>
		<div class="charity-zone-button-container">
			<a target="_blank" href="<?php echo esc_url( CHARITY_ZONE_GET_PREMIUM_PRO ); ?>" class="button button-primary get">
				<?php esc_html_e("Go Premium", "charity-zone"); ?>
			</a>
		</div>
	</div>
	<?php
}

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'charity_zone_loop_columns', 999);
if (!function_exists('charity_zone_loop_columns')) {
	function charity_zone_loop_columns() {
		return 3;
	}
}
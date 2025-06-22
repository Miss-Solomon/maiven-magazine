<?php
/**
 * Minerva functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package minerva
 */


/**
 * define theme info
 * @since 1.0.0
 * */
 
 if (is_child_theme()){
	$theme = wp_get_theme();
	$parent_theme = $theme->Template;
	$theme_info = wp_get_theme($parent_theme);
}else{
	$theme_info = wp_get_theme();
}

define('MINERVA_DEV_MODE',true);
$minerva_version = MINERVA_DEV_MODE ? time() : $theme_info->get('Version');
define('MINERVA_NAME',$theme_info->get('Name'));
define('MINERVA_VERSION',$minerva_version);
define('MINERVA_AUTHOR',$theme_info->get('Author'));
define('MINERVA_AUTHOR_URI',$theme_info->get('AuthorURI'));


/**
 * Define Const for theme Dir
 * @since 1.0.0
 * */

define('MINERVA_THEME_URI', get_template_directory_uri());
define('MINERVA_IMG', MINERVA_THEME_URI . '/assets/images');
define('MINERVA_CSS', MINERVA_THEME_URI . '/assets/css');
define('MINERVA_JS', MINERVA_THEME_URI . '/assets/js');
define('MINERVA_THEME_DIR', get_template_directory());
define('MINERVA_IMG_DIR', MINERVA_THEME_DIR . '/assets/images');
define('MINERVA_CSS_DIR', MINERVA_THEME_DIR . '/assets/css');
define('MINERVA_JS_DIR', MINERVA_THEME_DIR . '/assets/js');
define('MINERVA_INC', MINERVA_THEME_DIR . '/inc');
define('MINERVA_THEME_OPTIONS',MINERVA_INC .'/theme-options');
define('MINERVA_THEME_OPTIONS_IMG',MINERVA_THEME_OPTIONS .'/img');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
*/
	 
function minerva_setup(){
	
	// make the theme available for translation
	load_theme_textdomain( 'minerva', get_template_directory() . '/languages' );
	
	// add support for post formats
    add_theme_support('post-formats', [
        'standard', 'image', 'video', 'audio','gallery'
    ]);

    // add support for automatic feed links
    add_theme_support('automatic-feed-links');

    // let WordPress manage the document title
    add_theme_support('title-tag');
	
	// add editor style theme support
	function minerva_theme_add_editor_styles() {
		add_editor_style( 'custom-style.css' );
	}
	add_action( 'admin_init', 'minerva_theme_add_editor_styles' );

    // add support for post thumbnails
    add_theme_support('post-thumbnails');
	
	// hard crop center center
    set_post_thumbnail_size(960, 517, ['center', 'center']);
	add_image_size( 'minerva-box-slider-small', 96, 96, true );
	
	
	// register navigation menus
    register_nav_menus(
        [
            'primary' => esc_html__('Primary Menu', 'minerva'),
            'footermenu' => esc_html__('Footer Menu', 'minerva'),
        ]
    );
	
	
	// HTML5 markup support for search form, comment form, and comments
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));
	
	
	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 150,
		'width'       => 300,
		'flex-width'  => true,
		'flex-height' => true,
	) );
	
	
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	
	/*
     * Enable support for wide alignment class for Gutenberg blocks.
     */
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
		
}

add_action('after_setup_theme', 'minerva_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*/
 
function minerva_widget_init() {
	

        register_sidebar( array (
			'name' => esc_html__('Blog widget area', 'minerva'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Blog Sidebar Widget.', 'minerva'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area One', 'minerva' ),
			'id'            => 'footer-widget-1',
			'description'   => esc_html__( 'Add Footer  widgets here.', 'minerva' ),
			'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );			

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area Two', 'minerva' ),
			'id'            => 'footer-widget-2',
			'description'   => esc_html__( 'Add Footer widgets here.', 'minerva' ),
			'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );			

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area Three', 'minerva' ),
			'id'            => 'footer-widget-3',
			'description'   => esc_html__( 'Add Footer widgets here.', 'minerva' ),
			'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );			

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area Four', 'minerva' ),
			'id'            => 'footer-widget-4',
			'description'   => esc_html__( 'Add Footer widgets here.', 'minerva' ),
			'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );	

		register_sidebar( array(
			'name'          => esc_html__( 'Panel Menu Widget Area', 'minerva' ),
			'id'            => 'panel-nav',
			'description'   => esc_html__( 'Add Panel Nav widgets here.', 'minerva' ),
			'before_widget' => '<div id="%1$s" class="panel-widget widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );	
					
}

add_action('widgets_init', 'minerva_widget_init');


/**
 * Enqueue scripts and styles.
 */
function minerva_scripts() {
	
	// Theme CSS 
	
	wp_enqueue_style( 'themefont-awesome', MINERVA_CSS . '/font-awesome.css');
	wp_enqueue_style( 'icon-font',  MINERVA_CSS . '/icon-font.css' );
	wp_enqueue_style( 'remix-font',  MINERVA_CSS . '/remixicon.css' );
	wp_enqueue_style( 'animate',  MINERVA_CSS . '/animate.css' );
	wp_enqueue_style( 'magnific-popup',  MINERVA_CSS . '/magnific-popup.css' );
	wp_enqueue_style( 'owl-carousel',  MINERVA_CSS . '/owl.carousel.min.css' );
	wp_enqueue_style( 'owl-theme',  MINERVA_CSS . '/owl.theme.min.css' );
	wp_enqueue_style( 'slick',  MINERVA_CSS . '/slick.css' );
	wp_enqueue_style( 'slicknav',  MINERVA_CSS . '/slicknav.css' );
	wp_enqueue_style( 'bootstrap', MINERVA_CSS . '/bootstrap.min.css', array(), '4.0', 'all');
	wp_enqueue_style( 'theme-fonts', MINERVA_CSS . '/theme-fonts.css', array(), '1.0', 'all');
	wp_enqueue_style( 'minerva-main',  MINERVA_CSS . '/main.css' );
	wp_enqueue_style( 'minerva-responsive',  MINERVA_CSS . '/responsive.css' );	

	wp_enqueue_style( 'minerva-style', get_stylesheet_uri() );
	
	// Theme JS
	
	wp_enqueue_script( 'bootstrap',  MINERVA_JS . '/bootstrap.min.js', array( 'jquery' ),  '4.0', true );
	wp_enqueue_script( 'popper',  MINERVA_JS . '/popper.min.js', array( 'jquery' ),  '1.0', true );
	wp_enqueue_script( 'jquery-magnific-popup',  MINERVA_JS . '/jquery.magnific-popup.min.js', array( 'jquery' ),  '1.0', true );
	wp_enqueue_script( 'jquery-appear',  MINERVA_JS . '/jquery.appear.min.js', array( 'jquery' ),  '1.0', true );
	wp_enqueue_script( 'owl-carousel',  MINERVA_JS . '/owl.carousel.min.js', array( 'jquery' ),  '1.0', true );
	wp_enqueue_script( 'slick', MINERVA_JS . '/slick.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'jquery-slicknav', MINERVA_JS . '/jquery.slicknav.min.js', array( 'jquery' ), '1.0', true );
	
	// Custom JS Scripts
	
	wp_enqueue_script( 'minerva-scripts',  MINERVA_JS . '/scripts.js', array( 'jquery' ),  '1.0', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	

}

add_action( 'wp_enqueue_scripts', 'minerva_scripts' );


/*
* Include codester helper functions
* @since 1.0.0
*/

if ( file_exists( MINERVA_INC.'/cs-framework-functions.php' ) ) {
	require_once  MINERVA_INC.'/cs-framework-functions.php';
}

/**
 * Theme option panel & Metaboxes.
*/
 if ( file_exists( MINERVA_THEME_OPTIONS.'/theme-options.php' ) ) {
	require_once  MINERVA_THEME_OPTIONS.'/theme-options.php';
}

if ( file_exists( MINERVA_THEME_OPTIONS.'/theme-metabox.php' ) ) {
	require_once  MINERVA_THEME_OPTIONS.'/theme-metabox.php';
}

if ( file_exists( MINERVA_THEME_OPTIONS.'/theme-nav-options.php' ) ) {
	require_once  MINERVA_THEME_OPTIONS.'/theme-nav-options.php';
}

if ( file_exists( MINERVA_THEME_OPTIONS.'/theme-customizer.php' ) ) {
	require_once  MINERVA_THEME_OPTIONS.'/theme-customizer.php';
}


if ( file_exists( MINERVA_THEME_OPTIONS.'/theme-inline-styles.php' ) ) {
	require_once  MINERVA_THEME_OPTIONS.'/theme-inline-styles.php';
}


/**
 * Required plugin installer 
*/
require get_template_directory() . '/inc/required-plugins.php';


/**
 * Custom template tags & functions for this theme.
*/
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'woocommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Nav walker class for this theme.
*/
require get_template_directory() . '/inc/theme-nav-walker.php';

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
*/
function minerva_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'minerva_content_width', 640 );
}

add_action( 'after_setup_theme', 'minerva_content_width', 0 );

/**
 * Nav menu fallback function
*/

function minerva_fallback_menu() {
	get_template_part( 'template-parts/default', 'menu' );
}

// Get post views
function minerva_get_post_views($post_ID){
    $count_key = 'post_views';
    $count = intval( get_post_meta($post_ID, $count_key, true) );
    if($count > 999) {
        $count = substr($count,0, -2) / 10 . 'K';
    }
    return $count;
}

function minerva_enable_svg_upload( $upload_mimes ) {
    $upload_mimes['svg'] = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';
    return $upload_mimes;
}

add_filter( 'upload_mimes', 'minerva_enable_svg_upload', 10, 1 );

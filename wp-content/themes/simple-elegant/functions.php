<?php
/**
 * Simple & Elegant functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package Simple & Elegant
 * @since 1.0
 */

// since 2.3
define( 'SIMPLE_ELEGANT_VERSION', '2.6.3' );

/* Content Width
-------------------------------------------------------------------------------------- */
if ( ! isset( $content_width ) ) {
	$content_width = 705;
}

/* Backward Compatible
 * 4.9 & upper
-------------------------------------------------------------------------------------- */
if ( version_compare( $GLOBALS['wp_version'], '4.9-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

/* Theme Setup
-------------------------------------------------------------------------------------- */
if ( ! function_exists( 'withemes_setup' ) ) :
function withemes_setup() {

	/* Translating
    --------------------- */
	load_theme_textdomain( 'simple-elegant', get_template_directory() . '/languages' );

	/* Feed
    --------------------- */
	add_theme_support( 'automatic-feed-links' );

	/* WP 4.1 title tag support
    --------------------- */
	add_theme_support( 'title-tag' );

	/* Post Thumbnail
    --------------------- */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'wi-medium', 400, 300, true );
    add_image_size( 'wi-square', 400, 400, true );
    add_image_size( 'wi-portrait', 400, 500, true );

	/* Menu
    --------------------- */
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'simple-elegant' ),
		'topbar'  => esc_html__( 'Topbar Menu', 'simple-elegant' ),
	) );

	/* HTML 5
    --------------------- */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/* Post Formats
    --------------------- */
	add_theme_support( 'post-formats', array(
		'video', 'gallery', 'audio'
	) );
    
    /* moved to woo/hooks.php since 2.3
    // add_theme_support( 'woocommerce' );

	/* Editor Style
    --------------------- */
	add_editor_style( array( 'css/editor-style.css' ) );
    
    
}
endif; // withemes_setup
add_action( 'after_setup_theme', 'withemes_setup' );

// @since 1.1.1
add_action( 'vc_before_init', 'withemes_vc_set_as_theme' );
if ( ! function_exists( 'withemes_vc_set_as_theme' ) ) :
function withemes_vc_set_as_theme() {
    vc_set_as_theme(true);
};
endif;

/* Widget Area
-------------------------------------------------------------------------------------- */
if ( ! function_exists( 'withemes_widgets_init' ) ) :
function withemes_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'simple-elegant' ),
		'id'            => 'main',
		'description'   => esc_html__( 'Plays Sidebar role for blog & archive pages', 'simple-elegant' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Post Sidebar', 'simple-elegant' ),
		'id'            => 'single',
		'description'   => esc_html__( 'Plays Sidebar role for single post', 'simple-elegant' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'simple-elegant' ),
		'id'            => 'page',
		'description'   => esc_html__( 'Plays Sidebar role for pages', 'simple-elegant' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'simple-elegant' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Footer widgets position 1', 'simple-elegant' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'simple-elegant' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Footer widgets position 2', 'simple-elegant' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'simple-elegant' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Footer widgets position 3', 'simple-elegant' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
}
endif;
add_action( 'widgets_init', 'withemes_widgets_init' );

/* JavaScript Detection
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
-------------------------------------------------------------------------------------- */
if ( !function_exists('withemes_javascript_detection') ):
function withemes_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
endif;
add_action( 'wp_head', 'withemes_javascript_detection', 0 );

/* Enqueue Scripts
-------------------------------------------------------------------------------------- */
if ( !function_exists('withemes_scripts') ):
function withemes_scripts() {
    
    /* Load Google Fonts
     * Use Google Font Array
     */
    $fonts_url = withemes_fonts_url();
    if ( $fonts_url ) {
        wp_enqueue_style( 'withemes-fonts', $fonts_url );
    }
	
    // Load our main stylesheet.
	wp_enqueue_style( 'wi-style', get_stylesheet_uri() );
    
    // Concept CSS
    $concept = withemes_concept();
    if ( $concept && 'standard' != $concept ) {
        wp_enqueue_style( 'wi-concept', get_template_directory_uri() . '/css/concepts/' . $concept . '.css', array( 'wi-style' ) );
    }

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    
    if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'wi-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20151116' );
	}
    
    // Load the html5 shiv.
	wp_enqueue_script( 'wi-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.0' );
	wp_script_add_data( 'wi-html5', 'conditional', 'lt IE 9' );
    
    $dep = array( 'jquery' );
    if ( class_exists( 'WooCommerce' ) ) {
        $dep[] = 'wc-single-product';
    }
    
    if ( defined('WP_DEBUG') && true === WP_DEBUG ) {
        
        wp_enqueue_script( 'debounce', get_theme_file_uri( '/js/debounce.js' ), array( 'jquery' ), '1.0', true );
        wp_enqueue_script( 'imagesloaded', get_theme_file_uri( '/js/imagesloaded.pkgd.min.js' ), array( 'jquery' ) , '4.1.0', true );
        wp_enqueue_script( 'jarallax', get_theme_file_uri( '/js/jarallax.min.js' ), array( 'jquery' ) , '1.10.3', true );
        wp_enqueue_script( 'jarallax-video', get_theme_file_uri( '/js/jarallax-video.min.js' ), array( 'jarallax' ) , '1.0', true );
        wp_enqueue_script( 'easing', get_theme_file_uri( '/js/jquery.easing.1.3.js' ), array( 'jquery' ) , '1.3', true );
        wp_enqueue_script( 'fitvids', get_theme_file_uri( '/js/jquery.fitvids.js' ), array( 'jquery' ) , '1.0', true );
        wp_enqueue_script( 'wi-flexslider', get_theme_file_uri( '/js/jquery.flexslider-min.js' ), array( 'jquery' ) , '2.6.0', true );
        wp_enqueue_script( 'inview', get_theme_file_uri( '/js/jquery.inview.min.js' ), array( 'jquery' ) , '1.0', true );
        wp_enqueue_script( 'magnific-popup', get_theme_file_uri( '/js/jquery.magnific-popup.js' ), array( 'jquery' ) , '1.1', true );
        wp_enqueue_script( 'scrollTo', get_theme_file_uri( '/js/jquery.scrollTo.js' ), array( 'jquery' ) , '2.1.2', true );
        wp_enqueue_script( 'slicknav', get_theme_file_uri( '/js/jquery.slicknav.min.js' ), array( 'jquery' ) , '1.0', true );
        wp_enqueue_script( 'tipsy', get_theme_file_uri( '/js/jquery.tipsy.js' ), array( 'jquery' ) , '1.0', true );
        wp_enqueue_script( 'wi-masonry', get_theme_file_uri( '/js/masonry.pkgd.min.js' ), array( 'jquery' ) , '4.2.1', true );
        wp_enqueue_script( 'superfish', get_theme_file_uri( '/js/superfish.js' ), array( 'jquery' ) , '4.2.1', true );
        wp_enqueue_script( 'withemes_waypoint', get_theme_file_uri( '/js/withemes.waypoints.js' ), array( 'jquery' ) , '1.0', true );
        
        wp_enqueue_script( 'wi-script', get_theme_file_uri( '/js/main.js' ), $dep , SIMPLE_ELEGANT_VERSION, true );
        
    } else {
        wp_enqueue_script( 'wi-script', get_theme_file_uri( '/js/theme.min.js' ), $dep , SIMPLE_ELEGANT_VERSION, true );
    }
    
    $jsdata = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'preview_nonce' => wp_create_nonce( 'preview_nonce' ),
    );
    
    $jsdata = apply_filters( 'withemes_jsdata', $jsdata );
	wp_localize_script( 'wi-script', 'WITHEMES', $jsdata );
    
    // remove redundant flexslider
    wp_deregister_script( 'flexslider' );
    wp_deregister_style( 'flexslider' );
}
endif;
add_action( 'wp_enqueue_scripts', 'withemes_scripts' );

/**
 * Returns site concept. This function can not be overridden in your child theme
 *
 * @since 2.0
 */
function withemes_concept(){
    
    $concept = get_option( 'withemes_concept' );
    if ( ! in_array( $concept, array( 'diy', 'photography' ) ) ) $concept = 'standard';
    
    return $concept;
    
}

if ( !function_exists('withemes_sidebar_state') ):
/**
 * Generalize sidebar state
 * @return left, right or false
 *
 * @since 2.3
 */
function withemes_sidebar_state() {
    
    $sidebar_position = false;
    
    if ( is_home() || is_archive() || is_search() ) {
        
        $sidebar_position = get_option( 'withemes_blog_sidebar' );
        
    } elseif ( is_single() ) {
        
        $sidebar_position = get_option( 'withemes_single_sidebar' );
        
    } elseif ( is_page() ) {
        
        $sidebar_position = get_post_meta( get_the_ID() , '_withemes_sidebar_position', true );
        if ( ! $sidebar_position ) {
            $sidebar_position = get_option( 'withemes_sidebar_position' );
        }
        if ( 'left' !== $sidebar_position ) $sidebar_position = 'right';
    
    } else {
        
        // general case
        $sidebar_position = get_option( 'withemes_sidebar_position' );
        
    }
    
    $sidebar_position = apply_filters( 'withemes_sidebar_state', $sidebar_position );
    if ( 'left' === $sidebar_position || 'right' === $sidebar_position ) return $sidebar_position;
    else return false;
    
}
endif;

if ( !function_exists('withemes_maybe_sidebar') ):
/**
 * Display sidebar when the page has sidebar
 * @since 2.3
 */
function withemes_maybe_sidebar( $sidebar = '' ) {
    
    if ( false !== withemes_sidebar_state() ) get_sidebar( $sidebar );
    
}
endif;

/* Body Class
-------------------------------------------------------------------------------------- */
add_action('body_class','withemes_body_class');
if (!function_exists('withemes_body_class')){
function withemes_body_class($classes){
    
    /* Concept
     * @since 2.0
    --------------------------- */
    $classes[] = 'wi-' . withemes_concept();
    
    /* Boxed Layout
     * @since 2.0
    --------------------------- */
    $layout = get_option( 'withemes_layout' );
    if ( 'boxed' != $layout ) $layout = 'wide';
    $classes[] = 'layout-' . $layout;
    
    /* Transparent Header
     * @since 2.3
    --------------------------- */
    if ( withemes_is_header_transparent() ) {
        $classes[] = 'body-header-transparent';
    }
    
    /* Nav Border Problem
     * @since 2.3
    --------------------------- */
    $mainnav_border_length = get_option( 'withemes_mainnav_border_length', 'container' );
    if ( 'fullwidth' != $mainnav_border_length ) $mainnav_border_length = 'container';
    $classes[] = 'body-mainnav-border-' . $mainnav_border_length;
    
    /* Sidebar Position
     * @since 2.0
    --------------------------- */
    $state = withemes_sidebar_state();
    if ( 'left' === $state || 'right' === $state ) {
        $classes[] = 'has-sidebar sidebar-' . $state;
    } else {
        $classes[] = 'nosidebar';
    }
    
    return $classes;
}
}

/* Head Code
-------------------------------------------------------------------------------------- */
add_action( 'wp_head' , 'withemes_head_code' );
if ( !function_exists('withemes_head_code') ) :
function withemes_head_code(){
    echo get_option('withemes_head_code');
}
endif;

/* Basic allowed HTML
-------------------------------------------------------------------------------------- */
if ( !function_exists('withemes_allowed_html') ) :
function withemes_allowed_html(){
    return array(
        'a' => array(
            'href' => array(),
            'title' => array(),
            'class' => array(),
            'target' => array(),
            'rel' => array(),
        ),
        'br' => array(),
        'em' => array(
            'class' => array(),
        ),
        'strong' => array(
            'class' => array(),
        ),
        'i' => array(
            'class' => array(),
        ),
        'b' => array(),
        'img' => array(
            'class' => array(),
            'width' => array(),
            'height' => array(),
            'src' => array(),
        ),
        'sup' => [],
        'sub' => [],
    );   
}
endif;

/* Image Quality
-------------------------------------------------------------------------------------- */
add_filter('jpeg_quality', 'withemes_image_full_quality');
add_filter('wp_editor_set_quality', 'withemes_image_full_quality');
if (!function_exists('withemes_image_full_quality')) :
function withemes_image_full_quality($quality) {
    return 100;
}
endif;

add_filter( 'excerpt_length', 'withemes_excerpt_length', 999 );
if ( ! function_exists( 'withemes_excerpt_length' ) ) :
/**
 * Change Excerpt length 
 *
 * @since 2.0
 */ 
function withemes_excerpt_length( $length ) { 
    
    $excerpt_length = absint( get_option( 'withemes_excerpt_length' ) );
    if ( $excerpt_length > 0 ) return $excerpt_length;
    
    return 24;
}
endif;

/* Exclude Pages from Search
-------------------------------------------------------------------------------------- */
if (!function_exists('withemes_search_filter')) {
function withemes_search_filter($query) {
    if ( $query->is_main_query() && ! is_admin() ) {
        if ($query->is_search) {
            $query->set('post_type', 'post');
        }
    }
    return $query;
    }
}
// remove this, since 2.3
// add_filter('pre_get_posts','withemes_search_filter');

/* Replace default ajax loader image
-------------------------------------------------------------------------------------- */
add_filter( 'wpcf7_ajax_loader', 'withemes_wpcf7_ajax_loader' );
if ( ! function_exists( 'withemes_wpcf7_ajax_loader' ) ):
/**
 * Replace default ajax loader image
 *
 * @since 2.0
 */
function withemes_wpcf7_ajax_loader( $url ) {
    
    return get_template_directory_uri() . '/images/loading-dark.svg';

}
endif;

/* Scroll Up Button
 * @since 2.3
-------------------------------------------------------------------------------------- */
add_action( 'wp_footer', 'withemes_scrollup_btn' );
if ( ! function_exists( 'withemes_scrollup_btn' ) ) :
function withemes_scrollup_btn() {
    
    if ( 'false' === get_option( 'withemes_footer_scrollup', 'true' ) ) return;
    ?>

<a href="#top" class="wi-scrollup" id="scrollup">
    <span>
        <i class="fa fa-angle-up"></i>
    </span>
</a>

    <?php
    
}
endif;

/* JS Migration Fix
-------------------------------------------------------------------------------------- */
require get_template_directory() . '/inc/jquery-migrate/enable-jquery-migrate-helper.php';

/* Google Fonts
-------------------------------------------------------------------------------------- */
require get_template_directory() . '/inc/fonts.php';

/* Automatically Featured Image from Videos
-------------------------------------------------------------------------------------- */
require get_template_directory() . '/inc/automatic-featured-images-from-videos.php';

/* Theme Components
-------------------------------------------------------------------------------------- */
require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/nav.php';
require get_template_directory() . '/inc/header.php';
require get_template_directory() . '/inc/responsive.php';

/* Customizer
-------------------------------------------------------------------------------------- */
require get_template_directory() . '/inc/customizer-helpers.php';
require get_template_directory() . '/inc/customizer.php';

/* Theme Customization
-------------------------------------------------------------------------------------- */
require get_template_directory() . '/inc/css.php';

/* WooCommerce
 * @since 1.3
-------------------------------------------------------------------------------------- */
require get_template_directory() . '/woo/hooks.php';

/* Admin Area
 * @since 2.0
-------------------------------------------------------------------------------------- */
require get_template_directory() . '/inc/admin/admin.php';

/* Single-click Install
 * @since 2.0
-------------------------------------------------------------------------------------- */
if ( ! defined( 'PT_OCDI_PATH' ) ) {
    define( 'PT_OCDI_PATH', get_template_directory() . '/inc/demo-import/' );
    define( 'PT_OCDI_URL', get_template_directory_uri() . '/inc/demo-import/' );
}
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

require_once get_template_directory() . '/inc/demo-import/one-click-demo-import.php';

/* Theme Builtin Widgets
-------------------------------------------------------------------------------------- */
require get_template_directory() . '/widgets/image/register.php';
require get_template_directory() . '/widgets/post-list/register.php';
require get_template_directory() . '/widgets/facebook/register.php';
// require get_template_directory() . '/widgets/instagram/register.php';
require get_template_directory() . '/widgets/pinterest/register.php';
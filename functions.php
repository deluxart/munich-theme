<?php
/**
 * My Site functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package munich
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'munich_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function munich_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on My Site, use a find and replace
		 * to change 'my-site' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'my-site', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'my-site' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'munich_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'munich_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function munich_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'munich_content_width', 640 );
}
add_action( 'after_setup_theme', 'munich_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function munich_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'my-site' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'my-site' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);


	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer #1', 'my-site' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'my-site' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer #2', 'my-site' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'my-site' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer #3', 'my-site' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'my-site' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer #4', 'my-site' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here.', 'my-site' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);


}
add_action( 'widgets_init', 'munich_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function munich_scripts() {
	wp_enqueue_style( 'ma-fa', get_template_directory_uri() . '/src/css/all.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'ma-swiper', get_template_directory_uri() . '/src/css/swiper.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'ma-HelveticaNeueCyr', get_template_directory_uri() . '/src/css/HelveticaNeueCyr.css', array(), _S_VERSION );

	wp_enqueue_style( 'my-site-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_enqueue_script( 'munich-jquery', get_template_directory_uri() . '/src/js/jquery.min.js', array(), _S_VERSION, true );
	// wp_enqueue_script( 'munich-sticky', get_template_directory_uri() . '/src/js/sticky.min.js', array(), _S_VERSION, true );
	

	wp_enqueue_script( 'munich-swiper', get_template_directory_uri() . '/src/js/swiper.min.js', array(), _S_VERSION, true );
	// wp_enqueue_script( 'munich-main', get_template_directory_uri() . '/src/js/main.js', array(), _S_VERSION, true );


	wp_enqueue_script( 'my-site-plugins', get_template_directory_uri() . '/js/plugins.min.js', array(), _S_VERSION, true );
	// wp_enqueue_script( 'my-site-cookie', get_template_directory_uri() . '/js/jquery.cookie.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'my-site-main', get_template_directory_uri() . '/js/main.min.js', array(), _S_VERSION, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'munich_scripts' );


if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 560, 340 );
}
add_image_size( 'spec_thumb', 560, 340, true );
add_image_size( 'spec_thumb_slider', 370, 265, true );


// We connect CPT
require get_template_directory() . '/inc/our-products.php';
require get_template_directory() . '/inc/ma-reviews.php';
require get_template_directory() . '/inc/ma-services.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

  global $wp_version;
  if ( $wp_version !== '4.7.1' ) {
     return $data;
  }

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );


function my_custom_mime_types( $mimes ) {
 
// New allowed mime types.
$mimes['svg'] = 'image/svg+xml';
$mimes['svgz'] = 'image/svg+xml';
$mimes['doc'] = 'application/msword';
 
// Optional. Remove a mime type.
unset( $mimes['exe'] );
 
return $mimes;
}
add_filter( 'upload_mimes', 'my_custom_mime_types' );

// Remove all empty html tags for cf7 form's
// add_filter('wpcf7_form_elements', function($content) {
// 	$content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
// 	return $content;
// });

add_filter('wpcf7_autop_or_not', '__return_false');


function add_additional_class_on_li($classes, $item, $args) {
    if($args->add_li_class) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);


add_shortcode( 'recent_posts', 'recent_posts_shortcode' );
function recent_posts_shortcode( $atts ) {
    ob_start();
    $args = shortcode_atts( array (
        'type' => 'post',
        'posts' => 6,
		'public'   => true,
		'order'   => 'DESC',
		'orderby' => 'post_date',
    ), $atts );
    $options = array(
        'post_type' => $args['type'],
        // 'meta_key'          => 'otkryt_nabor_sortirovka',
        // 'orderby'           => 'meta_value',
        // 'order'             => 'ASC',
        'posts_per_page' => $args['posts']
    );

    $query = new WP_Query( $options );
    if ( $query->have_posts() ) { ?>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <?php
                    get_template_part( 'template-parts/recent-posts', get_post_format() );
                 ?>
            <?php endwhile;
            wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}

// [recent_posts posts="10"]



function is_blog () {
    return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Basic settings',
		'menu_title'	=> 'Theme settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Socials settings',
		'menu_title'	=> 'Socials',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Blog settings',
		'menu_title'	=> 'Blog',
		'parent_slug'	=> 'theme-general-settings',
	));
}
<?php
/**
 * Green Lake functions and definitions
 *
 * @package Green Lake
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

function theme11_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'greenlake' ) );
		if ( $categories_list && greenlake_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s ', 'greenlake' ) . '</span>', $categories_list );
		}

		

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'greenlake' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s ', 'greenlake' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment ', 'greenlake' ), __( '1 Comment', 'greenlake' ), __( '% Comments', 'greenlake' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'greenlake' ), '<span class="edit-link">', '</span>' );
}

if ( ! function_exists( 'greenlake_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function greenlake_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Green Lake, use a find and replace
	 * to change 'greenlake' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'greenlake', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'greenlake' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'greenlake_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // greenlake_setup
add_action( 'after_setup_theme', 'greenlake_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function greenlake_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'greenlake' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'greenlake_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function greenlake_scripts() {

//  ----------------------------
	$themeloc = esc_url( get_template_directory_uri() );
//	$srcjqry = "$themeloc/js/jquery-1.11.2.min.js";
//	$srcfoundationjs = "$themeloc/js/foundation.min.js";

//		wp_register_script( "jqry", $srcjqry );
//		wp_register_script( "foundationjs", $srcfoundationjs, array( 'jqry' ) );

//		wp_enqueue_script( "foundationjs" );
//  ----------------------------

	wp_enqueue_style( 'greenlake-style', get_stylesheet_uri() );

	wp_enqueue_script( 'greenlake-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'greenlake-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'greenlake_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


function theme_name_scripts() {

$themeloc = esc_url( get_template_directory_uri() );

// -----------------------------


	$gl_css = "$themeloc/layouts/greenlake.css";
	$gl2_css = "$themeloc/layouts/greenlake2.css";



	wp_register_style( "glcss", $gl_css );
	wp_register_style( "glcss2", $gl2_css );


//	wp_enqueue_style( "foundationcss" );

//	wp_enqueue_style( "glcss2" );
//	wp_enqueue_style( "glcss" );


	


								}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );

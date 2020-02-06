<?php
/**
 * Ourakea functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ourakea
 */

if ( ! function_exists( 'ourakea_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ourakea_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Ourakea, use a find and replace
		 * to change 'ourakea' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ourakea', get_template_directory() . '/languages' );

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

		// Custom Image Sizes.
		add_image_size( 'ourakea-thumb-750-300', 750, 300, true ); // crop.
		add_image_size( 'ourakea-featured-900-600', 900, 600, true ); // crop.
		add_image_size( 'ourakea-cover-image', 1200, 9999 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary'     => esc_html__( 'Primary', 'ourakea' ),
				'footer-menu' => esc_html__( 'Footer Menu', 'ourakea' ),
				'social'      => esc_html__( 'Social Menu', 'ourakea' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Add support for core custom background feature.
		 *
		 * @link https://codex.wordpress.org/Custom_Backgrounds
		 */
		$defaults = array(
			'default-color' => 'ffffff',
			'default-image' => '',
		);
		add_theme_support( 'custom-background', $defaults );

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
				'height'      => 80,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'ourakea_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ourakea_content_width() {
	// This variable is intended to be overruled from themes.
	$GLOBALS['content_width'] = apply_filters( 'ourakea_content_width', 640 );
}
add_action( 'after_setup_theme', 'ourakea_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ourakea_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ourakea' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ourakea' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		register_sidebar(
			array(
				/* translators: %d: footer widget number. */
				'name'          => sprintf( esc_html__( 'Footer Widgets %d', 'ourakea' ), $i ),
				'id'            => 'footer-' . $i,
				'description'   => esc_html__( 'Add widgets here.', 'ourakea' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}
}
add_action( 'widgets_init', 'ourakea_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ourakea_scripts() {

	// Bootstrap reboot styles.
	wp_enqueue_style( 'ourakea-bootstrap-reboot', get_template_directory_uri() . '/vendor/bootstrap-src/css/bootstrap-reboot.min.css', array( 'ourakea-style' ), '4.1.2' );

	// Bootstrap styles.
	wp_enqueue_style( 'ourakea-bootstrap', get_template_directory_uri() . '/vendor/bootstrap-src/css/bootstrap.min.css', array( 'ourakea-style' ), '4.1.2' );

	// Theme styles.
	wp_enqueue_style( 'ourakea-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	// Loading main stylesheet.
	wp_enqueue_style( 'main-css', get_theme_file_uri( '/assets/css/main.css' ), array( 'ourakea-style' ), wp_get_theme()->get( 'Version' ) );

	// Loading mediascreen stylesheet.
	wp_enqueue_style( 'mediascreen-css', get_theme_file_uri( '/assets/css/mediascreen.css' ), array( 'ourakea-style' ), wp_get_theme()->get( 'Version' ) );

	// Add font-awesome fonts, used in the main stylesheet.
	wp_enqueue_style( 'ourakea-font-awesome', get_theme_file_uri( '/assets/font-awesome-5.7.2/css/all.css' ), array( 'ourakea-style' ), '5.7.2' );

	// Bootstrap core JavaScript: jQuery first, then Popper.js, then Bootstrap JS.
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'ourakea-popper', get_template_directory_uri() . '/vendor/bootstrap-src/js/popper.min.js', array(), '1.14.3', true );
	wp_enqueue_script( 'ourakea-bootstrap', get_template_directory_uri() . '/vendor/bootstrap-src/js/bootstrap.min.js', array(), '4.1.2', true );

	// Theme added JavaScript: Added by Developers.
	wp_enqueue_script( 'ourakea-basic', get_template_directory_uri() . '/assets/js/basic.js', array(), wp_get_theme()->get( 'Version' ), true );

	// Loading slick-slide js.
	wp_enqueue_script( 'slick-js', get_theme_file_uri( '/assets/js/slick.js' ), array(), '1.0.0', true );

	// Font Montserrat (Google Font)
	wp_enqueue_style( 'ourakea-custom-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:500,800|PT+Serif:400,700|Poppins:400,500,600,700&display=swap', false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ourakea_scripts' );

/**
 * Load theme required files.
 */
require get_template_directory() . '/inc/init.php';

function ourakea_add_classes_on_link_attributes( $classes ) {
	$classes['class'] = 'nav-link';
	return $classes;
}
add_filter( 'nav_menu_link_attributes', 'ourakea_add_classes_on_link_attributes' );

/** Post Widget with images **/
require get_template_directory() . '/inc/post_widget.php';

if ( ! function_exists( 'ourakea_related_post_query' ) ) :

	/**
	 * Generate the query for related posts based on taxonomies.
	 *
	 * @param int   $post_id post id of single post.
	 * @param int   $related_count post per page.
	 * @param array $args arguments.
	 *
	 * @since 1.0.0
	 */
	function ourakea_related_post_query( $post_id, $related_count, $args = array() ) {
		$args = wp_parse_args(
			(array) $args,
			array(
				'orderby' => 'rand',
				'return'  => 'query', // Valid values are: 'query' (WP_Query object), 'array' (the arguments array).
			)
		);

		$related_args = array(
			'post_type'      => get_post_type( $post_id ),
			'posts_per_page' => $related_count,
			'post_status'    => 'publish',
			'post__not_in'   => array( $post_id ),
			'orderby'        => $args['orderby'],
			'tax_query'      => array(),
		);

		$post       = get_post( $post_id );
		$taxonomies = get_object_taxonomies( $post, 'names' );

		foreach ( $taxonomies as $taxonomy ) {
			$terms = get_the_terms( $post_id, $taxonomy );
			if ( empty( $terms ) ) {
				continue;
			}
			$term_list                   = wp_list_pluck( $terms, 'slug' );
			$related_args['tax_query'][] = array(
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $term_list,
			);
		}

		if ( count( $related_args['tax_query'] ) > 1 ) {
			$related_args['tax_query']['relation'] = 'OR';
		}

		if ( 'query' === $args['return'] ) {
			return new WP_Query( $related_args );
		} else {
			return $related_args;
		}
	}
endif;


function ourakea_archive_title() {
	$title = __( 'Archives' );

	if ( is_category() ) {
		/* translators: Category archive title. %s: Category name. */
		$title = sprintf( __( 'Category <span> %s </span>' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		/* translators: Tag archive title. %s: Tag name. */
		$title = sprintf( __( 'Tag <span> %s </span>' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		/* translators: Author archive title. %s: Author name. */
		$title = sprintf( __( 'Author <span> %s </span>' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		/* translators: Yearly archive title. %s: Year. */
		$title = sprintf( __( 'Year <span> %s </span>' ), get_the_date( _x( 'Y', 'yearly archives date format' ) ) );
	} elseif ( is_month() ) {
		/* translators: Monthly archive title. %s: Month name and year. */
		$title = sprintf( __( 'Month <span> %s </span>' ), get_the_date( _x( 'F Y', 'monthly archives date format' ) ) );
	} elseif ( is_day() ) {
		/* translators: Daily archive title. %s: Date. */
		$title = sprintf( __( 'Day <span> %s </span>' ), get_the_date( _x( 'F j, Y', 'daily archives date format' ) ) );

	}
	return $title;
}

add_filter( 'get_the_archive_title', 'ourakea_archive_title' );

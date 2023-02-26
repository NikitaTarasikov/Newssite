<?php
/**
 * newssite functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package newssite
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function newssite_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on newssite, use a find and replace
		* to change 'newssite' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'newssite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support('post-formats', 
		array(
			'video',
			'quote',
			'image',
			'gallery'
		));
		add_post_type_support('news', 'post-formats');
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
			'menu-1' => esc_html__( 'Primary', 'newssite' ),
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
			'newssite_custom_background_args',
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
add_action( 'after_setup_theme', 'newssite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function newssite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'newssite_content_width', 640 );
}
add_action( 'after_setup_theme', 'newssite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function newssite_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'newssite' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'newssite' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'newssite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function newssite_scripts() {
	wp_enqueue_style( 'newssite-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'newssite-style', 'rtl', 'replace' );

	wp_enqueue_style( 'newssite-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0' );

	wp_enqueue_script( 'newssite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jquery3.6.3', 'https://code.jquery.com/jquery-3.6.3.min.js', array(), '', true );
	wp_enqueue_script( 'newssite-news-animal-ajax', get_template_directory_uri() . '/assets/js/news-animals-ajax.js', array(), '1.0.0', true );
	wp_localize_script(
		'newssite-news-animal-ajax',
	 	'newssite_news_animal_ajaxscript',
	  	array(
			'ajaxurl' => admin_url('admin-ajax.php'),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'newssite_scripts' );

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

function ns_register_post_type(){
	$taxonomy_labels = array(
		'name'              => esc_html_x( 'Animals', 'taxonomy general name', 'newssite' ),
		'singular_name'     => esc_html_x( 'Animal', 'taxonomy singular name', 'newssite' ),
		'search_items'      => esc_html__( 'Search Animals', 'newssite' ),
		'all_items'         => esc_html__( 'All Animals', 'newssite' ),
		'view_item'         => esc_html__( 'View Animal', 'newssite' ),
		'parent_item'       => esc_html__( 'Parent Animal', 'newssite' ),
		'parent_item_colon' => esc_html__( 'Parent Animal:', 'newssite' ),
		'edit_item'         => esc_html__( 'Edit Animal', 'newssite' ),
		'update_item'       => esc_html__( 'Update Animal', 'newssite' ),
		'add_new_item'      => esc_html__( 'Add New Animal', 'newssite' ),
		'new_item_name'     => esc_html__( 'New Animal Name', 'newssite' ),
		'not_found'         => esc_html__( 'No Animals Found', 'newssite' ),
		'back_to_items'     => esc_html__( 'Back to Animals', 'newssite' ),
		'menu_name'         => esc_html__( 'Animal', 'newssite' ),
	);

	$taxonomy_args = array(
		'hierarchical' => true,
		'labels' => $taxonomy_labels,
		'show_ui' => true,
		'rewrite' => array('slug' => 'animals'),
		'query_var' => true,
		'show_in_rest' => true
	);

	register_taxonomy('animals', array('news'), $taxonomy_args);

	$labels = array(
		'name'                  => esc_html_x( 'News', 'Post type general name', 'newssite' ),
		'singular_name'         => esc_html_x( 'News', 'Post type singular name', 'newssite' ),
		'menu_name'             => esc_html_x( 'News', 'Admin Menu text', 'newssite' ),
		'name_admin_bar'        => esc_html_x( 'News', 'Add New on Toolbar', 'newssite' ),
		'add_new'               => esc_html__( 'Add New', 'newssite' ),
		'add_new_item'          => esc_html__( 'Add New News', 'newssite' ),
		'new_item'              => esc_html__( 'New News', 'newssite' ),
		'edit_item'             => esc_html__( 'Edit News', 'newssite' ),
		'view_item'             => esc_html__( 'View News', 'newssite' ),
		'all_items'             => esc_html__( 'All News', 'newssite' ),
		'search_items'          => esc_html__( 'Search News', 'newssite' ),
		'parent_item_colon'     => esc_html__( 'Parent News:', 'newssite' ),
		'not_found'             => esc_html__( 'No News found.', 'newssite' ),
		'not_found_in_trash'    => esc_html__( 'No News found in Trash.', 'newssite' )
	);

	$args = array(
		'label' => esc_html__('News', 'newssite'),
		'labels' => $labels,
		'supports' => array('title', 'editor', 'author', 'thumbnail', 'page-attributes'),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'has_archive'        => true,
		'menu_position'		 => 100,
		'hierarchical' 	 	 => true,
		'rewrite' 			 => array('slug' => 'news'),
		'show_in_rest'       => true,

	);

	register_post_type('news', $args);	
}
add_action('init', 'ns_register_post_type');

function ns_rewrite_rules(){
	ns_register_post_type();
	flush_rewrite_rules();
}
add_action('after_switch_theme','ns_rewrite_rules');

function true_filter_function(){
	
	$inputsArray = $_POST['filterArr'];
	$current_page_num = $_POST['paginationElement'];

	$nothing_selected = 'nothing_selected';
	
	foreach($inputsArray as $item){
		$nothing_selected = $item;
	}
	if($nothing_selected == 'nothing_selected' || empty($inputsArray) == 1){
		$news = new WP_Query(array('post_type' => 'news', 'posts_per_page' => 5, 'paged' => 1));	
	}else{
		$tax_query = array(
			array(
				'taxonomy' => 'animals',
				'field' => 'slug',
				'terms' => $inputsArray,
			));

		$news = new WP_Query(array('post_type' => 'news', 'posts_per_page' => 5, 'paged' => 1, 'tax_query' => $tax_query));
	}
	
	if($news->have_posts()): while($news->have_posts()) : $news->the_post();
	
	get_template_part( 'template-parts/content-animals', get_post_type() );

	endwhile;
	
	echo '<ul class="news-pagination">';
	if($news->max_num_pages == 1){

	}else{
		for($i = 1; $i <= $news->max_num_pages; $i++ ){
			if($i == 1){
				echo '<span>'. $i .'</span>';
			}else{ 
				echo '<li id="'. $i .'">'. $i .'</li>';
			}
		}
	}
	echo '</ul>';

	endif;
	$nothing_selected = '';
	wp_reset_postdata();
	die();
}
add_action('wp_ajax_true_filter_function', 'true_filter_function'); 
add_action('wp_ajax_nopriv_true_filter_function', 'true_filter_function');

function true_filter_function1(){
	$inputsArray = $_POST['filterArr'];
	$current_page_num = $_POST['paginationElement'];

	$nothing_selected = 'nothing_selected';
	
	foreach($inputsArray as $item){
		$nothing_selected = $item;
	}
	if($nothing_selected == 'nothing_selected' || empty($inputsArray) == 1){
		$news = new WP_Query(array('post_type' => 'news', 'posts_per_page' => 5, 'paged' => $current_page_num));	
	}else{
		$tax_query = array(
			array(
				'taxonomy' => 'animals',
				'field' => 'slug',
				'terms' => $inputsArray,
			));

		$news = new WP_Query(array('post_type' => 'news', 'posts_per_page' => 5, 'paged' => $current_page_num, 'tax_query' => $tax_query));
	}
	
	if($news->have_posts()): while($news->have_posts()) : $news->the_post();
	
	get_template_part( 'template-parts/content-animals', get_post_type() );

	endwhile;
	

	echo '<ul class="news-pagination">';
	if($news->max_num_pages == 1){

	}else{
		for($i = 1; $i <= $news->max_num_pages; $i++ ){
			if($current_page_num == $i){
				echo '<span>'. $i .'</span>';
			}else{ 
				echo '<li id="'. $i .'">'. $i .'</li>';
			}
		}
	}
	echo '</ul>';

	endif;
	$nothing_selected = '';
	wp_reset_postdata();
	die();
}
add_action('wp_ajax_true_filter_function1', 'true_filter_function1'); 
add_action('wp_ajax_nopriv_true_filter_function1', 'true_filter_function1');


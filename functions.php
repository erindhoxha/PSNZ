<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}




/*
* Creating a function to create our CPT
*/
 
function custom_post_type() {
 
	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Cameras', 'Post Type General Name', 'PSNZ' ),
			'singular_name'       => _x( 'Movie', 'Post Type Singular Name', 'PSNZ' ),
			'menu_name'           => __( 'Cameras', 'PSNZ' ),
			'parent_item_colon'   => __( 'Parent Movie', 'PSNZ' ),
			'all_items'           => __( 'All Cameras', 'PSNZ' ),
			'view_item'           => __( 'View Movie', 'PSNZ' ),
			'add_new_item'        => __( 'Add New Movie', 'PSNZ' ),
			'add_new'             => __( 'Add New', 'PSNZ' ),
			'edit_item'           => __( 'Edit Movie', 'PSNZ' ),
			'update_item'         => __( 'Update Movie', 'PSNZ' ),
			'search_items'        => __( 'Search Movie', 'PSNZ' ),
			'not_found'           => __( 'Not Found', 'PSNZ' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'PSNZ' ),
		);
		 
	// Set other options for Custom Post Type
		 
		$args = array(
			'label'               => __( 'movies', 'PSNZ' ),
			'description'         => __( 'Movie news and reviews', 'PSNZ' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'category' ),
			'menu_icon'           => 'dashicons-video-alt',
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/ 
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		 
		// Registering your Custom Post Type
		register_post_type( 'movies', $args );
	 
	}
	 
	/* Hook into the 'init' action so that the function
	* Containing our post type registration is not 
	* unnecessarily executed. 
	*/
	 
	add_action( 'init', 'custom_post_type', 0 );


	add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
 
	function add_my_post_types_to_query( $query ) {
		if ( is_home() && $query->is_main_query() )
			$query->set( 'post_type', array( 'post', 'movies' ) );
		return $query;
	}

	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style-editor.css' );
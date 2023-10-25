<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package CMC
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'CMC_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function cmc_scripts_styles() {

	wp_enqueue_style(
		'cmc-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		CMC_VERSION
	);

	wp_enqueue_script( 'cmc-header-buttons', get_stylesheet_directory_uri() . '/assets/js/header-buttons.js', array(), '', true );
}
add_action( 'wp_enqueue_scripts', 'cmc_scripts_styles', 20 );

/**
 * Query ID to render only current page children
 */
function cmc_children_pages( $query ) { 
	$current_pageID = get_queried_object_id();
	// Modify the query	
	$query->set( 'post_parent', $current_pageID ); 
}
add_action( 'elementor/query/filhos', 'cmc_children_pages', 10, 1 );


/**
 * Query ID to render only current page syblings
 */
function cmc_sybling_pages( $query ) { 
	$current_parent_pageID = get_queried_object()->post_parent;
	$current_pageID = get_queried_object_id();

	// Modify the query	
	$query->set( 'post__not_in', [ $current_pageID ] );
	$query->set( 'post_parent', $current_parent_pageID ); 
}
add_action( 'elementor/query/irmaos', 'cmc_sybling_pages', 10, 1 );

/**
 * Query ID to render only current page parent
 */
function cmc_parent_page( $query ) { 
	$current_parent_pageID = get_queried_object()->post_parent;

	// Modify the query	
	$query->set( 'p', $current_parent_pageID );
}
add_action( 'elementor/query/pai', 'cmc_parent_page', 10, 1 );
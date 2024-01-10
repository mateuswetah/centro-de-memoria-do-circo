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
	wp_enqueue_style( 'cmc-tainacan-styles', get_stylesheet_directory_uri() . '/assets/css/tainacan.css', array(), '' );
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

/**
 * Query ID to render only child pages
 */
function cmc_child_pages( $query ) { 
	$current_pageID = get_queried_object_id();

	// Modify the query	
	$query->set( 'post_parent', $current_pageID );
}
add_action( 'elementor/query/filhos', 'cmc_child_pages', 10, 1 );

/**
 * Retrieves the current items list source link
 */
function tainacan_get_source_item_list_url() {
	$args = $_GET;
	if (isset($args['ref'])) {
		$ref = $_GET['ref'];
		unset($args['pos']);
		unset($args['ref']);
		unset($args['source_list']);
		return $ref . '?' . http_build_query(array_merge($args));
	} else {
		unset($args['pos']);
		unset($args['ref']);
		unset($args['source_list']);
		return tainacan_the_collection_url() . '?' . http_build_query(array_merge($args));
	}
}


/**
 * Retrieves an item adjacent link, either using WP strategy or Tainacan plugin tainacan_get_adjacent_items()
 * 
 * @param string $thumbnail: accepts 'small' and 'large', defaults to null
 */
function tainacan_get_adjacent_item_links($thumbnail = null) {

	if (function_exists('tainacan_get_adjacent_items') && isset($_GET['pos'])) {
		$adjacent_items = tainacan_get_adjacent_items();

		if (isset($adjacent_items['next'])) {
			$next_link_url = $adjacent_items['next']['url'];
			$next_title = $adjacent_items['next']['title'];
		} else {
			$next_link_url = false;
		}
		if (isset($adjacent_items['previous'])) {
			$previous_link_url = $adjacent_items['previous']['url'];
			$previous_title = $adjacent_items['previous']['title'];
		} else {
			$previous_link_url = false;
		}

	} else {
		//Get the links to the Previous and Next Post
		$previous_link_url = get_permalink( get_previous_post() );
		$next_link_url = get_permalink( get_next_post() );

		//Get the title of the previous post and next post
		$previous_title = get_the_title( get_previous_post() );
		$next_title = get_the_title( get_next_post() );
	}

	$previous = '';
	$next = '';

	switch ($thumbnail) {

		case 'small':
			//Get the thumnail url of the previous and next post
			if (function_exists('tainacan_get_adjacent_items') && isset($_GET['pos'])) {
				if ($adjacent_items['next']) {
					$next_thumb = isset($adjacent_items['next']['thumbnail']['tainacan-small'][0]) ? $adjacent_items['next']['thumbnail']['tainacan-small'][0] : false;
				}
				if ($adjacent_items['previous']) {
					$previous_thumb = isset($adjacent_items['previous']['thumbnail']['tainacan-small'][0]) ? $adjacent_items['previous']['thumbnail']['tainacan-small'][0] : false;
				}
			} else {
				$previous_thumb = get_the_post_thumbnail_url( get_previous_post(), 'tainacan-small' );
				$next_thumb = get_the_post_thumbnail_url( get_next_post(), 'tainacan-small' );
			}

			// Creates the links
			$previous = $previous_link_url === false ? '' :
				'<a class="has-small-thumbnail" rel="prev" href="' . $previous_link_url . '">' . 
					'<i class="tainacan-icon tainacan-icon-arrowleft tainacan-icon-30px"></i>&nbsp;<span>' . 
					$previous_title . '</span>' . 
					($previous_thumb !== false ? '<img src="' . $previous_thumb . '" alt="" />' : '') .
				'</a>';
			$next = $next_link_url === false ? '' :
				'<a class="has-small-thumbnail" rel="next" href="' . $next_link_url . '">' . 
					($next_thumb !== false ? '<img src="' . $next_thumb . '" alt="" />' : '') .
					'<span>' . $next_title . 
					'</span>&nbsp;<i class="tainacan-icon tainacan-icon-arrowright tainacan-icon-30px"></i>' .
				'</a>';
		break;

		case 'large':

			if (function_exists('tainacan_get_adjacent_items') && isset($_GET['pos'])) {
				if ($adjacent_items['next']) {
					$next_thumb = $adjacent_items['next']['thumbnail']['tainacan-medium'][0];
				}
				if ($adjacent_items['previous']) {
					$previous_thumb = $adjacent_items['previous']['thumbnail']['tainacan-medium'][0];
				}
			} else {
				//Get the thumnail url of the previous and next post
				$previous_thumb = get_the_post_thumbnail_url( get_previous_post(), 'tainacan-medium' );
				$next_thumb = get_the_post_thumbnail_url( get_next_post(), 'tainacan-medium' );
			}
			
			// Creates the links
			$previous = $previous_link_url === false ? '' :
				'<a class="has-large-thumbnail" rel="prev" href="' . $previous_link_url . '">' .
					'<i class="tainacan-icon tainacan-icon-arrowleft tainacan-icon-36px"></i>&nbsp;' .
					'<div><img src="' . $previous_thumb . '" alt=""><span>' . $previous_title . 
				'</span></div></a>';
			$next = $next_link_url === false ? '' :
				'<a class="has-large-thumbnail" rel="next" href="' . $next_link_url . '">' . 
					'<div><img src="' . $next_thumb . '" alt=""><span>' . $next_title . 
					'</span></div>&nbsp;<i class="tainacan-icon tainacan-icon-arrowright tainacan-icon-36px"></i>' .
				'</a>';
		break;
		
		default:
			$previous = $previous_link_url === false ? '' : '<a rel="prev" href="' . $previous_link_url . '"><i class="tainacan-icon tainacan-icon-arrowleft tainacan-icon-30px"></i>&nbsp; <span>' . $previous_title . '</span></a>';
			$next = $next_link_url === false ? '' :'<a rel="next" href="' . $next_link_url . '"><span>' . $next_title . '</span> &nbsp;<i class="tainacan-icon tainacan-icon-arrowright tainacan-icon-30px"></i></a>';
	}

	return ['next' => $next, 'previous' => $previous];
}

add_filter('tainacan-item-get-document-as-html', function($document_as_html) {
	$document_as_html = str_replace('<a ', '<a data-e-disable-page-transition ', $document_as_html);
	return $document_as_html;
}, 10, 1);

add_filter('tainacan-item-get-attachment-as-html', function($attachment_as_html) {
	$attachment_as_html = str_replace('<a ', '<a data-e-disable-page-transition ', $attachment_as_html);
	return $attachment_as_html;
}, 10, 1);

/**
 * Add CPTs support to Theme Builder
 */
add_filter( 'elementor_pro/utils/get_public_post_types', function( $post_types ) {

	$tainacan_collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
	foreach ($tainacan_collections_post_types as $key => $value) {
		$post_type = get_post_type_object( $value );
		$post_types[$value] = $post_type->label;
	}
	return $post_types;
} );

// Post Type "Curadorias".
require get_stylesheet_directory() . '/inc/post-types.php';
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

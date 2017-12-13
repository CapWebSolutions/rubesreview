<?php

/*
 * Plugin Name: Rubes Review Evaluations
 * Plugin URI: https://capwebsolutions.com/
 * Description: Adds the Evaluaitons post type for the theme.
 * Author: Cap Web Solutions
 * Version: 1.0.0
 * Author URI: https://capwebsolutions.com/
 * 
 *
 */


// Get all the things
require_once( dirname( __FILE__ ) . '/post-types.php' );
require_once( dirname( __FILE__ ) . '/metaboxes.php' );
require_once( dirname( __FILE__ ) . '/metaboxes-organizations.php' );
require_once( dirname( __FILE__ ) . '/taxonomies.php' );
require_once( dirname( __FILE__ ) . '/helper-functions.php' );
// require_once( dirname( __FILE__ ) . '/get-evaluation.php' );

// Load questions as custom fields
// require_once( dirname( __FILE__ ) . '/helper-functions-fields-agency.php' );
// require_once( dirname( __FILE__ ) . '/helper-functions-fields-hospital.php' );
// require_once( dirname( __FILE__ ) . '/helper-functions-fields-continuing-ed.php' );
require_once( dirname( __FILE__ ) . '/helper-functions-fields-malpractice.php' );



// Load styles
function rubesreview_evaluations_enqueue() {
	wp_enqueue_style( 'rubesreview-evaluations', plugins_url( "assets/css/ratings.css", __FILE__ ), array(), '1.0.0.' );
}

// Load Translations
function rubesreview_evaluations_init() {
	load_plugin_textdomain( 'rubesreview-evaluations', false, 'rubesreview-evaluations/languages' );
}

include_once(dirname( __FILE__ ) . '/advanced-custom-fields/acf.php');


add_action( 'plugins_loaded', 'rubesreview_evaluations_init' );
add_action( 'wp_enqueue_scripts', 'rubesreview_evaluations_enqueue' );


adds_new_evaluations_image_sizes();

// Set up templates for new post type
add_filter( 'archive_template', 'load_archive_template' );
add_filter( 'archive_template', 'load_taxonomy_archive_template', 11 );
add_filter( 'single_template', 'load_single_template' );


add_action('genesis_before_footer', 'dump_out_rubes_footer' );
function dump_out_rubes_footer() { 
	//* dump out the BB footer. 
	FLBuilder::render_query( array(
		'post_type' => 'fl-builder-template',
		'p'         => 619 // Breaver Footer Template ID
	) );
}
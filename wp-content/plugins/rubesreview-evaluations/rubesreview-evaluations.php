<?php

/*
 * Plugin Name: Rubes Review Evaluation Engine
 * Plugin URI: https://capwebsolutions.com/
 * Description: Adds the custom post types for the various organizations, along with all eval views. 
 * Author: Cap Web Solutions
 * Version: 1.0.5
 * Author URI: https://capwebsolutions.com/
 * 
 *
 */


// Get all the things
require_once( dirname( __FILE__ ) . '/helper-functions.php' );

/**
 * Get the bootstrap for CMB2!
 */
require_once __DIR__ . '/cmb2/init.php';

/**
 * Load in specific metaboxes for organization types and evaluations
 */
require_once( dirname( __FILE__ ) . '/metaboxes/metaboxes-organizations.php' );
require_once( dirname( __FILE__ ) . '/metaboxes/metaboxes-agency.php' );
require_once( dirname( __FILE__ ) . '/metaboxes/metaboxes-hospital.php' );
require_once( dirname( __FILE__ ) . '/metaboxes/metaboxes-continuing-education.php' );
require_once( dirname( __FILE__ ) . '/metaboxes/metaboxes-malpractice-co.php' );

/**
 * Load in organization specific handlers
 */
require_once( dirname( __FILE__ ) . '/lib/display-agency.php' );
require_once( dirname( __FILE__ ) . '/lib/display-hospital.php' );
require_once( dirname( __FILE__ ) . '/lib/display-continuing-education.php' );
require_once( dirname( __FILE__ ) . '/lib/display-malpractice-co.php' );
require_once( dirname( __FILE__ ) . '/lib/get-organization-details.php' );

// Load styles & scripts
function rubesreview_evaluations_enqueue() {
	// wp_enqueue_style( 'rubesreview-evaluations', plugins_url( "assets/css/ratings.css", __FILE__ ), array(), '1.0.0.' );
	wp_enqueue_script( 'rubesreview-evaluations', plugins_url( "assets/js/gravity_readonly.js", __FILE__ ), array(), '1.0.0.' );
}

// Load Translations
function rubesreview_evaluations_init() {
	load_plugin_textdomain( 'rubesreview-evaluations', false, 'rubesreview-evaluations/languages' );
}

add_action( 'plugins_loaded', 'rubesreview_evaluations_init' );
add_action( 'wp_enqueue_scripts', 'rubesreview_evaluations_enqueue' );


adds_new_evaluations_image_sizes();

// Set up templates for new post type
add_filter( 'archive_template', 'load_archive_template' );
// add_filter( 'archive_template', 'load_taxonomy_archive_template', 11 );
add_filter( 'single_template', 'load_single_template' );


add_action('genesis_before_footer', 'dump_out_rubes_footer' );
function dump_out_rubes_footer() { 
	//* dump out the BB footer. 
	FLBuilder::render_query( array(
		'post_type' => 'fl-builder-template',
		'p'         => 619 // Breaver Footer Template ID
	) );
}
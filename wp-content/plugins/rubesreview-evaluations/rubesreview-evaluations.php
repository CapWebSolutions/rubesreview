<?php

/*
 * Plugin Name: Rube's Review Evaluation Engine
 * Plugin URI: https://capwebsolutions.com/
 * Description: Adds the custom post types for the various organizations, along with all eval views. 
 * Author: Cap Web Solutions
 * Version: 1.0.5
 * Author URI: https://capwebsolutions.com/
 * 
 *
 */


// The Evaluations engine runs on Gravity Forms. If Gravity forms is not activated, exit this plugin. 

add_action( 'admin_init', 'child_plugin_has_parent_plugin' );
function child_plugin_has_parent_plugin() {
    if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'gravityforms/gravityforms.php' ) ) {
        add_action( 'admin_notices', 'rubesreview_evaluations_plugin_notice' );

        deactivate_plugins( plugin_basename( __FILE__ ) ); 

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
    }
}

function rubesreview_evaluations_plugin_notice(){
    ?><div class="error"><p>Sorry, but Rube's Review Evaluation Engine requires Gravity Forms plugin to be installed and active. Please Activate Gravtiy Forms to continue.</p></div><?php
}

// Get all the things
require_once( dirname( __FILE__ ) . '/helper-functions.php' );

/**
 * Get the bootstrap for CMB2!
 */
require_once(__DIR__ . '/cmb2/init.php');

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
	wp_enqueue_style( 'rubesreview-evaluations', plugins_url( "assets/css/evaluations.css", __FILE__ ), array(), '1.0.0.' );
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

// Target submissions from various forms.
// All Eval forms are creating CPT of the evals so the entry is not needed after CPT is published. 
// Change gform_after_submission_1 to reflect your target form ID.
add_action( 'gform_after_submission_4', 'remove_form_entry' );
add_action( 'gform_after_submission_10', 'remove_form_entry' );  // Add Organization -> CPT
add_action( 'gform_after_submission_11', 'remove_form_entry' );  // Agency eval -> CPT
add_action( 'gform_after_submission_12', 'remove_form_entry' );  // Select Organization
add_action( 'gform_after_submission_20', 'remove_form_entry' );  // Hospital Evaluation -> CPT
add_action( 'gform_after_submission_21', 'remove_form_entry' );  // CE Eval -> CPT
add_action( 'gform_after_submission_22', 'remove_form_entry' );  // Malpractice Eval -> CPT
function remove_form_entry( $entry ) {
    GFAPI::delete_entry( $entry['id'] );
}
<?php
/**
 * Malpractice Company Evaluation Post Type: Single Post View 
 *
 * @package    rubesreview evaluations
 * @author     Cap Web Solutions
 * @copyright  2017 Matt Ryan 
 *
 */
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Remove the author box on single posts HTML5 Themes
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove entry title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

add_action('genesis_after_header', 'rubes_dump_out_bb_malp_header');
function rubes_dump_out_bb_malp_header() {
	//* Dump out Beaver Builder Header
	FLBuilder::render_query( array(
		'post_type' => 'fl-builder-template',
		'p'         => 956 // Beaver Header Template ID
	) );
}

add_action( 'genesis_entry_header', 'rubesreview_malp_evaluation_info', 10 );
function rubesreview_malp_evaluation_info() {

	global $post;

	$post_id = get_the_ID();
	display_single_rubes_malp_eval( $post_id );
}

genesis();

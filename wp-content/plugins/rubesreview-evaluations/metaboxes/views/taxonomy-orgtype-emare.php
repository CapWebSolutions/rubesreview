<?php
/**
 * Evaluation Post Type: Emare Orgtype
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

add_action( 'genesis_entry_header', 'rubesreview_evaluation_emare_orgtype_tax_info', 10 );
function rubesreview_evaluation_emare_orgtype_tax_info( $evaluation_meta ) {

	global $post;

	FLBuilder::render_query( array(
		'post_type' => 'fl-builder-template',
		'p'         => 956 // Breaver Header Template ID
	) );
	
	// $prefix = '_rubesreview_evaluation_';

	$post_id = get_the_ID( $post->ID ); 

	$evaluation_meta = array(
		'field01' => get_post_meta( $post_id, 'field01', true ),
		'field02' => get_post_meta( $post_id, 'field02', true ),
		'field03' => get_post_meta( $post_id, 'field03', true ),
	);	

	return ( $evaluation_meta );

}

genesis();
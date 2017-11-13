<?php
/**
 * evaluation Post Type: Single Post View
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

add_action( 'genesis_entry_header', 'rubesreview_evaluation_info', 10 );
function rubesreview_evaluation_info() {

	global $post;

	$prefix = '_rubesreview_evaluation_';

	$post_id = get_the_ID( $post->ID ); 
	$evaluation_organization = get_post_meta( $post_id, $prefix . 'organization', true );
	$evaluation_org_address = get_post_meta( $post_id,  $prefix . 'org_address', true );
	$evaluation_org_web = get_post_meta( $post_id,  $prefix . 'org_web', true );
	$evaluation_org_phone = get_post_meta( $post_id,  $prefix . 'org_phone', true );
	$evaluation_org_overall_satisfaction_rating = get_post_meta( $post_id,  $prefix . 'org_overall_satisfaction', true );
	$evaluation_org_professionalism_rating = get_post_meta( $post_id,  $prefix . 'org_professionalism_rating', true );
	$evaluation_org_overall_rating = get_post_meta( $post_id,  $prefix . 'org_overall_rating', true );
	// Set up rating stars with max at 5 stars. 
	// $evaluation_org_overall_rating_stars = '';
	// if ( 5 < $evaluation_org_overall_rating ) $evaluation_org_overall_rating = 5;
	// for( $i= 1 ; $i <= $evaluation_org_overall_rating ; $i++ ) { $evaluation_org_overall_rating_stars .= '&starf;'; } 
	
// d($post);
// d($evaluation_organization,$evaluation_org_web);
	$evaluation_featured_img = '';
	if( has_post_thumbnail( $post_id ) ) {
		$evaluation_featured_img = genesis_get_image( array( 'format' => 'html', 'size' => 'rubesreview-evaluation-image', 'attr' => array( 'class' => 'author-image' ) ) );
	}
	$evaluation_content = '<div class="evaluation-wrap">';
		
	if( !empty( $evaluation_featured_img ) ) { 
		$evaluation_content .= sprintf('<span class="alignright evaluation-image">%s</span>', $evaluation_featured_img ); 
	}	
	$evaluation_content .= sprintf('<div class="evaluation-organization">Business Name: %s</div>', $evaluation_organization ); 
	$evaluation_content .= sprintf('<div class="evaluation-org-address">Address: %s</div>', $evaluation_org_address ); 
	$evaluation_content .= sprintf('<div class="evaluation-org-web">%s</div>', $evaluation_org_web ); 
	$my_stars = get_post_meta( $post_id,  $prefix . 'org_overall_satisfaction', true );
	$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $my_stars . '">Overall Satisfaction with Agency </div>', $my_stars );
	$my_stars = get_post_meta( $post_id,  $prefix . 'org_hourly_rate', true );
	$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $my_stars . '">Overall Rating </div>', $my_stars ); 	
	$my_stars =  get_post_meta( $post_id,  $prefix . 'org_professionalism_rating', true );
	$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $my_stars . '">Professionalism of contact person </div>', $my_stars );
	$evaluation_content .= '</div>';  // close evaluation-wrap

	// printf( '<article class="evaluation-entry">%s</article>', $evaluation_content  );


}

genesis();
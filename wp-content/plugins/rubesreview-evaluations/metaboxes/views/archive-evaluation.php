<?php
/**
 * evaluation Post Type: Archive/Taxonomy View
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

//Removes Title and Description on CPT Archive
remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );

//* Remove entry title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );


FLBuilder::render_query( array(
	'post_type' => 'fl-builder-template',
	'p'         => 1457 // Breaver Header Template ID
) );

add_action( 'genesis_entry_header', 'rubesreview_evaluation_info', 10 );
function rubesreview_evaluation_info() {

	global $post;

	$post_id = get_the_ID( $post->ID ); 
	$prefix = 'rr_eval_agnt_';	

	$my_term = get_the_terms( $post_id, 'eval_org_type' );

	$evaluation_meta = array(
		'org_type' => $my_term[0]->name,
		'organization_name' => get_post_meta( $post_id, $prefix . 'organization', true ),
		// 'org_address' => get_post_meta( $post_id,  $prefix . 'org_address', true ),
		// 'org_web' => get_post_meta( $post_id,  $prefix . 'org_web', true ),
		// 'org_phone' => get_post_meta( $post_id,  $prefix . 'org_phone', true ),
		'raw_content' => get_the_content( ),
		'overall_satisfaction' => get_post_meta( $post_id,  $prefix . 'overall_satisfaction', true ),
		'hourly_rate' => get_post_meta( $post_id,  $prefix . 'hourly_rate', true ),
		'paid_timely' => get_post_meta( $post_id,  $prefix . 'paid_timely', true ),
		'hours_worked' => get_post_meta( $post_id,  $prefix . 'hours_worked', true ),
		'arranged_flight' => get_post_meta( $post_id,  $prefix . 'arranged_flight', true ),
		'arranged_car' => get_post_meta( $post_id,  $prefix . 'arranged_car', true ),
		'hotel_appt_accommodations' => get_post_meta( $post_id,  $prefix . 'hotel_appt_accommodations', true ),
		'per_diem' => get_post_meta( $post_id,  $prefix . 'per_diem', true ),
		'professionalism_rating' => get_post_meta( $post_id,  $prefix . 'professionalism_rating', true ),
		'average_rating' => get_post_meta( $post_id,  'average_rating', true ),
		'addl_comments' => get_post_meta( $post_id,  $prefix . 'additional_comments', true ),
	);

	$evaluation_featured_img = '';
	if( has_post_thumbnail( $post_id ) ) {
		$evaluation_featured_img = genesis_get_image( array( 'format' => 'html', 'size' => 'rubesreview-evaluation-image', 'attr' => array( 'class' => 'author-image' ) ) );
	}
	
	$evaluation_content = '<div class="evaluation-wrap">';

	//* Need to parse title to format xxxxxx cccc,ss
	$org_title = explode( '-', get_the_title( $post_id ), 4 );

	$evaluation_content .= sprintf('<div class="evaluation-name">Organization: %s  &mdash;  %s, %s</div>', $org_title[0], $org_title[1], $org_title[2] );

	foreach ($evaluation_meta as $key => $value) {
		switch ( $key ) {
			case 'featured_img' :
				if( !empty( $value ) ) { 
					$evaluation_content .= sprintf('<span class="alignright evaluation-image">%s</span>', $value ); 
				}
				break;
			case 'org_type':
				$evaluation_content .= sprintf('<div class="evaluation-organization">Organization Type: %s</div>', $value ); 	
				break;
			case 'organization_name':
				// $evaluation_content .= sprintf('<div class="evaluation-organization">Organization Name: %s</div>', $value ); 
				break;
			case 'org_address':
			case 'org_phone':
			case 'org_web':
				$evaluation_content .= sprintf('<div class="evaluation-org-address">%s</div>', $value ); 
				break; 
			case 'overall_satisfaction':
				// $running_stars = intval($value);
				// $stars_ctr += 1;
				//* Add in opening star div since we are at top of star ratings now
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-wrap">'); 
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Overall Satisfaction with Agency </div>', $value );
				break;
			case 'hourly_rate':
				// $running_stars += intval($value);
				// $stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Hourly Rate </div>', $value ); 	
				break;
			case 'paid_timely':
				// $running_stars += intval($value);
				// $stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Paid In A Timely Manner </div>', $value ); 
				break;
			case 'hours_worked' :
				// $running_stars += intval($value);
				// $stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Hours Worked </div>', $value ); 
				break;
			case 'arranged_flight' :
				// $running_stars += intval($value);
				// $stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Arranged Flight </div>', $value ); 
				break;
			case 'arranged_car' :			
				// $running_stars += intval($value);
				// $stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Arranged Car </div>', $value ); 
				break;
			case 'hotel_appt_accommodations' :
				// $running_stars += intval($value);
				// $stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Hotel / Apartment Accommodations </div>', $value ); 
				break;
			case 'per_diem' :
				// $running_stars += intval($value);
				// $stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Per Diem </div>', $value );
				break;
			case 'professionalism_rating' :
				// $running_stars += intval($value);
				// $stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Professionalism of Contact Person </div>', $value );
				break;
			case 'overall_rating' :
				// $running_stars += intval($value);
				// $stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Overall Rating </div>', $value ); 
				break;
		}
	}

	$evaluation_content .= sprintf('<div class="evaluation-descriptor">%s</div>', $evaluation_descriptor );
	if( !empty( $evaluation_featured_img ) ) { 
		$evaluation_content .= sprintf('<span class="alignright evaluation-image">%s</span>', $evaluation_featured_img ); 
	}	
	// $evaluation_content .= sprintf('<div class="evaluation-organization">Organization Type: %s</div>', get_the_title( $post_id  ) );
	$evaluation_content .= '</div>';  // close evaluation-wrap

	printf( '<article class="evaluation-entry">%s</article>', $evaluation_content  );


}
// genesis_posts_nav();  //* TODO: Find a place for this. 
genesis();
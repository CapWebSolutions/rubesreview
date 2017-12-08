<?php
/**
 * Evaluation Post Type: Single Post View
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
function rubesreview_evaluation_info( $evaluation_meta ) {

	global $post;

	FLBuilder::render_query( array(
		'post_type' => 'fl-builder-template',
		'p'         => 956 // Breaver Header Template ID
	) );
	
	$prefix = '_rubesreview_evaluation_';

	$post_id = get_the_ID( $post->ID ); 

	$stars_ctr = 0;

	$evaluation_meta = array(
		'org_type' => get_the_term_list( get_the_ID(), 'orgtype', '', ', ', '' ),
		'organization' => get_post_meta( $post_id, $prefix . 'organization', true ),
		'org_address' => get_post_meta( $post_id,  $prefix . 'org_address', true ),
		'org_web' => get_post_meta( $post_id,  $prefix . 'org_web', true ),
		'org_phone' => get_post_meta( $post_id,  $prefix . 'org_phone', true ),
		'raw_content' => get_the_content( ),
		'org_overall_satisfaction' => get_post_meta( $post_id,  'org_overall_satisfaction', true ),
		'org_hourly_rate' => get_post_meta( $post_id,  $prefix . 'org_hourly_rate', true ),
		'org_overall_satisfaction_rating' => get_post_meta( $post_id,  $prefix . 'org_overall_satisfaction', true ),
		'org_hourly_rate' => get_post_meta( $post_id,  $prefix . 'org_hourly_rate', true ),
		'org_paid_timely' => get_post_meta( $post_id,  $prefix . 'org_paid_timely', true ),
		'org_hours_worked' => get_post_meta( $post_id,  $prefix . 'org_hours_worked', true ),
		'org_arranged_flight' => get_post_meta( $post_id,  $prefix . 'org_arranged_flight', true ),
		'org_arranged_car' => get_post_meta( $post_id,  $prefix . 'org_arranged_car', true ),
		'org_hotel_appt_accommodations' => get_post_meta( $post_id,  $prefix . 'org_hotel_appt_accommodations', true ),
		'org_per_diem' => get_post_meta( $post_id,  $prefix . 'org_per_diem', true ),
		'org_professionalism_rating' => get_post_meta( $post_id,  $prefix . 'org_professionalism_rating', true ),
		'org_average_rating' => get_post_meta( $post_id,  'org_average_rating', true ),
		'org_addl_comments' => get_post_meta( $post_id,  $prefix . 'org_additional_comments', true ),
	);	
	$evaluation_featured_img = '';
	if( has_post_thumbnail( $post_id ) ) {
		$evaluation_meta['featured_img'] = genesis_get_image( array( 'format' => 'html', 'size' => 'rubesreview-evaluation-image', 'attr' => array( 'class' => 'evaluation-image' ) ) );
	}

	$running_stars = 0;
	$evaluation_content = '<div class="evaluation-wrap">';
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
			case 'organization':
				// $evaluation_content .= sprintf('<div class="evaluation-organization">Organization Name: %s</div>', $value ); 
				break;
			case 'org_address':
			case 'org_phone':
			case 'org_web':
				$evaluation_content .= sprintf('<div class="evaluation-org-address">%s</div>', $value ); 
				break; 
			case 'org_overall_satisfaction':
				$running_stars = intval($value);
				$stars_ctr += 1;
				//* Add in opening star div since we are at top of star ratings now
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-wrap">'); 
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Overall Satisfaction with Agency </div>', $value );
				break;
			case 'org_hourly_rate':
				$running_stars += intval($value);
				$stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Hourly Rate </div>', $value ); 	
				break;
			case 'org_paid_timely':
				$running_stars += intval($value);
				$stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Paid In A Timely Manner </div>', $value ); 
				break;
			case 'org_hours_worked' :
				$running_stars += intval($value);
				$stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Hours Worked </div>', $value ); 
				break;
			case 'org_arranged_flight' :
				$running_stars += intval($value);
				$stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Arranged Flight </div>', $value ); 
				break;
			case 'org_arranged_car' :			
				$running_stars += intval($value);
				$stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Arranged Car </div>', $value ); 
				break;
			case 'org_hotel_appt_accommodations' :
				$running_stars += intval($value);
				$stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Hotel / Apartment Accommodations </div>', $value ); 
				break;
			case 'org_per_diem' :
				$running_stars += intval($value);
				$stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Per Diem </div>', $value );
				break;
			case 'org_professionalism_rating' :
				$running_stars += intval($value);
				$stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Professionalism of Contact Person </div>', $value );
				break;
			case 'org_overall_rating' :
				$running_stars += intval($value);
				$stars_ctr += 1;
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Overall Rating </div>', $value ); 
				break;
		}
	}

	// Calc the average of the ratings using the running sum of the ratings divided by number of ratings.
	//    If the average is .5 or higher, make the star representation take the next higher value. 

	$avg_stars = $running_stars / $stars_ctr;
	$my_stars = (string)intval($avg_stars);
	if ( ( $running_stars % $stars_ctr ) >= 5 ) $my_stars +=1;

	$evaluation_meta['org_average_rating_stars'] = $my_stars;
	$evaluation_meta['org_average_rating_number'] = $avg_stars;

	$evaluation_content .= sprintf('<br><div class="evaluation-org-stars-' . $evaluation_meta['org_average_rating_stars'] . '">Average Rating => <strong>%s</strong></div><br>', strval( $evaluation_meta['org_average_rating_number'] ) ); 

	$evaluation_content .= sprintf('<br><div class="evaluation-org-stars-' . $evaluation_meta['org_average_rating'] . '">Average Rating(s) => <strong>%s</strong></div><br>', strval( $evaluation_meta['org_average_rating'] ) ); 

	$evaluation_content .= '</div>';  // close org-star-wrap
	$evaluation_content .= sprintf('<div class="evaluation-addl-comments">Comments: %s</div>', $evaluation_meta['org_addl_comments'] );
	$evaluation_content .= '</div></div>';  // close evaluation-wrap

	printf( '<article class="evaluation-entry">%s</article>', $evaluation_content  );
	return ( $evaluation_meta );

}

genesis();
<?php 
/**	
 * Display agency eval on front end
 */
function display_single_rubes_agency_eval( $post_id ) {
	/**	
	 * Display an Agency eval. Called for single or archive display. 
	 */
	$prefix = 'rr_eval_agnt_';
	$my_orgtype_term = get_the_terms( $post_id, 'org_type' );

/**
 * Pull off all eval meta data into working array
 */
	// $organization_details ='';
	// $this_organization = get_post_meta( $post_id, $prefix . 'organization_name', true );
	// $organization_details = get_organization_details( $this_organization );

	$evaluation_meta = array(
		'type' => $my_orgtype_term[0]->name,
		'organization' => get_post_meta( $post_id, $prefix . 'organization_name', true ),
		// 'org_address' => 'Location: ' . $organization_details['organization_city'] . ', ' . $organization_details['organization_state'],
		// 'org_phone' => 'Phone: ' . $organization_details['organization_phone'],
		// 'org_web' => $organization_details['organization_web'] . '<br><hr>',
		'overall_satisfaction' => get_post_meta( $post_id,  $prefix . 'overall_satisfaction', true ),
		'hourly_rate' => get_post_meta( $post_id,  $prefix . 'hourly_rate', true ),
		'paid_timely' => get_post_meta( $post_id,  $prefix . 'paid_timely', true ),
		'hours_worked' => get_post_meta( $post_id,  $prefix . 'hours_worked', true ),
		'arranged_flight' => get_post_meta( $post_id,  $prefix . 'arranged_flight', true ),
		'arranged_car' => get_post_meta( $post_id,  $prefix . 'arranged_car', true ),
		'hotel_appt_accommodations' => get_post_meta( $post_id,  $prefix . 'hotel_appt_accommodations', true ),
		'per_diem' => get_post_meta( $post_id,  $prefix . 'per_diem', true ),
		'professionalism_rating' => get_post_meta( $post_id,  $prefix . 'professionalism_rating', true ),
		'rating_average' => get_post_meta( $post_id,  $prefix . 'rating_average', true ),
		'addl_comments' => get_post_meta( $post_id,  $prefix . 'addl_comments', true ),
	);	

	$evaluation_featured_img = '';
	if( has_post_thumbnail( $post_id ) ) {
		$evaluation_meta['featured_img'] = genesis_get_image( array( 'format' => 'html', 'size' => 'rubesreview-evaluation-image', 'attr' => array( 'class' => 'evaluation-image' ) ) );
	}

	$evaluation_content = '<div class="evaluation-wrap">';

	//* Need to parse title to format xxxxxx cccc,ss
	$org_title = explode( '_', get_the_title( $post_id ), 4 );
	$evaluation_content .= sprintf('<div class="evaluation-name">Organization: %s  &mdash;  %s, %s</div>', $org_title[0], $org_title[1], $org_title[2] );

	// loop through each entry and if has data, output the Description of the rating line and the star display for the rating. 
	foreach ($evaluation_meta as $key => $value) {
		switch ( $key ) {
			case 'featured_img' :
				if( !empty( $value ) ) { 
					$evaluation_content .= sprintf('<span class="alignright evaluation-image">%s</span>', $value ); 
				}
				break;
			case 'type':
				$evaluation_content .= sprintf('<div class="evaluation-organization">Organization Type: %s</div>', $value ); 	
				break;
			case 'organization':
				$evaluation_content .= sprintf('<div class="evaluation-organization">Organization Name: %s</div>', $value ); 
				break;
			case 'org_address':
			case 'org_phone':
			case 'org_web':
				$evaluation_content .= sprintf('<div class="evaluation-org-address">%s</div>', $value ); 
				break; 
			case 'overall_satisfaction':
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-wrap">'); 
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Overall Satisfaction with Agency </div>', $value );
				break;
			case 'hourly_rate':
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Hourly Rate </div>', $value ); 	
				break;
			case 'paid_timely':
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Paid In A Timely Manner </div>', $value ); 
				break;
			case 'hours_worked' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Hours Worked </div>', $value ); 
				break;
			case 'arranged_flight' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Arranged Flight </div>', $value ); 
				break;
			case 'arranged_car' :			
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Arranged Car </div>', $value ); 
				break;
			case 'hotel_appt_accommodations' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Hotel / Apartment Accommodations </div>', $value ); 
				break;
			case 'per_diem' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Per Diem </div>', $value );
				break;
			case 'professionalism_rating' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Professionalism of Contact Person </div>', $value );
				break;
		}
	}

	// End the entry display with summary rating. This is the rating_average field from each type of rating. 
	$evaluation_content .= sprintf('<br><div class="evaluation-org-stars-' .  (string)intval($evaluation_meta['rating_average']) . '">Average Stars => <strong>%s</strong></div><br>', strval( $evaluation_meta['rating_average'] ) ); 

	$evaluation_content .= '</div>';  // close org-star-wrap

	// Any comments on this one? If so, dump them out now. 
	if ( 0 == strlen( $evaluation_meta['addl_comments'] ) ) $evaluation_meta['addl_comments'] = "None.";
	$evaluation_content .= sprintf('<div class="evaluation-addl-comments">Comments: %s</div>', $evaluation_meta['addl_comments'] );

	// Tie it all up by listing the author of the eval (by RR user name) and the date the eval was written
	$evaluation_content .= sprintf('<div class="evaluation-author">Evaluation by: %s<br>Dated: %s</div>', get_the_author_meta('display_name'), get_the_date() );
	$evaluation_content .= '</div></div>';  // close evaluation-wrap

	// Display it to the world. 
	printf( '<article class="evaluation-entry">%s</article>', $evaluation_content  );
	return;
}

<?php 
/**	
 * Display Continuing Education eval on front end
 */
function display_single_rubes_continuinged_eval( $post_id ) {
	/**	
	 * Display an Continuing Education eval. Called for single or archive display. 
	 */
	$prefix = 'rr_eval_cont_'; 
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
		// 'org_address' => 'Location: ' . $organization_details['organization_city'] . '&nbsp' . $organization_details['organization_state'],
		// 'org_phone' => 'Phone: ' . $organization_details['organization_phone'],
		// 'org_web' => 'Website: ' . $organization_details['organization_web'] . '<hr>',
		'days_scheduled' => get_post_meta( $post_id,  $prefix . 'days_scheduled', true ),
		'days_attended' => get_post_meta( $post_id,  $prefix . 'days_attended', true ),
		'overall_satisfaction' => get_post_meta( $post_id,  $prefix . 'overall_satisfaction', true ),
		'reg_staff_polite' => get_post_meta( $post_id,  $prefix . 'reg_staff_polite', true ),
		'reg_staff_prof_know' => get_post_meta( $post_id,  $prefix . 'reg_staff_prof_know', true ),
		'reg_process' => get_post_meta( $post_id,  $prefix . 'reg_process', true ),
		'refreshments' => get_post_meta( $post_id,  $prefix . 'refreshments', true ),
		'class_time' => get_post_meta( $post_id,  $prefix . 'class_time', true ),
		'break_time' => get_post_meta( $post_id,  $prefix . 'break_time', true ),
		'speaker_knowledge' => get_post_meta( $post_id,  $prefix . 'speaker_knowledge', true ),
		'exhibitor_rating' => get_post_meta( $post_id,  $prefix . 'exhibitor_rating', true ),
		'social_events' => get_post_meta( $post_id,  $prefix . 'social_events', true ),
		'location_rating' => get_post_meta( $post_id,  $prefix . 'location_rating', true ),
		'ce_points' => get_post_meta( $post_id,  $prefix . 'ce_points', true ),
		'worth_it' => get_post_meta( $post_id,  $prefix . 'worth_it', true ),
		'do_again' => get_post_meta( $post_id,  $prefix . 'do_again', true ),
		'recommend' => get_post_meta( $post_id,  $prefix . 'recommend', true ),
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

	// Start off the div that will hold everything. 
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
				$evaluation_content .= sprintf('<hr>'); 
				break;
			case 'org_address':
			case 'org_phone':
			case 'org_web':
				$evaluation_content .= sprintf('<div class="evaluation-org-address">%s</div>', $value ); 
				break; 
			case 'days_scheduled':
				$evaluation_content .= sprintf('<br><div>Days Scheduled: <span class="evaluation-org-days">%s</span></div>', $value ); 
				break;
			case 'days_attended' :
				$evaluation_content .= sprintf('<div>Days Attended: <span class="evaluation-org-days">%s</span></div><br>', $value ); 
				break;
			case 'overall_satisfaction':
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-wrap">'); 
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Overall Satisfaction with Agency </div>', $value );
				break;
			case 'reg_staff_polite' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Reg Staff Polite </div>', $value );
				break;
			case 'reg_staff_prof_know' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Reg Staff Professional/Knowledgeable </div>', $value );
				break;
			case 'reg_process' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Registration Process </div>', $value );
				break;
			case 'refreshments' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Refreshments </div>', $value );
				break;
			case 'class_time' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Class Time </div>', $value );
				break;
			case 'break_time' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Break Time </div>', $value );
				break;
			case 'speaker_knowledge' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Speakers Knowledgeable </div>', $value );
				break;
			case 'exhibitor_rating' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Overall Exhibitor Rating </div>', $value );
				break;
			case 'social_events' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Evening Social Events </div>', $value );
				break;
			case 'location_rating' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Rate Location </div>', $value );
				break;
			case 'ce_points' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Adequate CE Points </div>', $value );
				break;
			case 'worth_it' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Was It Worth It </div>', $value );
				break;
			case 'do_again' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Do It Again </div>', $value );
				break;
			case 'recommend' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Recommend CE to Colleague </div>', $value );
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

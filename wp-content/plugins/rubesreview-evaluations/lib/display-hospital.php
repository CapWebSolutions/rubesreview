<?php 
/**	
 * Display hospital eval on front end
 */

function display_single_rubes_hospital_eval( $post_id ) {
	
	/**	
	 * Display an eval. Called for single or archive display. 
	 */
	$prefix = 'rr_eval_hosp_';
	$my_orgtype_term = get_the_terms( $post_id, 'org_type' );

	$evaluation_meta = array(
		'type' => $my_orgtype_term[0]->name,
		'organization' => get_post_meta( $post_id, $prefix . 'organization_name', true ),
		// 'org_address' => 'Location: ' . $organization_details['organization_city'] . '&nbsp' . $organization_details['organization_state'],
		// 'org_phone' => 'Phone: ' . $organization_details['organization_phone'],
		// 'org_web' => $organization_details['organization_web'] . '<br><hr>',
		'overall_satisfaction'				=> get_post_meta( $post_id,  $prefix . 'overall_satisfaction', true ),
		'recruiting_contact'				=> get_post_meta( $post_id,  $prefix . 'recruiting_contact', true ),
		'recruiting_contact_polite' 		=> get_post_meta( $post_id,  $prefix . 'recruiting_contact_polite', true ),
		'recruiting_contact_professional'	=> get_post_meta( $post_id,  $prefix . 'recruiting_contact_professional', true ),
		'recruiting_contact_knowledgeable'	=> get_post_meta( $post_id,  $prefix . 'recruiting_contact_knowledgeable', true ),
		'recruiting_contact_hospital_rep'	=> get_post_meta( $post_id,  $prefix . 'recruiting_contact_hospital_rep', true ),
		'hospital_orientation'				=> get_post_meta( $post_id,  $prefix . 'hospital_orientation', true ),
		'hospital_orientation_speakers' => get_post_meta( $post_id,  $prefix . 'hospital_orientation_speakers', true ),
		'work_hours_schedule' => get_post_meta( $post_id,  $prefix . 'work_hours_schedule', true ),
		'happy_shift_schedule' => get_post_meta( $post_id,  $prefix . 'happy_shift_schedule', true ),
		'happy_pay_offered' => get_post_meta( $post_id,  $prefix . 'happy_pay_offered', true ),
		'happy_change_schedule' => get_post_meta( $post_id,  $prefix . 'happy_change_schedule', true ),
		'happy_overtime_work' => get_post_meta( $post_id,  $prefix . 'happy_overtime_work', true ),
		'expect_work_ot' => get_post_meta( $post_id,  $prefix . 'expect_work_ot', true ),
		'adequate_nurse_patient_ratio' => get_post_meta( $post_id,  $prefix . 'adequate_nurse_patient_ratio', true ),
		'training_adequate' => get_post_meta( $post_id,  $prefix . 'training_adequate', true ),
		'communicate_w_superiors' => get_post_meta( $post_id,  $prefix . 'communicate_w_superiors', true ),
		'go_up_chain' => get_post_meta( $post_id,  $prefix . 'go_up_chain', true ),
		'work_appreciated' => get_post_meta( $post_id,  $prefix . 'work_appreciated', true ),
		'feel_fulfilled' => get_post_meta( $post_id,  $prefix . 'feel_fulfilled', true ),
		'feel_at_home' => get_post_meta( $post_id,  $prefix . 'feel_at_home', true ),
		'recommend_2_colleague' => get_post_meta( $post_id,  $prefix . 'recommend_2_colleague', true ),
		'recommend_2_patient' => get_post_meta( $post_id,  $prefix . 'recommend_2_patient', true ),
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
			case 'overall_satisfaction':
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-wrap">'); 
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Overall Satisfaction with Hospital </div>', $value );
				break;
			case 'recruiting_contact':
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Rate the Recruiting Contact Person </div>', $value ); 	
				break;
			case 'recruiting_contact_polite':
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Being Polite </div>', $value ); 
				break;
			case 'recruiting_contact_professional' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Being Professional </div>', $value ); 
				break;
			case 'recruiting_contact_knowledgeable' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Being Knowledgeable </div>', $value ); 
				break;
			case 'recruiting_contact_hospital_rep' :			
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Representation of the Hospital </div>', $value ); 
				break;
			case 'hospital_orientation' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Adequate Orientation </div>', $value );
				break;
			case 'hospital_orientation_speakers' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Speakers Professional and Knowledgeble </div>', $value );
				break;
			case 'work_hours_schedule' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Happy With Work Hours Scheduled </div>', $value );
				break;
			case 'happy_shift_schedule' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Happy With Shifts Scheduled </div>', $value );
				break;
			case 'happy_pay_offered' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Happy With Pay Offered </div>', $value );
				break;
			case 'happy_change_schedule' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Happy About Changing Schedule </div>', $value );
				break;
			case 'happy_overtime_work' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Happy With Chance of OT </div>', $value );
				break;
			case 'expect_work_ot' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Expectation To Work OT </div>', $value );
				break;
			case 'adequate_nurse_patient_ratio' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Adequate Nurse Patient Ratio </div>', $value );
				break;
			case 'training_adequate' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Training Adequate </div>', $value );
				break;
			case 'communicate_w_superiors' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Able To Communicate With Superiors </div>', $value );
				break;
			case 'go_up_chain' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Able To Go Up the Chain of Command </div>', $value );
				break;
			case 'work_appreciated' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Work Appreciated </div>', $value );
				break;
			case 'feel_fulfilled' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Feel Fulfilled in Job </div>', $value );
				break;
			case 'feel_at_home' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Feel At Home Presently </div>', $value );
				break;
			case 'recommend_2_colleague' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Recommend To Colleague </div>', $value );
				break;
			case 'recommend_2_patient' :
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">Recommend To Potential Patient </div>', $value );
				break;
			}
	}

	// End the entry display with summary rating. This is the rating_average field from each type of rating. 
	$evaluation_content .= sprintf('<br><div class="evaluation-org-stars-' . (string)intval($evaluation_meta['rating_average']) . '">Average Stars => <strong>%s</strong></div><br>', strval( $evaluation_meta['rating_average'] ) ); 

	$evaluation_content .= '</div>';  // close org-star-wrap

	// Any comments on this one? If so, dump them out now. 
	if ( strlen( $evaluation_meta['addl_comments']) == 0 ) $evaluation_meta['addl_comments'] = "None.";
	$evaluation_content .= sprintf('<div class="evaluation-addl-comments">Comments: %s</div>', $evaluation_meta['addl_comments'] );

	// Tie it all up by listing the author of the eval (by RR user name) and the date the eval was written	
	$evaluation_content .= sprintf('<div class="evaluation-author">Evaluation by: %s<br>Dated: %s</div>', get_the_author_meta('display_name'), get_the_date() );
	$evaluation_content .= '</div>';  // close evaluation-wrap

	// Display it to the world. 
	printf( '<article class="evaluation-entry">%s</article>', $evaluation_content  );
	return;
}
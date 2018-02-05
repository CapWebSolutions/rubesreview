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
	// var_dump($this_organization);
	// var_dump($organization_details);

$evaluation_meta = array();
$organization_details = array();

// $this_organization = get_post_meta( $post_id, $prefix . 'organization_name', true );
// $organization_details = get_organization_details( $this_organization );

// // Add org info to working array
// $evaluation_meta[$prefix . 'org_address'] = 'Location: ' . $organization_details['organization_city'] . ', ' . $organization_details['organization_state'];
// $evaluation_meta[$prefix . 'org_phone'] = 'Phone: ' . $organization_details['organization_phone'];
// $evaluation_meta[$prefix . 'org_web'] = $organization_details['organization_web'] . '<br><hr>';

/**
 * Pull off all organization eval meta data into working array
 */
foreach (get_post_meta($post_id) as $key => $value) {
	// If the prefix is not in the key returned, then this is not an eval field, skip it
	if ( 0 === strpos( $key, $prefix ) ) {
		$evaluation_meta[$key] = $value;
	}
}

	$evaluation_featured_img = '';
	if( has_post_thumbnail( $post_id ) ) {
		$evaluation_meta['featured_img'] = genesis_get_image( array( 'format' => 'html', 'size' => 'rubesreview-evaluation-image', 'attr' => array( 'class' => 'evaluation-image' ) ) );
	}

	$evaluation_content = '<div class="evaluation-wrap">';

	//* Need to parse title to format xxxxxx cccc,ss
	$org_title = explode( '_', get_the_title( $post_id ), 4 );
	$org_city = ucwords($org_title[1]);
	$org_state = $org_title[2];
	$evaluation_content .= sprintf('<div class="evaluation-name">Organization: %s  &mdash;  %s, %s</div>', ucwords($org_title[0]), $org_city, $org_state );
	// $org_phone = '(xxx)xxx-xxxx';
	// $org_web = 'http:// ';

	// loop through each entry and if has data, output the Description of the rating line and the star display for the rating. 
	foreach ($evaluation_meta as $key => $value) {
		switch ( $key ) {
			case 'featured_img' :
				if( !empty( $value ) ) { 
					$evaluation_content .= sprintf('<span class="alignright evaluation-image">%s</span>', $value ); 
				}
				break;
			case $prefix . 'type':
				$evaluation_content .= sprintf('<div class="evaluation-organization">Organization Type: %s</div>', $value[0] ); 	
				break;
			case $prefix . 'organization_name':
				$evaluation_content .= sprintf('<div class="evaluation-organization">Organization Name: %s</div>', ucwords($value[0]) ); 
				break;
			case  $prefix . 'org_address':
				$evaluation_content .= sprintf('<div class="evaluation-org-address">Location: %s, %s</div>', $org_city, $org_state ); 
			case  $prefix . 'org_phone':
				break;
			case  $prefix . 'org_web': 
				break; 
			case $prefix . 'placement_recruiter':
				$evaluation_content .= sprintf('<hr><div class="evaluation-org-stars-wrap">'); 
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Overall Satisfaction with Recruiter </div>', $value[0] );
				break;
			case $prefix . 'recruiter_polite':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Recruiter Was Polite </div>', $value[0] );
			break;
			case $prefix . 'recruiter_effect_prof':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Recruiter Effective and Professional </div>', $value[0] );
			break;
			case $prefix . 'recruiter_accurate':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Recruiter Accurate in Assignemnt Description </div>', $value[0] );
			break;
			case $prefix . 'recruiter_made_effort':
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Recruiter Made Effort to Place as Requested </div>', $value[0] );
				break;
			case $prefix . 'recruiter_knowledgeable':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Recruiter Knowledgeable About Hospital </div>', $value[0] );
			break;
			case $prefix . 'recruiter_helpful_creds':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Recruiter Helpful with Credentialing Process </div>', $value[0] );
			break;
			case $prefix . 'recruiter_helpful_travel':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Recruiter Assisted with Travel Arrangements </div>', $value[0] );
			break;
			case $prefix . 'work_itinerary':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Work Itineray </div>', $value[0] );
			break;
			case $prefix . 'orientation_by_hosp':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Orientation by Hospital </div>', $value[0] );
			break;
			case $prefix . 'adequate_work_hours':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Adequate Work Hours </div>', $value[0] );
			break;
			case $prefix . 'adequate_work_shifts':
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Adequate Work Shifts </div>', $value[0] );
				break;
			case $prefix . 'paid_timely':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Hourly Rate Contracted For, Paid Timely </div>', $value[0] );
			break;
			case $prefix . 'overtime_hours_offered':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Ovretime Hours Offered </div>', $value[0] );
			break;
			case $prefix . 'overtime_pay_offered':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Overtime Pay Offered </div>', $value[0] );
			break;

			case $prefix . 'per_diem_offered':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Per Diem Offered </div>', $value[0] );
			break;

			case $prefix . 'pleased_payment_method':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Pleased with Payment Method </div>', $value[0] );
			break;

			case $prefix . 'direct_deposit_by_mail':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Direct Depost by Mail </div>', $value[0] );
			break;

			case $prefix . 'assistance_paying_state_lic':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Assistance in Paying State Licenses </div>', $value[0] );
			break;

			case $prefix . 'malpractice_coverage_provided':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Malpractice Insurance Provided </div>', $value[0] );
			break;

			case $prefix . 'health_insurance_provided':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Health Insurance Provided </div>', $value[0] );
			break;

			case $prefix . 'holiday_gifts':
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Agency Provide Holiday Gifts </div>', $value[0] );
				break;
			case $prefix . 'recommend_2_someone':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-%s">Recommend to Someone </div>', $value[0] );
			break;
		}
	}

	// End the entry display with summary rating. This is the rating_average field from each type of rating. 
	$avg_stars = $evaluation_meta[ $prefix . 'rating_average' ][0];

	// End the entry display with summary rating. This is the rating_average field from each type of rating. 
	$evaluation_content .= sprintf('<br><div class="evaluation-org-stars-%s">Average Stars => <strong>%s</strong></div><br>', intval($avg_stars), intval($avg_stars) ); 

	$evaluation_content .= '</div>';  // close org-star-wrap

	// Any comments on this one? If so, dump them out now. 
	if ( 0 == strlen( $evaluation_meta[ $prefix . 'addl_comments'][0] ) ) $evaluation_meta[ $prefix . 'addl_comments'][0] = "None.";
	$evaluation_content .= sprintf('<div class="evaluation-addl-comments">Comments: %s</div>', esc_html($evaluation_meta[ $prefix . 'addl_comments'][0]) );

	// Tie it all up by listing the author of the eval (by RR user name) and the date the eval was written
	$evaluation_content .= sprintf('<div class="evaluation-author">Evaluation by: %s<br>Dated: %s</div>', get_the_author_meta('display_name'), get_the_date() );
	$evaluation_content .= '</div></div>';  // close evaluation-wrap

	// Display it to the world. 
	printf( '<article class="evaluation-entry">%s</article>', $evaluation_content  );
	return;
}

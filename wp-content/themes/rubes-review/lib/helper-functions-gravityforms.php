<?php
/**
 * A variety of helper functions needed to integrate theme with Gravity Forms. 
 */  


/**
 * Get value of new-org-type query parm passed to form
 */  
add_filter('gform_field_value_new-org-type', 'populate_orgtype');
function populate_orgtype( $value ){
	return $value;
}

/**
 * We want to populate certain fields on the Select Organization form with the 
 * published CPT entries of the specific organization CPT. 
 * This permits the evaluater to pick from the existing organizations to enter a new evaluation. 
 */
/* ref: https://docs.gravityforms.com/dynamically-populating-drop-down-fields/ */
add_filter( 'gform_pre_render_12', 'rubes_populate_posts' );
add_filter( 'gform_pre_validation_12', 'rubes_populate_posts' );
add_filter( 'gform_pre_submission_filter_12', 'rubes_populate_posts' );
add_filter( 'gform_admin_pre_render_12', 'rubes_populate_posts' );

function rubes_populate_posts( $form ) {

$form_args = array( 
	'agnt_eval' => array(
		'thistype' => 'agency',
		'thiscss' => 'populate-agency',
		'thisplace' => 'Select the Agency to Evaluate' ),
	'hosp_eval' => array(
		'thistype' => 'hospital',
		'thiscss' => 'populate-hospital',
		'thisplace' => 'Select the Hospital to Evaluate' ),
	'malp_eval' => array(
		'thistype' => 'malpractice-company',
		'thiscss' => 'populate-malpractice',
		'thisplace' => 'Select the Malpractice Company to Evaluate' ),
	'cont_eval' => array(
		'thistype' => 'continuing-education',
		'thiscss' => 'populate-continuinged',
		'thisplace' => 'Select the Continuing Ed to Evaluate' ),
		);

    foreach ( $form['fields'] as &$field ) {
		// $eval_kind is the key and $eval_form_values is the value (an array)
		foreach ( $form_args as $eval_kind => $eval_form_values ) {

			if ( strpos( $field->cssClass, $eval_form_values['thiscss'] ) === false ) {
				continue;
			}

			$args = array(
				'numberposts' => -1,
				'post_status' => 'publish',
				'post_type' => 'organization',
				'org_type' => $eval_form_values['thistype'], 
			);
			// var_dump($args);

			$posts = get_posts( $args );
			$choices = array();
			foreach ( $posts as $post ) {
				// var_dump($post);
				// var_dump($post->post_title);
				// Need to remove the userlogin if found on the org title  orgname_orgcity_orgstate_username
				// $my_title = explode( '_', $post->post_title );
				$choices[] = array( 
					'text' => $post->post_title, 
					'value' => $post->post_title, 
				);
			}
	
			$field->choices = $choices;
			$field->placeholder = $eval_form_values['thisplace'];
		}

	}
    return $form;
}

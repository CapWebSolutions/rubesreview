<?php

/**
 * Adds new image sizes.
 *
 * @since 1.0.0
 *
 * @return void
 */
function adds_new_evaluations_image_sizes() {
	$config = array(
		'rubesreview-evaluation-image' => array(
			'width'  => 200,
			'height' => 200,
			'crop'   => true,
		),
	);

	foreach ( $config as $name => $args ) {
		$crop = array_key_exists( 'crop', $args ) ? $args['crop'] : false;

		add_image_size( $name, $args['width'], $args['height'], $crop );
	}
}

 /**
 * load evaluation archive template
 * @param  template $archive_template requires Genesis
 *
 * @since  1.2.0
 */
function load_archive_template( $archive_template ) {
	if ( is_post_type_archive( array('agnt_eval') ) ) {
		$archive_template = dirname( __FILE__ ) . '/views/single-evaluation-agency.php';
	}
	if ( is_post_type_archive( array('hosp_eval' ) ) ) {
		$archive_template = dirname( __FILE__ ) . '/views/single-evaluation-hospital.php';
	}
	if ( is_post_type_archive( array('cont_eval', 'malp_eval' ) ) ) {
		$archive_template = dirname( __FILE__ ) . '/views/archive-evaluation.php';
	}
	if ( is_post_type_archive( 'organization' ) ) {
		$archive_template = dirname( __FILE__ ) . '/views/archive-organization.php';
	}
	return $archive_template;

}

 /**
 * load evaluation archive template
 * @param  template $archive_template requires Genesis
 *
 * @since  1.2.0
 */
function load_taxonomy_archive_template( $taxonomy_archive_template ) {
	if ( is_archive( 'org_type', 'eval_org_type' ) ) {
		// $taxonomy_archive_template = dirname( __FILE__ ) . '/views/taxonomy-orgtype.php';
		$taxonomy_archive_template = dirname( __FILE__ ) . '/views/archive-organization.php';
	}

	return $taxonomy_archive_template;

}

/**
 * load single evaluation template
 * 
 * @param  template $single_template requires Genesis
 * @since 1.2.0
 */
function load_single_template( $single_template ) {
	if ( is_singular( 'agnt_eval' )  || is_post_type_archive('agnt_eval') ) {
		$single_template = dirname( __FILE__ ) . '/views/single-evaluation-agency.php';
		return $single_template;
	} elseif ( is_singular( 'hosp_eval' ) ) {
		$single_template = dirname( __FILE__ ) . '/views/single-evaluation-hospital.php';
		return $single_template;
	} elseif ( is_singular( 'cont_eval' ) ) {
		$single_template = dirname( __FILE__ ) . '/views/single-evaluation-continuinged.php';
		return $single_template;
	} elseif ( is_singular( 'malp_eval' ) ) {
		$single_template = dirname( __FILE__ ) . '/views/single-evaluation-malpractice.php';
		return $single_template;
	} elseif ( is_singular( 'organization' ) ) {
		$single_template = dirname( __FILE__ ) . '/views/single-organization.php';
		return $single_template;
	} elseif ( is_singular( 'organization' ) ) {
		$single_template = dirname( __FILE__ ) . '/views/single-organization.php';
		return $single_template;
	} elseif ( is_single() ) {
		$single_template = get_stylesheet_directory() . '/single.php';
		return $single_template;
	}
	return false;

}

/* Check if Org exists before saving post (GF ID 10)
	Post name format is {Organization Name:32}_{Location:33}_{Location:34} 
*/

add_filter('gform_validation_10', 'rubes_custom_validation');
function rubes_custom_validation($validation_result){

	if ( is_null( $_POST['input_32'] ) || empty( $_POST['input_32'] )) {
		$validation_result["is_valid"] = false;
		$form = $validation_result["form"];
		$form["fields"][0]["failed_validation"] = true;
		$form["fields"][0]["validation_message"] = "This field is required.";
	} else {
		$post_title_to_add = $_POST['input_32'] . '_' . $_POST['input_33'] . '_' . $_POST['input_34'];
		$my_post_id_exists = post_exists( $post_title_to_add );
		if ( $my_post_id_exists ) {
			// set the form validation to false
			$validation_result["is_valid"] = false;
			$form = $validation_result["form"];

			// specify the first field to be invalid - org name field - and provide a custom validation message
			$form["fields"][2]["failed_validation"] = true;
			$form["fields"][2]["validation_message"] = "This organization exists already! <a href=\"" . get_permalink( $my_post_id_exists ) . "\" target=\"_blank\">View it.</a>";

			// update the form in the validation result with the form object you modified
			$validation_result["form"] = $form;
		}
	}
    return $validation_result;

}

/* Check if evaluaiton exists before saving CPT evaluation
	eval Post name format is {Org Name}_{LocationCity}_{LocationState}_{user:user_login} 
*/

add_filter('gform_validation_11', 'rubes_custom_eval_validation');  // agency eval form
add_filter('gform_validation_20', 'rubes_custom_eval_validation');  // hospital eval form
add_filter('gform_validation_21', 'rubes_custom_eval_validation');  // continuing ed eval form
add_filter('gform_validation_22', 'rubes_custom_eval_validation');  // malpractice company eval form

function rubes_custom_eval_validation($validation_result) {

	$form_id = $validation_result["form"]['id'];

	$current_user = wp_get_current_user();
	$my_post_subtitle = $_POST['input_55'];
	if ( 22 == $form_id ) $my_post_subtitle = $_POST['input_89'];  // Malp (ID 22) has title in Fld 89

	$my_post_title = $my_post_subtitle . '_' . $current_user->user_login;
	$my_post_id_exists = post_exists( $my_post_title );

	if ( $my_post_id_exists ) {

		// Can only submit reviews every 6 months, or as defined on theme options page.
		$resubmit_interval = '+6 months';
		$resubmit_option = genesis_get_option( 'rr_resubmit_eval', 'rubesreview-settings' );
		if ( '1' <= $resubmit_option && '6' >= $resubmit_option ) $resubmit_interval = '+' . $resubmit_option . ' months';

		$my_post_date = get_the_date("Y-m-d", $my_post_id_exists );
		$my_date = new DateTime($my_post_date);
		$my_date->add(new DateInterval('P' . $resubmit_option . 'M'));
		$my_post_date_next = $my_date->format("m-d-Y");
		
		// set the form validation to indicate error
		$validation_result["is_valid"] = false;
		$form = $validation_result["form"];

		// specify the first field to be invalid - and provide a custom validation message
		$form["fields"][0]["failed_validation"] = true;
		$form["fields"][0]["validation_message"] = "You have already submitted an evaluation for this organization. <a href=\"" . get_permalink( $my_post_id_exists ) . "\">View it here.</a><br>You may submit another evaluation for this organization on " . $my_post_date_next . ".";

		// update the form in the validation result with the form object you modified
		$validation_result["form"] = $form;
	}
    return $validation_result;

}

// Validation to check on whether or not eval goes into holding state.
// Form 11 is Agency eval
// Form 20 is Hospital eval
// If Average Rating less than 3, eval is in holding, otherwises it is published. 
add_filter('gform_post_data_11', 'gform_dynamic_post_status', 10, 3);  // Agency Form - field 52
add_filter('gform_post_data_20', 'gform_dynamic_post_status', 10, 3);  // Hosp Form - field 52
add_filter('gform_post_data_21', 'gform_dynamic_post_status', 10, 3);  // CE Form - field 52
add_filter('gform_post_data_22', 'gform_dynamic_post_status', 10, 3);  // Malp Form - field 52

function gform_dynamic_post_status($post_data, $form, $entry) {
// 52 is the Rating Average field on the eval forms
	if( $entry[52] ) {
		if ( $entry[52] < 3) {
				$post_data['post_status'] = 'pending';
		} else {
				$post_data['post_status'] = 'publish';
		}
	}
	return $post_data;
}

/**	
 * Output a single Agency evalutaion 
 * 
 */

 function display_single_rubes_eval( $args ) {

 }


//  add_action( 'gform_pre_submission_11', 'cws_pre_submission' );
//  add_action( 'gform_pre_submission_20', 'cws_pre_submission' );
//  add_action( 'gform_pre_submission_21', 'cws_pre_submission' );
//  add_action( 'gform_pre_submission_22', 'cws_pre_submission' );
 function cws_pre_submission( $form ){
	 var_dump( $form );
	 return;
 }
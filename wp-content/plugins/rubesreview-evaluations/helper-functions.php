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
	if ( is_post_type_archive( 'evaluation' ) || is_tax( 'orgtype' ) ) {
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
	if ( is_tax( 'orgtype' ) ) {
		$taxonomy_archive_template = dirname( __FILE__ ) . '/views/taxonomy-orgtype-emare.php';
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
	if ( is_singular( 'evaluation' ) ) {
		$single_template = dirname( __FILE__ ) . '/views/single-evaluation.php';
	}
	if ( is_singular( 'evaluation' ) && has_term( 'malpractice-company', 'orgtype') ) {
		$single_template = dirname( __FILE__ ) . '/views/single-evaluation-malpractice.php';
	}
	if ( is_singular( 'organization' ) ) {
		$single_template = dirname( __FILE__ ) . '/views/single-organization.php';
	}
	return $single_template;

}

/**
 * Generate overall numerical score and star rating string for display
 * 
 * @param  
 * @since 1.0.0
 */
function get_overall_rating_for( $args ) {

	$args['overall'] = 4.9;
	$args['stars'] = '\f005\f005\f005\f005';
	d($args);
	return $args;
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_emare',
		'title' => 'emare',
		'fields' => array (
			array (
				'key' => 'field_5a2efd6d3a7a4',
				'label' => 'field01',
				'name' => 'field01',
				'type' => 'text',
				'instructions' => 'these are the instructions for field 01',
				'default_value' => '',
				'placeholder' => 'field01',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a2efda25acbf',
				'label' => 'field02',
				'name' => 'field02',
				'type' => 'number',
				'instructions' => 'these are the instructions for field 02',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => 5,
				'step' => 1,
			),
			array (
				'key' => 'field_5a2efdc540a82',
				'label' => 'field03',
				'name' => 'field03',
				'type' => 'textarea',
				'instructions' => 'these are the instructions for field 03',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => 1000,
				'rows' => 5,
				'formatting' => 'br',
			),
			array (
				'key' => 'field_5a2efd973a7a5',
				'label' => '',
				'name' => '',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'emare',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_hospital-fields',
		'title' => 'Hospital Fields',
		'fields' => array (
			array (
				'key' => 'field_5a2f075d77f05',
				'label' => 'hosp-field01',
				'name' => 'hosp-field01',
				'type' => 'text',
				'instructions' => 'Name of the hospital/surgery center?',
				'required' => 1,
				'default_value' => '',
				'placeholder' => 'Name of the hospital/surgery center?',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5a2f09ab77f06',
				'label' => 'hosp-field02',
				'name' => 'hosp-field02',
				'type' => 'select',
				'instructions' => 'Contact with the hospital was made by:',
				'required' => 1,
				'choices' => array (
					'Hospital' => 'Hospital',
					'Agency' => 'Agency',
					'Self' => 'Self',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f09e777f07',
				'label' => 'hosp-field03',
				'name' => 'hosp-field03',
				'type' => 'select',
				'instructions' => 'Position was:',
				'required' => 1,
				'choices' => array (
					'Permanent' => 'Permanent',
					'Locum' => 'Locum',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0a1d1d3fd',
				'label' => 'hosp-field04',
				'name' => 'hosp-field04',
				'type' => 'select',
				'required' => 1,
				'choices' => array (
					'Full time' => 'Full time',
					'Part time' => 'Part time',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0a611d3fe',
				'label' => 'hosp-field05',
				'name' => 'hosp-field05',
				'type' => 'select',
				'instructions' => 'Salary was ... for the medical industry',
				'required' => 1,
				'choices' => array (
					'Above Standard' => 'Above Standard',
					'Average' => 'Average',
					'Below Standard' => 'Below Standard',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0aa71d3ff',
				'label' => 'hosp-field06',
				'name' => 'hosp-field06',
				'type' => 'select',
				'instructions' => 'Was health insurance provided?',
				'required' => 1,
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0ac81d400',
				'label' => 'hosp-field07',
				'name' => 'hosp-field07',
				'type' => 'select',
				'instructions' => 'At Whose Cost?',
				'required' => 1,
				'choices' => array (
					'Hospital' => 'Hospital',
					'Agency' => 'Agency',
					'Self' => 'Self',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0ae81d401',
				'label' => 'hosp-field08',
				'name' => 'hosp-field08',
				'type' => 'select',
				'instructions' => 'Was there a \'sick leave\' policy?',
				'required' => 1,
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0b1a1d402',
				'label' => 'hosp-field09',
				'name' => 'hosp-field09',
				'type' => 'select',
				'instructions' => 'Were you given a hospital orientation',
				'required' => 1,
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0b381d403',
				'label' => 'hosp-field10',
				'name' => 'hosp-field10',
				'type' => 'select',
				'instructions' => 'Were you given a departmental/section/floor orientation',
				'required' => 1,
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0b591d404',
				'label' => 'hosp-field11',
				'name' => 'hosp-field11',
				'type' => 'select',
				'instructions' => 'Was it provided by someone who knew your work environment? A co-worker or supervisor?',
				'required' => 1,
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0b801d405',
				'label' => 'hosp-field12',
				'name' => 'hosp-field12',
				'type' => 'select',
				'instructions' => 'Did you feel your orientation was adequate?',
				'required' => 1,
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0b981d406',
				'label' => 'hosp-field13',
				'name' => 'hosp-field13',
				'type' => 'select',
				'instructions' => 'Was the hospital work environment adequate? Were you treated with respect? Were you considered as a valued member of the staff?',
				'required' => 1,
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0bc81d407',
				'label' => 'hosp-field14',
				'name' => 'hosp-field14',
				'type' => 'select',
				'instructions' => 'Were the patient nurse ratios adequate?',
				'required' => 1,
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0be71d408',
				'label' => 'hosp-field15',
				'name' => 'hosp-field15',
				'type' => 'select',
				'instructions' => 'Did the hospital provide adequate/safe parking?',
				'required' => 1,
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0bf21d409',
				'label' => 'hosp-field16',
				'name' => 'hosp-field16',
				'type' => 'select',
				'instructions' => 'Did you consider the hospital secure/safe, inside the building?',
				'required' => 1,
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0bff1d40a',
				'label' => 'hosp-field17',
				'name' => 'hosp-field17',
				'type' => 'select',
				'instructions' => 'On exit, from this assignment, were you given an exit interview?',
				'required' => 1,
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0c161d40b',
				'label' => 'hosp-field18',
				'name' => 'hosp-field18',
				'type' => 'select',
				'instructions' => 'Were you satisfied with this assignment?',
				'required' => 1,
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0c291d40c',
				'label' => 'hosp-field19',
				'name' => 'hosp-field19',
				'type' => 'select',
				'instructions' => 'If you had to do it all over again, would you work at this hospital?',
				'required' => 1,
				'choices' => array (
					'Yes' => 'Yes',
					'No' => 'No',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5a2f0c321d40d',
				'label' => 'hosp-field20',
				'name' => 'hosp-field20',
				'type' => 'number',
				'instructions' => 'Please give a overall rating of this hospital.',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => 5,
				'step' => '',
			),
			array (
				'key' => 'field_5a2f0c6f1d40e',
				'label' => 'hosp-field21',
				'name' => 'hosp-field21',
				'type' => 'textarea',
				'instructions' => 'Comments',
				'default_value' => '',
				'placeholder' => 'Comments',
				'maxlength' => 1000,
				'rows' => 5,
				'formatting' => 'br',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'evaluation',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => '5',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

/* Check if Org exists before saving post (GF ID 10)
	Post name format is {Organization Name:32}-{Location:33}-{Location:34} 
*/

add_filter('gform_validation_10', 'rubes_custom_validation');
function rubes_custom_validation($validation_result){

	if ( is_null( $_POST['input_32'] ) || empty( $_POST['input_32'] )) {
		$validation_result["is_valid"] = false;
		$form = $validation_result["form"];
		$form["fields"][0]["failed_validation"] = true;
		$form["fields"][0]["validation_message"] = "This field is required.";
	} else {
		$post_title_to_add = $_POST['input_32'] . '-' . $_POST['input_33'] . '-' . $_POST['input_34'];
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


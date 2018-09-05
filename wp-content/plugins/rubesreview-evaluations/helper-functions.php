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
		// $archive_template = dirname( __FILE__ ) . '/views/single-evaluation-agency.php';
		$archive_template = dirname( __FILE__ ) . '/views/single-evaluation-agency-v2.php';
	}
	if ( is_post_type_archive( array('hosp_eval' ) ) ) {
		$archive_template = dirname( __FILE__ ) . '/views/single-evaluation-hospital.php';
	}
	if ( is_post_type_archive( array('cont_eval' ) ) ) {
		$archive_template = dirname( __FILE__ ) . '/views/single-evaluation-continuinged.php';
	}
	
	if ( is_post_type_archive( array('malp_eval' ) ) ) {
		$archive_template = dirname( __FILE__ ) . '/views/single-evaluation-malpractice.php';
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
		$single_template = dirname( __FILE__ ) . '/views/single-evaluation-agency-v2.php';
		// $single_template = dirname( __FILE__ ) . '/views/single-evaluation-agency.php';
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

add_filter( 'gform_validation_10', 'rubes_custom_validation' );
function rubes_custom_validation($validation_result){

	if ( is_null( $_POST['input_32'] ) || empty( $_POST['input_32'] )) {
		$validation_result["is_valid"] = false;
		$form = $validation_result["form"];
		$form["fields"][0]["failed_validation"] = true;
		$form["fields"][0]["validation_message"] = "This field is required.";
	} else {
		// Since working in the front end here, need to pull in the post_exists function specifically.
		if ( ! function_exists( 'post_exists' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/post.php' );
		}

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

/* Check if evaluation exists before saving CPT evaluation
	eval Post name format is {Org Name}_{LocationCity}_{LocationState}_{user:user_login} 
*/

// add_filter('gform_validation_11', 'rubes_custom_eval_validation');  // agency eval form
add_filter('gform_validation_20', 'rubes_custom_eval_validation');  // hospital eval form
add_filter('gform_validation_21', 'rubes_custom_eval_validation');  // continuing ed eval form
add_filter('gform_validation_22', 'rubes_custom_eval_validation');  // malpractice company eval form
add_filter('gform_validation_23', 'rubes_custom_eval_validation');  // agency eval form V2

function rubes_custom_eval_validation($validation_result) {

	$form_id = $validation_result["form"]['id'];

	$current_user = wp_get_current_user();
	$my_post_subtitle = $_POST['input_55'];
	if ( 22 == $form_id ) $my_post_subtitle = $_POST['input_89'];  // Malp (ID 22) has title in Fld 89
	if ( 23 == $form_id ) $my_post_subtitle = $_POST['input_1'];  // Agency v2 (ID 23) has title in Fld 1

	// Since working in the front end here, need to pull in the post_exists function specifically.
	if ( ! function_exists( 'post_exists' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/post.php' );
	}

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
// add_filter('gform_post_data_11', 'gform_dynamic_post_status', 10, 3);  // Agency Form - field 52
add_filter('gform_post_data_20', 'gform_dynamic_post_status', 10, 3);  // Hosp Form - field 52
add_filter('gform_post_data_21', 'gform_dynamic_post_status', 10, 3);  // CE Form - field 52
add_filter('gform_post_data_22', 'gform_dynamic_post_status', 10, 3);  // Malp Form - field 52
add_filter('gform_post_data_23', 'gform_dynamic_post_status', 10, 3);  // Agency v2 Form - field 33

function gform_dynamic_post_status($post_data, $form, $entry) {
// 52 is the Rating Average field on most eval forms. 
// Fld 33 on form 23/Agency v2 form - complete rewrite. 

	if ( 23 == $form['fields'][0]['formId'] ) {
		$value_to_check = $entry[33];
	} else {
		$value_to_check = $entry[52];
	}

	if( $value_to_check ) {
		if ( $value_to_check < 3) {
				$post_data['post_status'] = 'pending';
		} else {
				$post_data['post_status'] = 'publish';
		}
	}
	return $post_data;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function yourprefix_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo esc_attr( $classes ); ?>">
		<p><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></p>
		<p><input id="<?php echo esc_attr( $id ); ?>" type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
	<?php
}


/**
 * Overrides the default render field method
 * Allows you to add custom HTML before and after a rendered field
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function override_render_field_callback( $field_args, $field ) {

	// If field is requesting to not be shown on the front-end
	if ( ! is_admin() && ! $field->args( 'on_front' ) ) {
		return;
	}

	// If field is requesting to be conditionally shown
	if ( ! $field->should_show() ) {
		return;
	}

	$field->peform_param_callback( 'before_row' );

	// Remove the cmb-row class
	printf( '<div class="custom-class %s">', $field->row_classes() );

	if ( ! $field->args( 'show_names' ) ) {
	
		// If the field is NOT going to show a label output this
		echo '<div class="cmb-td custom-label-class">';
		$field->peform_param_callback( 'label_cb' );
	
	} else {

		// Otherwise output something different
		if ( $field->get_param_callback_result( 'label_cb', false ) ) {
			echo '<div class="cmb-th custom-label-field-class">', $field->peform_param_callback( 'label_cb' ), '</div>';
		}
		echo '<div class="cmb-td custom-label-field">';
	}


	// $field->peform_param_callback( 'before' );
	// rubes_replace_placeholder_with_stars( $field_args, $field );
	$field->peform_param_callback( 'before' );
	
	// The next two lines are key. This is what actually renders the input field
	$field_type = new CMB2_Types( $field );
	$field_type->render();

	$field->peform_param_callback( 'after' );

	echo '</div></div>';

	$field->peform_param_callback( 'after_row' );

    // For chaining
	return $field;
}

function rubes_replace_placeholder_with_stars( $field_args, $field ){
	$test = strtr( $field->before, '#', $field->value() );
	// var_dump($test);
	return;
}

// Stars custom field type ======================================================
function cmb2_render_callback_for_radio_inline_stars( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
	echo $field_type_object->input( 
		array( 'type' => 'radio_inline',
		'options' => array(
			'1' => __( '1', 'rr' ),
			'2' => __( '2', 'rr' ),
			'3' => __( '3', 'rr' ),
			'4' => __( '4', 'rr' ),
			'5' => __( '5', 'rr' ),
		), 
		) );
	// echo 'zzzzzzzzzzzzzzzzzzzzz';

}
add_action( 'cmb2_render_radio_inline_stars', 'cmb2_render_callback_for_radio_inline_stars', 10, 5 );


function cmb2_sanitize_radio_inline_stars( $null, $new ) {
	$new = preg_replace( "/[^0-9]/", "", $new );
	return $new;
  }
add_filter( 'cmb2_sanitize_radio_inline_stars', 'cmb2_sanitize_radio_inline_stars', 10, 2 );

/**
 * cmb2_render_radio_inline_stars_callback
 * Display the radio inline stars field
 *
 * @param [type] $field : The current CMB2_Field object.
 * @param [type] $value : The value of this field passed through the escaping filter. It defaults to sanitize_text_field. If you need the unescaped value, you can access it via $field_type_object->value().
 * @param [type] $object_id : The id of the object you are working with. Most commonly, the post id.
 * @param [type] $object_type : The type of object you are working with. Most commonly, post (this applies to all post-types), but could also be comment, user or options-page.
 * @param [type] $field_type : This is an instance of the CMB2_Types object and gives you access to all of the methods that CMB2 uses to build its field types.
 * @return void
 */
function cmb2_render_radio_inline_stars_callback( $field, $value, $object_id, $object_type, $field_type ) {
	echo $field_type_object->input( array( 'type' => 'radio' ) );
}
add_filter( 'cmb2_render_radio_line_stars', 'cmb2_render_radio_inline_stars_callback', 10, 5 );

/**
 * cmb2_sanitize_radio_inline_stars_callback
 * Sanitize the number input. 
 *
 * @param [type] $null : Sanitization override value to return. It is passed in as null, and is what we will modify to short-circuit CMB2's saving mechanism.
 * @param [type] $value : The actual field value.
 * @return void
 */
function cmb2_sanitize_radio_inline_stars_callback( $null, $value ) {
	$new = preg_replace( "/[^0-9]/", "", $value );
	return $value;
  }
add_filter( 'cmb2_sanitize_radio_inline_stars', 'cmb2_sanitize_radio_inline_stars_callback', 10, 2 );


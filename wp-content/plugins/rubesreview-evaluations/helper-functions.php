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

	return $archive_template;

}

 /**
 * load evaluation archive template
 * @param  template $archive_template requires Genesis
 *
 * @since  1.2.0
 */
function load_taxonomy_archive_template( $taxonomy_archive_template ) {
	if ( is_post_type_archive( 'evaluation' ) && is_archive( 'orgtype', array( 'clients', 'colleagues', 'professionals' ) ) ) {
		$taxonomy_archive_template = dirname( __FILE__ ) . '/views/taxonomy-orgtype.php';
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

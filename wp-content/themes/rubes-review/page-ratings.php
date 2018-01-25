<?php
/**
 * Rube's Review Child Theme
 *
 * This file adds the Ratings Leaderboard page template to the Rube's Review Theme.
 *
 * Template Name: Ratings Leaderboard
 * Template Post Type: page
 *
 * @package rubesreview
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/rubesreview/
 */

// Add leaderboard page body class to the head.
add_filter( 'body_class', 'rubesreview_add_body_class' );
function rubesreview_add_body_class( $classes ) {
	$classes[] = 'ratings-page';
	return $classes;
}

/**
 * Remove the standard loop
 */
remove_action( 'genesis_loop', 'genesis_do_loop' );

//* Custom Loop
add_action( 'genesis_loop',  __NAMESPACE__ . '\rubes_ratings_loop' );
function rubes_ratings_loop() {

	global $wp_query;

//* dump out the Beaver header & menu template  
	FLBuilder::render_query( array(
		'post_type' => 'fl-builder-template',
		'p'         => 622 // Beaver Ratings Template ID

	) );

	printf('<div class="ratings-wrapper"><div class="ratings-content-wrapper">');

	$rating_displays = array( 'Most Recent Ratings', 'Ratings Leaderboard' );
	foreach ( $rating_displays as $rating_display_value ) {

	printf('<div class="ratings-section-wrapper">');

	printf('<div class="ratings-section-heading">%s</div>', $rating_display_value );
	printf('<div class="ratings-grid-wrapper">');
	$orgtypes = array( 
		array('slug' => 'agency', 
			'pref' => 'agnt_', 
			'evaltype' => 'agency', 
			'posttype'=>'agnt_eval'),
		array('slug' => 'hospital', 
			'pref' => 'hosp_', 
			'evaltype' => 'hospital', 
			'posttype'=>'hosp_eval'), 
		array('slug' => 'continuing-education', 
			'pref' => 'cont_', 
			'evaltype' => 'continuing ed', 
			'posttype'=>'cont_eval'), 
		array('slug' => 'malpractice',
			'pref' => 'malp_', 
			'evaltype' => 'malpractice company', 
			'posttype'=>'malp_eval' ),
	);
	switch ( $rating_display_value ) {
		case 'Most Recent Ratings':
			foreach ( $orgtypes as $orgvalue ) {
				$prefix = 'rr_eval_' . $orgvalue['pref'];
				$query_args = array(
					'post_type' => $orgvalue['posttype'],
					'posts_per_page' => 5,
					'order' => 'DESC',
				);

				print_average_ratings_line( $query_args, $orgvalue, $prefix );

			} /* End of $orgtypes loop */

			/* *********************************************************************** */

			break;  /* End of Most Recent Ratings case */
		case 'Ratings Leaderboard':
			foreach ( $orgtypes as $orgvalue ) {
				$prefix = 'rr_eval_' . $orgvalue['pref'];
				$query_args = array(
					'post_type' => $orgvalue['posttype'],
					'posts_per_page' => 5,
					'order' => 'DESC',
					'orderby' => 'meta_value_num',   // want to orderby the value of the $prefix . 'rating_average' field, highest to lowest, top 5
					'meta_key' => $prefix . 'rating_average',
				);
				print_average_ratings_line( $query_args, $orgvalue, $prefix );
			} /* End of $orgtypes loop */		
			break; /* End of Ratings Leaderboard case */
	} /* end of switch */
	printf('</div></div>'); /* End of rating-section-wrapper and ratings-grid-wrapper divs */

	} /* end of $rating_displays loop */
	printf('</div>'); /* close ratings-content-wrapper */

	// Output sidebar on ratings page. doing it here since entire page is begin generated in code. 
	// Change sidebar configuration under Appearence | Widgets screen
	printf('<div class=ratings-sidebar-wrapper">'); 
		get_sidebar('logged-in-sidebar');
	printf('</div>'); /* close ratings-sidebar-wrapper */

	printf('</div>'); /* End of ratings-wrapper */

}
//* Restore original query
wp_reset_query();

// Run the Genesis loop.
genesis();

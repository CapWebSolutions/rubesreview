<?php
/**
 * Rube's Review Child Theme
 *
 * This file adds the Ratings Leaderboard page template to the Rube's Review Theme.
 *
 * Template Name: Ratings Leaderboard2
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
	$classes[] = 'leaderboard-page';
	return $classes;
}

// Remove Skip Links.
// remove_action ( 'genesis_before_header', 'genesis_skip_links', 5 );

// Dequeue Skip Links Script.
// add_action( 'wp_enqueue_scripts', 'rubesreview_dequeue_skip_links' );
function rubesreview_dequeue_skip_links() {
	wp_dequeue_script( 'skip-links' );
}

// Force Content/Sidebar layout.
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
// add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

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
		'p'         => 622 // Breaver Header Template ID
	) );

	printf('<div class="ratings-content-wrapper">');
	$rating_displays = array( 'Ratings Leaderboard', 'Most Recent Ratings' );
	foreach ( $rating_displays as $rating_display_value ) {

	printf('<div class="ratings-section-wrapper">');

	printf('<div class="ratings-section-heading">%s</div>', $rating_display_value );
	printf('<div class="ratings-wrapper">');
	$orgtypes = array( 
		array('slug' => 'agency', 'pref' => 'agnt_', 'taxterm' => 'agency'),
		array('slug' => 'hospital', 'pref' => 'hosp_', 'taxterm' => 'hospital'), 
		array('slug' => 'continuing-education', 'pref' => 'cont_', 'taxterm' => ''), 
		array('slug' => 'malpractice-company','pref' => 'malp_', 'taxterm' => '' ) 
	);
	// var_dump($orgtypes);
	switch ( $rating_display_value ) {

		case 'Most Recent Ratings':
			foreach ( $orgtypes as $orgvalue ) {
				$query_args = array(
					'post_type' => 'evaluation',
					'posts_per_page' => 5,
					'order' => 'DESC',
					'tax_query' => array(
						array(
							'taxonomy' => 'eval_org_type',
							'field' => 'name',
							'terms' => $orgvalue['slug'],
						)
					)
				);
				$prefix = 'rr_eval_' . $orgvalue['pref'];
				$wp_query = new WP_Query( $query_args );

				// What type of organization are we processing 
				$org_name_title = ucwords( $query_args['tax_query'][0]['terms'] );

				printf('<div class="ratings-heading-grouping">');
				printf('<div class="ratings-heading">%s</div>', $org_name_title);
				printf('<div class="ratings-top5-grouping">');
					if ( $wp_query -> have_posts() ) {

						while ( $wp_query -> have_posts() ) {
							$wp_query -> the_post();
							$post_id = get_the_ID( $post->ID ); 
							$org_name = get_the_title( $post_id );

							//* get the value of the tax here... Some flavor of orgtype. 
							//* Need slug later for archive link
							$my_term = get_the_terms( $post_id, 'org_type' );

							// Pull off the overall rating. This was the calculated average value based on entered 1-5 ratings
							// $overall_satisfaction = get_post_meta( $post_id,  $prefix . 'overall_satisfaction', true );
							$rating_average = substr( get_post_meta( $post_id,  $prefix . 'rating_average', true ), 0, 1);  // this field name is questionable from form 11

							/* expecting org name string from an evaluation to look like this:  test-organization_test-city_st  */
							/* expecting Agency name string from an evaluation: agency name_city-name_state_{user:user_email}_{date_mdy}  
							TODO: verify post title format being created from FORM xx */
							/* May need to change the substr function to display more of the org name - to include location info ??? */

							$my_eval_values = explode('_', $org_name );

							$eval_org_name_front = $my_eval_values[0];  // org name
							$eval_org_name_city = $my_eval_values[1];  // location city
							$eval_org_name_state = $my_eval_values[2];  // location state
							$eval_org_name_email = $my_eval_values[3];  // author_email
							$eval_org_name_create = $my_eval_values[4];  // create date
							$eval_org_name_location = $eval_org_name_city . ',' . $eval_org_name_state;


							// $eval_org_name_city = substr( $org_name, strlen( $eval_org_name_front) + 1 , strpos( $org_name, '_') - 1 );

							// $new_start = strlen($eval_org_name_front) + strlen($eval_org_name_city) + 2;
							// $eval_org_name_state = substr( $org_name, $new_start, strpos( $org_name, '_', $new_start ) );
							// var_dump($new_start, $eval_org_name_front, $eval_org_name_city, $eval_org_name_state ); 

							// TODO: need to check for empty values and not write to output
							// if ( strlen( $eval_org_name_front ) == 0 ) $eval_org_name_front = $org_name;
							// $eval_org_name_location = $eval_org_name_city . ',' . $eval_org_name_state;
							// var_dump($eval_org_name_location); 

							// $new_start = strlen($eval_org_name_front) + strlen($eval_org_name_city) + strlen($eval_org_name_state) + 2;
							$eval_author_name = get_the_author( $post_id );
							// $eval_create_date = get_the_date( 'm.d.Y', $post_id );
							// var_dump($eval_author_name, $eval_create_date);

							$rating_content = sprintf('<div class="evaluation-org-stars-' . $rating_average . '">' . '<a href="' . get_permalink( $post_id ) . '">' . $eval_org_name_front . ' | ' . $eval_org_name_location . '</a></div>' );
	
							printf( '<div class="ratings-line">%s</div>', $rating_content  );
						}
						if ( $wp_query->found_posts > 1 ) printf('<a class="ratings-archive-link" href="' . '/eval_org_type/%s' . '">More %s Evaluations</a>', $my_term[0]->slug, $my_term[0]->name );
					} else {
						$rating_content = sprintf('No evaluations found.', $org_name_title );	
						printf( '<div class="ratings-line">%s</div>', $rating_content  );
					};
				printf('</div></div>');
				
			} /* End of $orgtypes loop */

			break;  /* End of Most Recent Ratings case */
		case 'Ratings Leaderboard':
		// $orgtypes = array( 'agency', 'hospital', 'continuing education', 'malpractice company' );
		foreach ( $orgtypes as $orgvalue ) {

			$query_args = array(
				'post_type' => 'evaluation',
				'posts_per_page' => 5,
				'orderby' => 'meta_value_num',
				'meta_key' => 'average_rating',
				'tax_query' => array(
					array(
						'taxonomy' => 'orgtype',
						'field' => 'name',
						'terms' => $orgvalue,
					)
				)
			);

			$prefix = '_rubesreview_evaluation_';

			$wp_query = new WP_Query( $query_args );

			$org_name_title = ucwords( $query_args['tax_query'][0]['terms'] );

			printf('<div class="ratings-heading-grouping">');
			printf('<div class="ratings-heading">%s</div>', $org_name_title);
			printf('<div class="ratings-top5-grouping">');
			if ( $wp_query -> have_posts() ) {

				while ( $wp_query -> have_posts() ) {
					$wp_query -> the_post();
			
					global $post;
					$post_id = get_the_ID( $post->ID ); 
					$org_name = get_the_title( $post_id );

					//* get the value of the tax here... Some flavor of orgtype. 
					//* Need slug later for archive link
					$org_custom_term = wp_get_post_terms( $post_id, 'orgtype' );

					// $org_overall_satisfaction = get_post_meta( $post_id,  $prefix . 'org_overall_satisfaction', true );
					$org_average_rating = get_post_meta( $post_id,  'average_rating', true );
					$rating_content = sprintf('<div class="evaluation-org-stars-' . $org_average_rating . '">' . '<a href="' . get_permalink( $post_id ) . '">' . $org_name . '</a></div>' );
					
					printf( '<div class="ratings-line">%s</div>', $rating_content  );
				}
					if ( $wp_query->found_posts > 1 ) printf('<a class="ratings-archive-link" href="' . '/orgtype/%s' . '">More %s Evaluations</a>', $org_custom_term[0]->slug, $org_name_title );
			} else {
				$rating_content = sprintf('No evaluations found. <a href="/write-evaluation">Submit an evaluation</a>.', $org_name_title );	
				printf( '<div class="ratings-line">%s</div>', $rating_content  );
			};
			printf('</div></div>');
			
		} /* End of $orgtypes loop */		
			break; /* End of Ratings Leaderboard case */

	} /* end of switch */
	printf('</div></div>'); /* End of rating-section-wrapper and ratings-wrapper divs */

	} /* end of $rating_displays loop */
	printf('</div>'); /* End of rating-content-wrapper div */
}
//* Restore original query
wp_reset_query();

// Run the Genesis loop.
genesis();

//* dump out the BB footer. 
// FLBuilder::render_query( array(
// 	'post_type' => 'fl-builder-template',
// 	'p'         => 619 // Breaver Header Template ID
// ) );

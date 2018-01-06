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

// add_shortcode( 'output_page_ratings', __NAMESPACE__ . '\rubes_ratings_loop' );
function rubes_ratings_loop() {

	global $wp_query;

//* dump out the Beaver header & menu template  
	FLBuilder::render_query( array(
		'post_type' => 'fl-builder-template',
		'p'         => 622 // Beaver Template ID
	) );

	printf('<div class="ratings-content-wrapper">');
	$rating_displays = array( 'Ratings Leaderboard', 'Most Recent Ratings' );
	foreach ( $rating_displays as $rating_display_value ) {

	printf('<div class="ratings-section-wrapper">');

	printf('<div class="ratings-section-heading">%s</div>', $rating_display_value );
	printf('<div class="ratings-wrapper">');
	$orgtypes = array( 
		array('slug' => 'agency', 'pref' => 'agnt_', 'evaltype' => 'agency', 'posttype'=>'agnt_eval'),
		array('slug' => 'hospital', 'pref' => 'hosp_', 'evaltype' => 'hospital', 'posttype'=>'hosp_eval'), 
		array('slug' => 'continuing-education', 'pref' => 'cont_', 'evaltype' => 'continuing ed', 'posttype'=>'cont_eval'), 
		array('slug' => 'malpractice-company','pref' => 'malp_', 'evaltype' => 'malpractice company', 'posttype'=>'malp_eval' ),
	);
	switch ( $rating_display_value ) {
		case 'Most Recent Ratings':
			foreach ( $orgtypes as $orgvalue ) {
				$prefix = 'rr_eval_' . $orgvalue['pref'];
				$query_args = array(
					'post_type' => $orgvalue['posttype'],
					'posts_per_page' => 5,
					'order' => 'DESC',
					// 'tax_query' => array(
					// 	array(
					// 		'taxonomy' => 'eval_org_type',
					// 		'field' => 'name',
					// 		'terms' => $orgvalue['slug'],
					// 	)
					// )
				);

				print_average_ratings_line( $query_args, $orgvalue, $prefix );
				// wp_reset_postdata();
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
					// 'tax_query' => array(
					// 	array(
					// 		'taxonomy' => 'eval_org_type',
					// 		'field' => 'name',
					// 		'terms' => $orgvalue['slug'],
					// 	)
					// )
				);
				// var_dump($query_args);
				print_average_ratings_line( $query_args, $orgvalue, $prefix );
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

function print_average_ratings_line( $args, $orgvalue, $prefix ) {
	
    $wp_query = new WP_Query( $args );

    // What type of organization are we processing 
    // $org_name_title = ucwords( $args['tax_query'][0]['terms'] );
	$org_name_title = ucwords( $orgvalue['evaltype'] );
	
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
			// $my_term = get_the_terms( $post_id, 'org_type' );
			$my_term = $orgvalue['evaltype'];

            // Pull off the overall rating. This was the calculated average value based on entered 1-5 ratings
            $rating_average = substr( get_post_meta( $post_id,  $prefix . 'rating_average', true ), 0, 1);  // this field name is questionable from form 11

            /* expecting Agency name string from an evaluation: agency name_city_state_{user} */

            // Break out all parts of post title
			$my_eval_values = explode('_', $org_name );
			// var_dump($my_eval_values);
            $eval_org_name_front = $my_eval_values[0];  // org name
            $eval_org_name_city = $my_eval_values[1];  // location city
            $eval_org_name_state = $my_eval_values[2];  // location state
            $eval_org_name_email = $my_eval_values[3];  // author_email
            $eval_org_name_location = $eval_org_name_city . ', ' . $eval_org_name_state;

            $rating_content = sprintf('<div class="evaluation-org-stars-%s"><a href="%s">%s &mdash; %s</a></div>', $rating_average, get_permalink( $post_id ), $eval_org_name_front, $eval_org_name_location  );
			printf( '<div class="ratings-line">%s</div>', $rating_content  );
        }
        if ( $wp_query->found_posts > 1 ) printf('<a class="ratings-archive-link" href="' . '/%s' . '">More %s Evaluations</a>', $my_term, ucwords($my_term) );
    
    } else {
        $rating_content = sprintf('No evaluations found.', $org_name_title );	
        printf( '<div class="ratings-line">%s</div>', $rating_content  );
    
    };
        
    printf('</div></div>');
    return;
}

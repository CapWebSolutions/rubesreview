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
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content' );
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

	$rating_displays = array( 'Ratings Leaderboard', 'Most Recent Ratings' );
	foreach ( $rating_displays as $rating_display_value ) {

	printf('<div class="ratings-section-wrapper">');

	printf('<div class="ratings-section-heading">%s</div>', $rating_display_value );
	printf('<div class="ratings-wrapper">');

	switch ( $rating_display_value ) {

		case 'Most Recent Ratings':
			$orgtypes = array( 'agency', 'hospital', 'continuing education', 'malpractice company' );
			foreach ( $orgtypes as $orgvalue ) {

				$query_args = array(
					'post_type' => 'evaluation',
					'posts_per_page' => 5,
					'order' => 'DESC',
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
							$org_overall_satisfaction = get_post_meta( $post_id,  $prefix . 'org_overall_satisfaction', true );
							$rating_content = sprintf('<div class="evaluation-org-stars-' . $org_overall_satisfaction . '">' . $org_name . '</div>' );
							printf( '<div class="ratings-line">%s</div>', $rating_content  );
						}
						if ( $wp_query->found_posts > 1 ) printf('<a class="ratings-archive-link" href="' . '/orgtype )' . '">TODO: Full %s Listing</a>', $org_name_title );
					} else {
						$rating_content = sprintf('No evaluations found.', $org_name_title );	
						printf( '<div class="ratings-line">%s</div>', $rating_content  );
					};
				printf('</div></div>');
				
			} /* End of $orgtypes loop */

			break;  /* End of Most Recent Ratings case */
		case 'Ratings Leaderboard':
			printf('<div class="ratings-heading">CASE UNDER DEVELOPMENT</div>');
			break; /* End of Ratings Leaderboard case */

	} /* end of switch */
	printf('</div>'); /* End of rating-section-wrapper div */

	} /* end of $rating_displays loop */
}
//* Restore original query
wp_reset_query();

// Run the Genesis loop.
genesis();

//* dump out the BB footer. 
FLBuilder::render_query( array(
	'post_type' => 'fl-builder-template',
	'p'         => 619 // Breaver Header Template ID
) );

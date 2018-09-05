<?php
/**
 * General
 *
 * This file contains any functions needed to count evaluations by category and update shortcode
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/starter-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2017, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */


/**
 * Reviews Shortcode
 * @link http://www.billerickson.net/using-shortcodes/
 * @author Matt Ryan 
 *
 * @return string number_of_agency_reviews
 */

/* For rubesreviews shortcode, return number of posts in the specified category.
 * Use this in number counter for front page. 
 */

function cws_reviews_shortcode( $atts ) {
	
	$args = shortcode_atts(
		array(
			'post_type' => 'evaltype',
		), $atts
	);
	// $args = array( 'post_type' => $a['evaltype'] );
	$the_query = new WP_Query( $args );
	return $the_query->found_posts;
}
add_shortcode( 'rubesreviews', 'cws_reviews_shortcode' );
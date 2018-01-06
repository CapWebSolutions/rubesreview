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
 * Use this in numbeer counter for front page. 
 */

function cws_reviews_shortcode( $atts ) {
	
		$a = shortcode_atts( array(
			'orgtype' => 'agency',
		), $atts );
	
		// $args = array(
		// 	'cat'=> $a['orgtype'],
		// 	'post_type' => 'evaluation'
		// );

		$args = array(
			'post_type' => 'evaluation',
			'tax_query' => array(
				array(
					'taxonomy' => 'eval_org_type',
					'field' => 'name',
					'terms' =>  $a['orgtype'],
				)
			)
		);
		$the_query = new WP_Query( $args );
		return $the_query->found_posts;
	}
	add_shortcode( 'rubesreviews', 'cws_reviews_shortcode' );
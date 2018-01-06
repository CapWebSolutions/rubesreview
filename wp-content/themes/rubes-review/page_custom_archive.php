<?php
/**
 * Put together by Sridhar Katakam using the code linked in StudioPress forum post
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/forums/topic/creating-custom-page-templates/#post-82959
 */

//* Template Name: Custom Archive

//* Remove standard post content output
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action( 'genesis_entry_content', 'sk_page_archive_content' );
add_action( 'genesis_post_content', 'sk_page_archive_content' );
/**
 * This function outputs posts grouped by year and then by months in descending order.
 *
 */
function sk_page_archive_content() {


	$args = array(
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page'=> '6', // overrides posts per page in theme settings
		);
		$loop = new WP_Query( $args );
		if( $loop->have_posts() ):
		
		while( $loop->have_posts() ): $loop->the_post(); global $post;

		$post_id = get_the_ID( $post->ID );
		echo '<div id="spotlight">';
			echo '<div class="one-fourth first">';
				echo '<div class="spotlight-image"><div class="pic">'. get_the_post_thumbnail( $post_id, array(150,150) ).'</div></div>';
			echo '</div>'; 
			echo '<div class="three-fourths" style="border-bottom:1px solid #DDD;">';
				echo '<h3>' . get_the_title() . '</h3>';
				echo '<div class="spot-date">' . genesis_post_info() . '</div>';
				echo '<p>' . get_the_excerpt() . '</p>'; 
				echo '<div class="spot-categories">' . genesis_post_meta() . '</div>';				
			echo '</div>';
		echo '</div>';
		endwhile;
		genesis_posts_nav();
	endif;

	//* Restore original query
	wp_reset_query();

}

remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

genesis();
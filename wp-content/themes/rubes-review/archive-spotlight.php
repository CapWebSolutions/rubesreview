<?php
/**
 * Rube's Review Child Theme
 *
 * This file adds the Spotlight page template to the Rube's Review Theme.
 *
 *
 * @package rubesreview
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/rubesreview/
 */

/**
 * Template Name: Spotlight Archives
 * Description: Used as a page template to show page contents, followed by a loop through a the spotlight archive  
 */

remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_do_grid_loop' ); // Add custom loop

function custom_do_grid_loop() {  
  	
	// Intro Text (from page content)
	echo '<div class="page hentry entry">';
	echo '<h1 class="entry-title">'. get_the_title() .'</h1>';
	echo '<div class="entry-content">' . get_the_content() ;

	$args = array(
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page'=> '6',  // overrides posts per page in theme settings
	);
	$loop = new WP_Query( $args );
	if( $loop->have_posts() ):
				
		while( $loop->have_posts() ): $loop->the_post(); global $post;
			$id = $post->id;
		echo '<div id="spotlights">';
			echo '<div class="one-fourth first">';
			echo '<div class="spotlight-image"><div class="pic">'. get_the_post_thumbnail( $id, array(150,150) ).'</div></div>';
			echo '</div>';	
			echo '<div class="three-fourths" style="border-bottom:1px solid #DDD;">';
			echo '<h3>' . get_the_title() . '</h3>';
			echo '<blockquote><p>' . get_the_content() . '</p></blockquote>';	
			echo '</div>';
		echo '</div>';
		
		endwhile;
		
	endif;
	
	// Outro Text (hard coded)
	echo '</div><!-- end .entry-content -->';
	echo '</div><!-- end .page .hentry .entry -->';
}
	
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');

// Run the Genesis loop.
genesis();

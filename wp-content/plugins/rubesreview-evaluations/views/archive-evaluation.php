<?php
/**
 * evaluation Post Type: Archive/Taxonomy View
 *
 * @package    rubesreview evaluations
 * @author     Cap Web Solutions
 * @copyright  2017 Matt Ryan 
 *
 */

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Remove the author box on single posts HTML5 Themes
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

add_action( 'genesis_entry_header', 'rubesreview_evaluation_info', 10 );
function rubesreview_evaluation_info() {

	global $post;
	$post_id = get_the_ID( $post->ID ); 
	$evaluation_descriptor = get_post_meta( $post_id, '_rubesreview_evaluation_descriptor', true );

	$evaluation_featured_img = '';
	if( has_post_thumbnail( $post_id ) ) {
		$evaluation_featured_img = genesis_get_image( array( 'format' => 'html', 'size' => 'rubesreview-evaluation-image', 'attr' => array( 'class' => 'author-image' ) ) );
	}
	
	$evaluation_content = '<div class="evaluation-wrap">';

	$evaluation_content .= sprintf('<div class="evaluation-descriptor">%s</div>', $evaluation_descriptor );
	if( !empty( $evaluation_featured_img ) ) { 
		$evaluation_content .= sprintf('<span class="alignright evaluation-image">%s</span>', $evaluation_featured_img ); 
	}	
	// $evaluation_content .= sprintf('<div class="evaluation-organization">Organization Type: %s</div>', get_the_title( $post_id  ) );
	$evaluation_content .= '</div>';  // close evaluation-wrap

	printf( '<article class="evaluation-entry">%s</article>', $evaluation_content  );


}
// genesis_posts_nav();  //* TODO: Find a place for this. 
genesis();
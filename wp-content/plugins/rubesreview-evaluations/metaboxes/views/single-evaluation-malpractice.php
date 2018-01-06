<?php
/**
 * Malpractice Company Evaluation Post Type: Single Post View 
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

//* Remove entry title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

add_action( 'genesis_entry_header', 'rubesreview_evaluation_malpractice_eval', 10 );
function rubesreview_evaluation_malpractice_eval( $evaluation_meta ) {

	global $post;

	FLBuilder::render_query( array(
		'post_type' => 'fl-builder-template',
		'p'         => 956 // Breaver Header Template ID
	) );
	
	$prefix = '_rubesreview_evaluation_';
	$post_id = get_the_ID(); 

	$evaluation_meta = array(
		'org_type' => get_the_term_list( $post_id, 'orgtype', '', ', ', '' ),
		'organization' => get_post_meta( $post_id, $prefix . 'organization', true ),
		'org_address' => get_post_meta( $post_id,  $prefix . 'org_address', true ),
		'org_web' => get_post_meta( $post_id,  $prefix . 'org_web', true ),
		'org_phone' => get_post_meta( $post_id,  $prefix . 'org_phone', true ),
		'malp-field02' => get_post_meta( $post_id,  'field_5a3082abf6429', true ),
		'malp-field03' => get_post_meta( $post_id,  'field_5a3082edf642a', true ),
		'malp-field03-label' => get_post_meta( $post_id,  'field_5a3082edf642a', true ),
		'malp-field04' => get_post_meta( $post_id,  'field_5a308303f642b', true ),
		'malp-field05' => get_post_meta( $post_id,  'field_5a30831ef642c', true ),
		'malp-field06' => get_post_meta( $post_id,  'field_5a308333f642d', true ),
		'malp-field07' => get_post_meta( $post_id,  'field_5a30838ff642e', true ),
		'malp-field08' => get_post_meta( $post_id,  'field_5a30839ff642f', true ),
		'malp-field09' => get_post_meta( $post_id,  'field_5a3083b0f6430', true ),
		'malp-field10' => get_post_meta( $post_id,  'field_5a3083c7f6431', true ),
		'malp-field11' => get_post_meta( $post_id,  'field_5a3083def6432', true ),
		'malp-field12' => get_post_meta( $post_id,  'field_5a3083f2f6433', true ),
		'malp_average_rating' => get_post_meta( $post_id,  'malp_average_rating', true ),
		'malp_additional_comments' => get_post_meta( $post_id,  'additional_comments', true ),
	 );	
	 $term = get_queried_object();
	 $malp_field03 = get_field('malp-field03', $term);
	 d($malp_field03);
	// $evaluation_featured_img = '';
	// if( has_post_thumbnail( $post_id ) ) {
	// 	$evaluation_meta['featured_img'] = genesis_get_image( array( 'format' => 'html', 'size' => 'rubesreview-evaluation-image', 'attr' => array( 'class' => 'evaluation-image' ) ) );
	// }

	$evaluation_content = '<div class="evaluation-wrap">';

	//* Need to parse title to format xxxxxx cccc,ss
	$org_title = explode( '-', get_the_title( $post_id ), 4 );
	$evaluation_content .= sprintf('<div class="evaluation-name">Organization: %s  &mdash;  %s, %s</div>', $org_title[0], $org_title[1], $org_title[2] );

	foreach ($evaluation_meta as $key => $value) {
		switch ( $key ) {
			case 'featured_img' :
				if( !empty( $value ) ) { 
					$evaluation_content .= sprintf('<span class="alignright evaluation-image">%s</span>', $value ); 
				}
				break;
			case 'org_type':
				$evaluation_content .= sprintf('<div class="evaluation-organization">Organization Type: %s</div>', $value ); 	
				break;
			case 'organization':
				// $evaluation_content .= sprintf('<div class="evaluation-organization">Organization Name: %s</div>', $value ); 
				break;
			case 'org_address':
			case 'org_phone':
			case 'org_web':
				$evaluation_content .= sprintf('<div class="evaluation-org-address">%s</div>', $value ); 
				break; 
			case 'malp-field02':
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-wrap">'); 
			$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '">xx</div>', $value ) ;
			break;
			case 'malp-field03':
			case 'malp-field04':
			case 'malp-field05':
			case 'malp-field06':
			case 'malp-field07':
			case 'malp-field08':
			case 'malp-field09':
			case 'malp-field10':
			case 'malp-field11':
			case 'malp-field12':
				$evaluation_content .= sprintf('<div class="evaluation-org-stars-' . $value . '"> ' . substr($key, -2 ) . '</div>', $value ) ;
				break;
		}
	}

	$evaluation_content .= sprintf('<br><div class="evaluation-org-stars-' . $evaluation_meta['malp_average_rating'] . '">Average Stars => <strong>%s</strong></div><br>', strval( $evaluation_meta['malp_average_rating'] ) ); 

	$evaluation_content .= '</div>';  // close org-star-wrap
	$evaluation_content .= sprintf('<div class="evaluation-addl-comments">Comments: %s</div>', $evaluation_meta['malp_additional_comments'] );
	$evaluation_content .= sprintf('<div class="evaluation-author">Evaluation by: %s</div>', get_the_author_meta('display_name') );
	$evaluation_content .= '</div></div>';  // close evaluation-wrap

	printf( '<article class="evaluation-entry">%s</article>', $evaluation_content  );
	return ( $evaluation_meta );

}

genesis();

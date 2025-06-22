<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package minerva
 */

get_header();

?>


	<?php 

	//Single Blog Template
	
	$minerva_singleb_global = minerva_get_option( 'minerva_single_blog_layout' ); //for globally	
	$minerva_single_post_style = get_post_meta( get_the_ID(),'minerva_blog_post_meta', true );

	$theme_post_meta_single = isset($minerva_single_post_style['minerva_single_blog_layout']) && !empty($minerva_single_post_style['minerva_single_blog_layout']) ? $minerva_single_post_style['minerva_single_blog_layout'] : '';
	
	if( is_single() && !empty( $minerva_single_post_style  ) ) {
	 
		get_template_part( 'template-parts/single/'.$theme_post_meta_single.'' ); 
	
	} elseif ( class_exists( 'CSF' ) && !empty( $minerva_singleb_global ) ) {
		
		get_template_part( 'template-parts/single/'.$minerva_singleb_global.'' );  
		
	} else {
		
		get_template_part( 'template-parts/single/single-one' );  
	}
		
	?>


<?php get_footer(); ?>

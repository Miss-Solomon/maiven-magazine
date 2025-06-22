<?php
if (!defined('ABSPATH'))
{
	exit; // Exit if accessed directly
	
}

if (!function_exists('minerva_theme_inline_style')):

	function minerva_theme_inline_style()
	{

		wp_enqueue_style('minerva-custom-style', get_template_directory_uri() . '/assets/css/custom-style.css');
		
		
		$theme_main_color = minerva_get_customize_option('theme_main_color');

		$custom_css = '';
		
		
		
		if (!empty($theme_main_color))
		{
	
				$custom_css .= '.header-signup-btn a, .search-popup .search-form .submit-btn, a.read-more-btn:hover, .backto:hover, .blog-sidebar .widget_block.widget_search .wp-block-search__button, .blog-sidebar .widget ul li::before, .blog-sidebar .widget_block li.wp-block-latest-comments__comment::before, .blog-post-comment .comment-respond .comment-form .btn-comments {background-color: ' . esc_attr($theme_main_color) . ';}';
				
				$custom_css .= '.slider-social-box a:hover, .blog-post-comment .comment-respond .comment-form .btn-comments:hover {color: ' . esc_attr($theme_main_color) . '!important;}';
				
				$custom_css .= '.header-signup-btn a, a.read-more-btn, .blog-sidebar .widget_block.widget_search .wp-block-search__button, .blog-post-comment .comment-respond .comment-form .btn-comments:hover {border-color: ' . esc_attr($theme_main_color) . ';}';


		}
		
		
		
		
		

		// Get Category Color for List Widget
		
		$categories_widget_color = get_terms('category');
		
        if ($categories_widget_color) {
            foreach( $categories_widget_color as $tag) {
				$tag_link = get_category_link($tag->term_id);
				$title_bg_Color = get_term_meta($tag->term_id, 'minerva', true);
				$catColor = !empty( $title_bg_Color['cat-color'] )? $title_bg_Color['cat-color'] : '#0073FF';
				$custom_css .= '
					.cat-item-'.$tag->term_id.' span.post_count {background-color : '.$catColor.' !important;} 
				';
			}
        }	
		
		
	
				


		wp_add_inline_style('minerva-custom-style', $custom_css);
	}
	add_action('wp_enqueue_scripts', 'minerva_theme_inline_style');

endif;


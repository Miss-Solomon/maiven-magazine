<?php 

/**
 * All Elementor widget init
 * @package Minerva
 * @since 1.0.0
 */

function register_hello_world_widget( $widgets_manager ) {

	require_once( MINERVA_EXTRA_ELEMENTOR . '/widgets/class-post-block-style-one-elementor-widget.php' );
	require_once( MINERVA_EXTRA_ELEMENTOR . '/widgets/class-post-block-item-grid-elementor-widget.php' );
	require_once( MINERVA_EXTRA_ELEMENTOR . '/widgets/class-post-block-style-two-elementor-widget.php' );
	require_once( MINERVA_EXTRA_ELEMENTOR . '/widgets/class-post-block-style-three-elementor-widget.php' );
	require_once( MINERVA_EXTRA_ELEMENTOR . '/widgets/class-post-block-style-four-elementor-widget.php' );


	require_once( MINERVA_EXTRA_ELEMENTOR . '/widgets/class-post-block-item-grid-two-elementor-widget.php' );
	require_once( MINERVA_EXTRA_ELEMENTOR . '/widgets/class-post-block-item-grid-three-elementor-widget.php' );
	require_once( MINERVA_EXTRA_ELEMENTOR . '/widgets/class-post-block-item-grid-four-elementor-widget.php' );
	require_once( MINERVA_EXTRA_ELEMENTOR . '/widgets/class-post-block-style-five-elementor-widget.php' );
	require_once( MINERVA_EXTRA_ELEMENTOR . '/widgets/class-post-block-style-six-elementor-widget.php' );


	//require_once( MINERVA_EXTRA_ELEMENTOR . '/widgets/hello-world-widget-2.php' );


	$widgets_manager->register( new \minerva_post_block_list() );
	$widgets_manager->register( new \minerva_post_block_item_grid() );
	$widgets_manager->register( new \minerva_post_block_template_two() );
	$widgets_manager->register( new \minerva_post_block_template_three() );
	$widgets_manager->register( new \minerva_post_block_list_two() );


	$widgets_manager->register( new \minerva_post_block_item_grid2() );
	$widgets_manager->register( new \minerva_post_block_item_grid_three() );
	$widgets_manager->register( new \minerva_post_block_item_grid_four() );
	$widgets_manager->register( new \minerva_post_block_list_three_loadmore() );
	$widgets_manager->register( new \minerva_post_block_template_six() );

	//$widgets_manager->register( new \Elementor_Hello_World_Widget_2() );

}
add_action( 'elementor/widgets/register', 'register_hello_world_widget' );



/**
 * Minerva Elementor _widget_categories()
 * @since 1.0.0
 * */


function minerva_elementor_widget_categories($elements_manager) {

    $elements_manager->add_category(
        'minerva_widgets',
        [
            'title' => __('Minerva Widgets', 'minerva-extra'),
        ]
    );

}

add_action('elementor/elements/categories_registered', 'minerva_elementor_widget_categories');
<?php
/**
 * Maiven Magazine Shortcodes
 *
 * Native WordPress shortcodes for displaying posts in various layouts
 * without requiring Elementor or other page builders
 *
 * @package maiven
 */

/**
 * Register post grid shortcode
 *
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function maiven_post_grid_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'category' => '',
        'tag' => '',
        'posts_per_page' => 6,
        'columns' => 3,
        'show_excerpt' => 'true',
        'show_meta' => 'true',
        'show_thumbnail' => 'true',
        'orderby' => 'date',
        'order' => 'DESC',
    ), $atts, 'maiven_post_grid' );
    
    // Convert string attributes to appropriate types
    $show_excerpt = filter_var( $atts['show_excerpt'], FILTER_VALIDATE_BOOLEAN );
    $show_meta = filter_var( $atts['show_meta'], FILTER_VALIDATE_BOOLEAN );
    $show_thumbnail = filter_var( $atts['show_thumbnail'], FILTER_VALIDATE_BOOLEAN );
    
    // Query arguments
    $args = array(
        'posts_per_page' => intval( $atts['posts_per_page'] ),
        'orderby' => $atts['orderby'],
        'order' => $atts['order'],
        'ignore_sticky_posts' => 1,
    );
    
    // Add category parameter if specified
    if ( ! empty( $atts['category'] ) ) {
        $args['category_name'] = $atts['category'];
    }
    
    // Add tag parameter if specified
    if ( ! empty( $atts['tag'] ) ) {
        $args['tag'] = $atts['tag'];
    }
    
    // Start output buffering
    ob_start();
    
    // Display posts using our function
    maiven_display_post_grid(
        $args,
        $atts['columns'],
        $show_excerpt,
        $show_meta,
        $show_thumbnail
    );
    
    // Return the buffered content
    return ob_get_clean();
}
add_shortcode( 'maiven_post_grid', 'maiven_post_grid_shortcode' );

/**
 * Register featured posts shortcode
 *
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function maiven_featured_posts_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'category' => '',
        'tag' => '',
        'posts_per_page' => 3,
        'layout' => 'default',
        'orderby' => 'date',
        'order' => 'DESC',
    ), $atts, 'maiven_featured_posts' );
    
    // Query arguments
    $args = array(
        'posts_per_page' => intval( $atts['posts_per_page'] ),
        'orderby' => $atts['orderby'],
        'order' => $atts['order'],
        'ignore_sticky_posts' => 1,
        'meta_key' => '_thumbnail_id', // Only posts with featured images
    );
    
    // Add category parameter if specified
    if ( ! empty( $atts['category'] ) ) {
        $args['category_name'] = $atts['category'];
    }
    
    // Add tag parameter if specified
    if ( ! empty( $atts['tag'] ) ) {
        $args['tag'] = $atts['tag'];
    }
    
    // Start output buffering
    ob_start();
    
    // Display featured posts using our function
    maiven_display_featured_posts(
        $args,
        $atts['layout']
    );
    
    // Return the buffered content
    return ob_get_clean();
}
add_shortcode( 'maiven_featured_posts', 'maiven_featured_posts_shortcode' );

/**
 * Register recent posts shortcode
 *
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function maiven_recent_posts_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'title' => esc_html__( 'Recent Posts', 'maiven' ),
        'posts_per_page' => 5,
        'show_date' => 'true',
        'show_thumbnail' => 'true',
        'category' => '',
    ), $atts, 'maiven_recent_posts' );
    
    // Convert string attributes to appropriate types
    $show_date = filter_var( $atts['show_date'], FILTER_VALIDATE_BOOLEAN );
    $show_thumbnail = filter_var( $atts['show_thumbnail'], FILTER_VALIDATE_BOOLEAN );
    
    // Query arguments
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => intval( $atts['posts_per_page'] ),
        'orderby' => 'date',
        'order' => 'DESC',
        'ignore_sticky_posts' => 1,
    );
    
    // Add category parameter if specified
    if ( ! empty( $atts['category'] ) ) {
        $args['category_name'] = $atts['category'];
    }
    
    // Run the query
    $query = new WP_Query( $args );
    
    // Start output buffering
    ob_start();
    
    // Output posts
    if ( $query->have_posts() ) :
        echo '<div class="maiven-recent-posts">';
        
        if ( ! empty( $atts['title'] ) ) {
            echo '<h3 class="widget-title">' . esc_html( $atts['title'] ) . '</h3>';
        }
        
        echo '<ul class="recent-posts-list">';
        
        while ( $query->have_posts() ) : $query->the_post();
            echo '<li class="recent-post">';
            
            if ( $show_thumbnail && has_post_thumbnail() ) :
                echo '<div class="recent-post-thumb">';
                echo '<a href="' . esc_url( get_permalink() ) . '">';
                the_post_thumbnail( 'thumbnail', array( 'class' => 'img-fluid' ) );
                echo '</a>';
                echo '</div>';
            endif;
            
            echo '<div class="recent-post-info">';
            echo '<h4><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h4>';
            
            if ( $show_date ) :
                echo '<span class="post-date">' . get_the_date() . '</span>';
            endif;
            
            echo '</div>';
            echo '</li>';
        endwhile;
        
        echo '</ul>';
        echo '</div>';
        
        // Restore original post data
        wp_reset_postdata();
    endif;
    
    // Return the buffered content
    return ob_get_clean();
}
add_shortcode( 'maiven_recent_posts', 'maiven_recent_posts_shortcode' );

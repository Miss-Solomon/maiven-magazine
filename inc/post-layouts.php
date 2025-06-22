<?php
/**
 * Maiven Magazine Post Grid Functions
 *
 * Native WordPress functions for displaying posts in various layouts
 * without requiring Elementor or other page builders
 *
 * @package maiven
 */

if ( ! function_exists( 'maiven_display_post_grid' ) ) :
/**
 * Display posts in a grid layout
 *
 * @param array $args Arguments for the post query
 * @param string $columns Number of columns (1, 2, 3, or 4)
 * @param bool $show_excerpt Whether to show post excerpts
 * @param bool $show_meta Whether to show post meta (author, date, etc.)
 * @param bool $show_thumbnail Whether to show post thumbnails
 */
function maiven_display_post_grid( $args = array(), $columns = '3', $show_excerpt = true, $show_meta = true, $show_thumbnail = true ) {
    // Default query arguments
    $defaults = array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'ignore_sticky_posts' => 1,
    );
    
    // Merge default args with user args
    $args = wp_parse_args( $args, $defaults );
    
    // Run the query
    $query = new WP_Query( $args );
    
    // Define column classes based on the number of columns specified
    switch ( $columns ) {
        case '1':
            $column_class = 'col-md-12';
            break;
        case '2':
            $column_class = 'col-md-6';
            break;
        case '4':
            $column_class = 'col-md-3';
            break;
        case '3':
        default:
            $column_class = 'col-md-4';
            break;
    }
    
    // Output posts
    if ( $query->have_posts() ) :
        echo '<div class="maiven-post-grid row">';
        
        while ( $query->have_posts() ) : $query->the_post();
            echo '<div class="maiven-post-grid-item ' . esc_attr( $column_class ) . '">';
            
            echo '<article class="post-block-style-one-wrapper">';
            
            // Post thumbnail
            if ( $show_thumbnail && has_post_thumbnail() ) :
                echo '<div class="post-block-style-one-thumb">';
                echo '<a href="' . esc_url( get_permalink() ) . '">';
                the_post_thumbnail( 'large', array( 'class' => 'img-fluid' ) );
                echo '</a>';
                echo '</div>';
            endif;
            
            echo '<div class="post-block-style-one-inner">';
            
            // Post categories
            echo '<div class="post-cats-list">';
            maiven_post_categories();
            echo '</div>';
            
            // Post title
            echo '<div class="post-item-title">';
            echo '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h2>';
            echo '</div>';
            
            // Post meta
            if ( $show_meta ) :
                echo '<div class="post-top-meta-list">';
                echo '<div class="author-details">';
                echo '<span class="author-name">' . esc_html__( 'By', 'maiven' ) . ' ' . get_the_author_link() . '</span>';
                echo '</div>';
                
                echo '<div class="date-box">';
                echo '<span>' . esc_html( get_the_date( 'F j, Y' ) ) . '</span>';
                echo '</div>';
                
                echo '<div class="read-time-box">';
                if ( function_exists( 'minerva_reading_time' ) ) {
                    minerva_reading_time();
                }
                echo '</div>';
                echo '</div>';
            endif;
            
            // Post excerpt
            if ( $show_excerpt ) :
                echo '<div class="post-content">';
                echo '<p>' . wp_trim_words( get_the_excerpt(), 20, '...' ) . '</p>';
                echo '</div>';
                
                echo '<a href="' . esc_url( get_permalink() ) . '" class="view-btn">' . esc_html__( 'Read Article', 'maiven' ) . '</a>';
            endif;
            
            echo '</div>'; // .post-block-style-one-inner
            echo '</article>';
            echo '</div>'; // .maiven-post-grid-item
            
        endwhile;
        
        echo '</div>'; // .maiven-post-grid
        
        // Restore original post data
        wp_reset_postdata();
    endif;
}
endif;

if ( ! function_exists( 'maiven_post_categories' ) ) :
/**
 * Display post categories with colors
 */
function maiven_post_categories() {
    $categories = get_the_category();
    if ( ! empty( $categories ) ) {
        foreach ( $categories as $category ) {
            // Get category color if using the theme's color system
            $catColor = '#333333'; // Default color
            $catbgColor = '#f7f7f7'; // Default background
            
            $meta = get_term_meta( $category->term_id, 'minerva', true );
            if ( isset( $meta['category_color'] ) && ! empty( $meta['category_color'] ) ) {
                $catColor = $meta['category_color'];
            }
            
            if ( isset( $meta['cat_bg_color'] ) && ! empty( $meta['cat_bg_color'] ) ) {
                $catbgColor = $meta['cat_bg_color'];
            }
            
            echo '<a class="news-cat_Name" href="' . esc_url( get_category_link( $category->term_id ) ) . '" style="background-color:' . esc_attr( $catbgColor ) . '; color:' . esc_attr( $catColor ) . '">';
            echo esc_html( $category->name );
            echo '</a>';
        }
    }
}
endif;

if ( ! function_exists( 'maiven_display_featured_posts' ) ) :
/**
 * Display featured posts in a specific layout
 *
 * @param array $args Arguments for the post query
 * @param string $layout Layout style ('default', 'large', 'slider')
 */
function maiven_display_featured_posts( $args = array(), $layout = 'default' ) {
    // Default query arguments
    $defaults = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'ignore_sticky_posts' => 1,
        'meta_key' => '_thumbnail_id', // Only posts with featured images
    );
    
    // Merge default args with user args
    $args = wp_parse_args( $args, $defaults );
    
    // Run the query
    $query = new WP_Query( $args );
    
    // Output posts based on layout
    if ( $query->have_posts() ) :
        echo '<div class="maiven-featured-posts layout-' . esc_attr( $layout ) . '">';
        
        switch ( $layout ) {
            case 'large':
                // Large featured post layout
                while ( $query->have_posts() ) : $query->the_post();
                    echo '<div class="featured-post-large">';
                    
                    if ( has_post_thumbnail() ) :
                        echo '<div class="featured-post-thumb">';
                        echo '<a href="' . esc_url( get_permalink() ) . '">';
                        the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) );
                        echo '</a>';
                        echo '</div>';
                    endif;
                    
                    echo '<div class="featured-post-content">';
                    echo '<div class="post-cats-list">';
                    maiven_post_categories();
                    echo '</div>';
                    
                    echo '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h2>';
                    
                    echo '<div class="post-meta">';
                    echo '<span class="author-name">' . esc_html__( 'By', 'maiven' ) . ' ' . get_the_author_link() . '</span>';
                    echo '<span class="post-date">' . esc_html( get_the_date( 'F j, Y' ) ) . '</span>';
                    echo '</div>';
                    
                    echo '<div class="post-excerpt">';
                    echo '<p>' . wp_trim_words( get_the_excerpt(), 30, '...' ) . '</p>';
                    echo '</div>';
                    
                    echo '<a href="' . esc_url( get_permalink() ) . '" class="read-more">' . esc_html__( 'Read Article', 'maiven' ) . '</a>';
                    echo '</div>'; // .featured-post-content
                    
                    echo '</div>'; // .featured-post-large
                endwhile;
                break;
                
            case 'slider':
                // Slider layout would require additional JavaScript 
                // This is a basic structure that you'd enhance with a slider script
                echo '<div class="featured-posts-slider">';
                while ( $query->have_posts() ) : $query->the_post();
                    echo '<div class="featured-post-slide">';
                    
                    if ( has_post_thumbnail() ) :
                        echo '<div class="featured-post-thumb">';
                        the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) );
                        echo '</div>';
                    endif;
                    
                    echo '<div class="featured-post-overlay">';
                    echo '<div class="post-cats-list">';
                    maiven_post_categories();
                    echo '</div>';
                    
                    echo '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h2>';
                    
                    echo '<div class="post-meta">';
                    echo '<span class="author-name">' . esc_html__( 'By', 'maiven' ) . ' ' . get_the_author_link() . '</span>';
                    echo '<span class="post-date">' . esc_html( get_the_date( 'F j, Y' ) ) . '</span>';
                    echo '</div>';
                    
                    echo '</div>'; // .featured-post-overlay
                    echo '</div>'; // .featured-post-slide
                endwhile;
                echo '</div>'; // .featured-posts-slider
                break;
                
            case 'default':
            default:
                // Default layout
                echo '<div class="row">';
                $count = 0;
                
                while ( $query->have_posts() ) : $query->the_post();
                    $count++;
                    
                    if ( $count === 1 ) {
                        // First post gets full width
                        echo '<div class="col-md-12">';
                        echo '<div class="featured-post-main">';
                        
                        if ( has_post_thumbnail() ) :
                            echo '<div class="featured-post-thumb">';
                            echo '<a href="' . esc_url( get_permalink() ) . '">';
                            the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) );
                            echo '</a>';
                            echo '</div>';
                        endif;
                        
                        echo '<div class="featured-post-content">';
                        echo '<div class="post-cats-list">';
                        maiven_post_categories();
                        echo '</div>';
                        
                        echo '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h2>';
                        
                        echo '<div class="post-meta">';
                        echo '<span class="author-name">' . esc_html__( 'By', 'maiven' ) . ' ' . get_the_author_link() . '</span>';
                        echo '<span class="post-date">' . esc_html( get_the_date( 'F j, Y' ) ) . '</span>';
                        echo '</div>';
                        
                        echo '</div>'; // .featured-post-content
                        
                        echo '</div>'; // .featured-post-main
                        echo '</div>'; // .col-md-12
                    } else {
                        // Other posts get half width
                        echo '<div class="col-md-6">';
                        echo '<div class="featured-post-secondary">';
                        
                        if ( has_post_thumbnail() ) :
                            echo '<div class="featured-post-thumb">';
                            echo '<a href="' . esc_url( get_permalink() ) . '">';
                            the_post_thumbnail( 'large', array( 'class' => 'img-fluid' ) );
                            echo '</a>';
                            echo '</div>';
                        endif;
                        
                        echo '<div class="featured-post-content">';
                        echo '<div class="post-cats-list">';
                        maiven_post_categories();
                        echo '</div>';
                        
                        echo '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h2>';
                        
                        echo '<div class="post-meta">';
                        echo '<span class="post-date">' . esc_html( get_the_date( 'F j, Y' ) ) . '</span>';
                        echo '</div>';
                        
                        echo '</div>'; // .featured-post-content
                        
                        echo '</div>'; // .featured-post-secondary
                        echo '</div>'; // .col-md-6
                    }
                endwhile;
                
                echo '</div>'; // .row
                break;
        }
        
        echo '</div>'; // .maiven-featured-posts
        
        // Restore original post data
        wp_reset_postdata();
    endif;
}
endif;

<?php 

    global $post;

    $relatedposts = get_posts( array( 
	
	'category__in' => wp_get_post_categories($post->ID), 
	'numberposts' => 3,
	'order'       => 'ASC',
	'post__not_in' => array($post->ID) ) 
	
	);
	
    if( $relatedposts ) : 

    echo '<div class="theme_related_post_Grid">';
    echo '<h2>'.esc_html__( 'Related Posts', 'minerva' ).'</h2>';
	
    echo '<div class="theme_post_grid__Slider_Wrapperr">';
	echo '<div class="theme_post_grid__Slider related-posts-slider row">';
	
	
    foreach( $relatedposts as $post ) {
		
    setup_postdata($post); ?>
    
	
<div class="col-xl-4 col-md-12">	


	<article <?php post_class('post-block-style-one-wrapper'); ?>>

	<div class="post-block-style-one-inner">


			<div class="post-block-media-wrap">
				<a href="<?php the_permalink(); ?>">
					<img src="<?php echo esc_attr(esc_url(get_the_post_thumbnail_url(null, 'full'))); ?>" alt="<?php the_title_attribute(); ?>">
				</a>
			</div>
		
			<div class="post-block-content-wrap">
		
				 <div class="post-top-meta-list">

				<div class="post-view-box">
                    2.6k Views
                </div>
                
                <div class="read-time-box">
                    5 Minute read
                </div>


            	</div>
						
				<div class="post-item-title">
					<h2 class="post-title">
						<a href="<?php the_permalink(); ?>"><?php echo esc_html( wp_trim_words(get_the_title(), 100,'') ); ?></a>
					</h2>
				</div>

				<div class="post-excerpt-box">
					<p><?php echo esc_html( wp_trim_words(get_the_excerpt(), 14 ,'') );?></p>
				</div>

				<div class="post-bottom-meta-list">
				
					<div class="post-meta-author-box">
						By <?php echo get_the_author_link(); ?>
					</div>

					<div class="post-meta-date-box">
						<?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
					</div>
				
				</div>

					
			</div>


		</div>
	
	</article>
				
				
	
</div>	
	
    <?php } 
	
	wp_reset_postdata();

    echo '</div>'; 
	echo '</div>';
    echo '</div>';

    endif;